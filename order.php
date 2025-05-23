<?php
require_once 'bootstrap.php';

$templateParams = [
    "nome" => "order.php",
    "titolo" => "Ordine",
    "user_logged_in" => isset($_SESSION['email'])
];

$cartItems = $dbh->getCartItems(
    isset($_SESSION['email']) ? $_SESSION['email'] : null,
    session_id()
);

if (!empty($cartItems['tickets']) || !empty($cartItems['subscriptions'])) {
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

if(isset($_SESSION['email'])) {
    $email = $_SESSION["email"];
    $user = $dbh->getUserByEmail($email);
}

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['card-number']) && isset($_POST['expiry-date']) && isset($_POST['cvv'])) {
    // Process the payment here
    // Redirect to a success page or show a success message

    
    header("Location: order.php");
    exit;
} else {
    // Handle the case where payment details are not provided
    $templateParams["error_message"] = "Please fill in all payment details.";
}

require 'template/base.php';
?>