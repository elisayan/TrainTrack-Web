<?php
require_once 'bootstrap.php';

$templateParams = [
    "nome"           => "template/payment.php",
    "titolo"         => "TrainTrack - Pagamento",
    "user_logged_in" => isset($_SESSION['email']),
    "total_price"    => 0,
];

$cartItems = $dbh->getCartItems(
    isset($_SESSION['email']) ? $_SESSION['email'] : null,
    session_id()
);

if (isset($_SESSION["prezzo_finale"])) {
    $templateParams["total_price"] = $_SESSION["prezzo_finale"];
    $totalPrice = $_SESSION["prezzo_finale"];
} else if (!empty($cartItems['tickets']) || !empty($cartItems['subscriptions'])) {
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

if (isset($_POST['proceed_to_payment_details'])) {
    $_SESSION['passenger_details_for_payment'] = [
        'name'    => $_POST['name']    ?? '',
        'surname' => $_POST['surname'] ?? ''
    ];
    if (!$templateParams["user_logged_in"]) {
        $_SESSION['passenger_details_for_payment']['email']   = $_POST['email']   ?? '';
        $_SESSION['passenger_details_for_payment']['cf']      = $_POST['cf']      ?? '';
        $_SESSION['passenger_details_for_payment']['address'] = $_POST['address'] ?? '';
        $_SESSION['passenger_details_for_payment']['phone']   = $_POST['phone']   ?? '';
    }

}

else if (isset($_POST['confirm_actual_payment'])) { 
    $passengerData = $_SESSION['passenger_details_for_payment'] ?? null;

    if (!$passengerData) {
        die("Error: Passenger details not found. Please start checkout again.");
    }

    $_SESSION['last_purchase'] = $cartItems;
    var_dump("enter if");


    if (isset($_SESSION['email'])) { 
        var_dump($totalPrice);

        $emailUtente = $_SESSION["email"];
        $nomePas     = $passengerData['name'];
        $cognPas     = $passengerData['surname'];

        foreach ($cartItems['tickets'] as $ticket) {
            $routeCodeResult   = $dbh->getRouteCode($ticket['CodServizio']);
            $actualCodPercorso = !empty($routeCodeResult)
                                ? $routeCodeResult[0]['CodPercorso']
                                : null;
            $dbh->insertTicket(
                $emailUtente, $nomePas, $cognPas, $actualCodPercorso,
                $ticket['NomePartenza'], $ticket['NomeArrivo'], $ticket['TipoTreno'],
                $ticket['DataPartenza'], $ticket['OrarioPartenza'], $ticket['Prezzo']
            );
            $dbh->notificaAcquistoBiglietti(
                $emailUtente, (int)$ticket['Quantità'], $actualCodPercorso, $nomePas, $cognPas
            );
        }
        foreach ($cartItems['subscriptions'] as $subscription) {
            $codPerc     = $subscription['CodPercorso'];
            $durataAbbon = $subscription['Durata'];
            $dbh->insertSubscription(
                $emailUtente, $nomePas, $cognPas, $codPerc,
                $subscription['NomePartenza'], $subscription['NomeArrivo'], $subscription['TipoTreno'],
                $subscription['DataPartenza'], $durataAbbon, $subscription['Chilometraggio'], $subscription['Prezzo']
            );
            $dbh->notificaAcquistoAbbonamento(
                $emailUtente, $codPerc, $durataAbbon, $nomePas, $cognPas
            );
        }
        $dbh->aggiornaSpesaCliente($emailUtente, $totalPrice); 

        $dbh->checkAvailableForCoupon($emailUtente);

    } else { 
        if (
            empty($passengerData['name'])    ||
            empty($passengerData['surname']) ||
            empty($passengerData['email'])   ||
            empty($passengerData['cf'])      ||
            empty($passengerData['address'])
        ) {
            die("Missing required guest information. Please fill out all fields in checkout.");
        }

        $guestEmail    = $passengerData['email'];
        $nomePas       = $passengerData['name'];
        $cognPas       = $passengerData['surname'];

        $existingGuest = $dbh->getGuestByEmail($guestEmail);
        if (empty($existingGuest)) {
            $dbh->insertGuest(
                $nomePas, $cognPas, $passengerData['cf'],
                $passengerData['address'], $passengerData['phone'], $guestEmail
            );
        }
        foreach ($cartItems['tickets'] as $ticket) {
            $routeCodeResult   = $dbh->getRouteCode($ticket['CodServizio']);
            $actualCodPercorso = !empty($routeCodeResult) ? $routeCodeResult[0]['CodPercorso'] : null;
            $dbh->insertTicket(
                $guestEmail, $nomePas, $cognPas, $actualCodPercorso,
                $ticket['NomePartenza'], $ticket['NomeArrivo'], $ticket['TipoTreno'],
                $ticket['DataPartenza'], $ticket['OrarioPartenza'], $ticket['Prezzo']
            );
        }
        foreach ($cartItems['subscriptions'] as $subscription) {
            $codPerc     = $subscription['CodPercorso'];
            $durataAbbon = $subscription['Durata'];
            $dbh->insertSubscription(
                $guestEmail, $nomePas, $cognPas, $codPerc,
                $subscription['NomePartenza'], $subscription['NomeArrivo'], $subscription['TipoTreno'],
                $subscription['DataPartenza'], $durataAbbon, $subscription['Chilometraggio'], $subscription['Prezzo']
            );
        }
    }

    header("Location: order.php");
    exit;
}

require 'template/base.php'; 