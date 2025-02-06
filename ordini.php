<?php
require_once 'bootstrap.php';
$templateParams["titolo"]="TrainTrack - Percorsi";
$templateParams["nome"]="template/ordini.php";

if (!isUserLoggedIn()) {
    header("Location: login.php");
    exit;
} 

$email = $_SESSION["email"];

if ($dbh->isClient($email)) {
    header("Location: ordini.php");
} else {
    header("Location: login.php");
}
exit();

$ticketOrders = $dbh->getTicketOrders($email);
$subscriptionOrders = $dbh->getSubscriptionOrders($email);

require 'template/base.php';
?>