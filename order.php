<?php
require_once 'bootstrap.php';

$templateParams = [
    "nome" => "template/order.php",
    "titolo" => "Ordine",
    "user_logged_in" => isset($_SESSION['email']),
    "order_items" => [],
    "total_price" => 0,
    "discount" => 0
];

if (isset($_SESSION['last_purchase'])) {
    $templateParams["order_items"] = $_SESSION['last_purchase'];

    $totalPrice = 0;
    $subscriptionPrice = 0;
    $ticketPrice = 0;
    foreach ($_SESSION['last_purchase']['tickets'] as $ticket) {
        $ticketPrice += $ticket['Prezzo'] * $ticket['Quantità'];
    }
    foreach ($_SESSION['last_purchase']['subscriptions'] as $subscription) {
        $subscriptionPrice += $subscription['Prezzo'] * $subscription['Quantità'];
    }

    $templateParams["ticket_price"] = $ticketPrice;
    $templateParams["subscription_price"] = $subscriptionPrice;

    if (isset($_SESSION["prezzo_finale"])) {
        $templateParams["total_price"] = $_SESSION["prezzo_finale"];
        $templateParams['discount'] = ($ticketPrice + $subscriptionPrice) - $templateParams['total_price'];
        unset($_SESSION["prezzo_finale"]);
    } else {
        $templateParams["total_price"] = $ticketPrice + $subscriptionPrice;
    }

    unset($_SESSION['last_purchase']);

}

if (isset($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $user = $dbh->getUserByEmail($email);
    $templateParams["user"] = $user[0] ?? null;
}

$dbh->deleteCart(
    isset($_SESSION['email']) ? $_SESSION['email'] : null,
    session_id()
);

require 'template/base.php';
?>