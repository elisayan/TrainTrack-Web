<?php
require_once 'bootstrap.php';

$templateParams = [
    "nome" => "payment.php",
    "titolo" => "Pagamento",
    "user_logged_in" => isset($_SESSION['email'])
];

require 'template/base.php';
?>