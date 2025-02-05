<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$templateParams["titolo"] = "TrainTrack - Profilo Macchinista";
$templateParams["nome"] = "template/profilo-macchinista.php";
$templateParams["azione"] = "template/cambia-orario.php";

$email = $_SESSION["email"];
$user = $dbh->getUserByEmail($email);
$percorsi = $dbh->getPercorsi();

if(isset($_POST["cod_percorso"])){
    $stazioni = $dbh->getStazioniOfPercorso($_POST["cod_percorso"]);
}

require 'template/base.php';
?>