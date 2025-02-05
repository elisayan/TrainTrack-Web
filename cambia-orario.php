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
    if(isset($_POST["cod_stazione"]) && isset($_POST["orario_arrivo_previsto"]) && isset($_POST["orario_partenza_previsto"])){
        $result = $dbh->cambiaOrario($_POST["cod_percorso"], $_POST["cod_stazione"], $_POST["orario_partenza_previsto"], $_POST["orario_arrivo_previsto"]);
        if($result){
            $templateParams["successo"] = "Modifiche salvate correttamente!";
        } else{
            $templateParams["errore"] = "Errore durante il salvataggio!";
        }
    }
}

require 'template/base.php';
?>