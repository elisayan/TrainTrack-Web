<?php
require_once 'bootstrap.php';

$templateParams = [
    "nome" => "template/checkout.php",
    "titolo" => "TrainTrack - Checkout",
    "cart_items" => [],
    "total_price" => 0,
    "user_logged_in" => isset($_SESSION['email'])
];

$cartItems = $dbh->getCartItems(
    isset($_SESSION['email']) ? $_SESSION['email'] : null,
    session_id()
);

// if (!empty($cartItems['tickets']) || !empty($cartItems['subscriptions'])) {
//     $templateParams["cart_items"] = $cartItems;
    
    
//     $totalPrice = 0;
//     foreach ($cartItems['tickets'] as $ticket) {
//         $totalPrice += $ticket['Prezzo'] * $ticket['Quantità'];
//     }
//     foreach ($cartItems['subscriptions'] as $subscription) {
//         $totalPrice += $subscription['Prezzo'] * $subscription['Quantità'];
//     }
//     $templateParams["total_price"] = $totalPrice;
// }

$templateParams["total_price"] = $dbh->getPrezzoTotaleCarrello(
    $templateParams["user_logged_in"] ? $_SESSION['email'] : null,
    session_id()
);

if (isset($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $user = $dbh->getUserByEmail($email);
}

require 'template/base.php';
?>