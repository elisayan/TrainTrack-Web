<?php
require_once 'bootstrap.php';
$templateParams["titolo"]="TrainTrack - Percorsi";
$templateParams["nome"]="template/ordini.php";

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
}

$ticketOrders = $dbh->getTicketOrders($_SESSION['email']);
$subscriptionOrders = $dbh->getSubscriptionOrders($_SESSION['email']);

require 'template/base.php';
?>