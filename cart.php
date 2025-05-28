<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once 'bootstrap.php';


$templateParams = [
    "nome" => "template/cart.php",
    "titolo" => "Carrello",
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

require 'template/base.php';
?>