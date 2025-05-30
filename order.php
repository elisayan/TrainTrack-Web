<?php
require_once 'bootstrap.php';

$templateParams = [
    "nome" => "template/order.php",
    "titolo" => "Ordine",
    "user_logged_in" => isset($_SESSION['email']),
    "order_items" => [],
    "total_price" => 0
];

// Check if we have a recent purchase in session
if (isset($_SESSION['last_purchase'])) {
    $templateParams["order_items"] = $_SESSION['last_purchase'];
    
    // Calculate total price
    $totalPrice = 0;
    foreach ($_SESSION['last_purchase']['tickets'] as $ticket) {
        $totalPrice += $ticket['Prezzo'] * $ticket['Quantità'];
    }
    foreach ($_SESSION['last_purchase']['subscriptions'] as $subscription) {
        $totalPrice += $subscription['Prezzo'] * $subscription['Quantità'];
    }
    $templateParams["total_price"] = $totalPrice;
    
    // Clear the purchase from session so it doesn't show again on refresh
    unset($_SESSION['last_purchase']);
}

if(isset($_SESSION['email'])) {
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