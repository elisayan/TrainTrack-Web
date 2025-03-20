<?php
require_once 'bootstrap.php';
if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['email'])) {
    mergeCarts($_SESSION['email']);
}

$templateParams["titolo"]="TrainTrack - Profilo Utente";
$templateParams["nome"]="template/profilo-cliente.php";

$email = $_SESSION["email"];
$user = $dbh->getUserByEmail($email);

require 'template/base.php';
?>