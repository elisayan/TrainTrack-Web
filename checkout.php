<?php
require_once 'bootstrap.php';

$templateParams = [
    "nome" => "checkout.php",
    "titolo" => "Checkout",
    "cart_items" => [],
    "total_price" => 0,
    "user_logged_in" => isset($_SESSION['email'])
];

require 'template/base.php';
?>