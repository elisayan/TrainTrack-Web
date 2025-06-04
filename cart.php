<?php
require_once 'bootstrap.php';

$templateParams = [
    "nome" => "template/cart.php",
    "titolo" => "TrainTrack - Carrello",
    "errorecarrello" => "Il tuo carrello è vuoto",
    "cart_items" => [],
    "total_price" => 0,
    "user_logged_in" => isset($_SESSION['email'])
];


if (isset($_SESSION['email'])) {
    $dbh->transferGuestCart(session_id(), $_SESSION['email']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_item'])) {
        $dbh->removeFromCart($_POST['item_id']);
        header("Location: cart.php");
        exit();

    } elseif (isset($_POST['update_quantity'])) {
        $newQuantity = max(1, intval($_POST['quantity']));
        $dbh->updateCartItemQuantity($_POST['item_id'], $newQuantity);
        header("Location: cart.php");
        exit();

    } elseif (isset($_POST['ticket_id']) || isset($_POST['subscription_id'])) {

        if (isset($_POST['ticket_id'])) {
            $dbh->addToCart(
                $_POST['ticket_id'],
                1,
                isset($_SESSION['email']) ? $_SESSION['email'] : null,
                session_id()
            );
        } else {
            $dbh->addToCart(
                $_POST['subscription_id'],
                1,
                isset($_SESSION['email']) ? $_SESSION['email'] : null,
                session_id()
            );
        }

        header("Location: cart.php");
        exit();
    }
}

$cartItems = $dbh->getCartItems(
    isset($_SESSION['email']) ? $_SESSION['email'] : null,
    session_id()
);

if (!empty($cartItems['tickets']) || !empty($cartItems['subscriptions'])) {
    $templateParams["errorecarrello"] = "";
    $templateParams["cart_items"] = $cartItems;

    $totalPrice = 0;
    foreach ($cartItems['tickets'] as $ticket) {
        $totalPrice += $ticket['Prezzo'] * $ticket['Quantità'];
    }
    foreach ($cartItems['subscriptions'] as $subscription) {
        $totalPrice += $subscription['Prezzo'] * $subscription['Quantità'];
    }
    $templateParams["total_price"] = $totalPrice;
}

if (isset($_POST['apply_discount']) && isset($_POST['discount_code'])) {
    $codice = intval($_POST['discount_code']);
    $email = $_SESSION['email'] ?? null;

    if ($email) {
        $buono = $dbh->verificaBuonoSconto($codice, $email);
        if ($buono !== null) {
            if ($buono['Importo'] > $totalPrice) {
                $nuovoTotale = $dbh->applicaScontoAlCarrello($buono["Importo"], $email);
                if ($nuovoTotale !== false) {
                    $codServizio = $dbh->getPrimoServizioNelCarrello($email);
                    if ($codServizio !== null) {
                        $dbh->segnaBuonoComeUtilizzato($codice, $codServizio);

                        $templateParams["discount_success"] = true;
                        $templateParams["discount_message"] = "Buono sconto applicato correttamente.";
                        $templateParams["discount_amount"] = $buono["Importo"];
                        $templateParams["discounted_total"] = $nuovoTotale;
                    } else {
                        $templateParams["discount_success"] = false;
                        $templateParams["discount_message"] = "Errore: nessun servizio trovato nel carrello.";
                    }
                } else {
                    $templateParams["discount_success"] = false;
                    $templateParams["discount_message"] = "Errore nell'applicazione dello sconto al carrello.";
                }
            } else {
                $templateParams["discount_success"] = false;
                $templateParams["discount_message"] = "Questo codice sconto è applicabile solo a ordini di importo superiore a 10€.";
            }
        } else {
            $templateParams["discount_success"] = false;
            $templateParams["discount_message"] = "Codice non valido, scaduto o già usato.";
        }
    } else {
        $templateParams["discount_success"] = false;
        $templateParams["discount_message"] = "Devi essere loggato per usare un buono sconto.";
    }
}

if (isset($templateParams["discounted_total"])) {
    $_SESSION["prezzo_finale"] = $templateParams["discounted_total"];
} else {
    $_SESSION["prezzo_finale"] = $templateParams["total_price"];
}

require 'template/base.php';
?>