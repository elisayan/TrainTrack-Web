<?php
require_once 'bootstrap.php';

if(isset($_GET["departure-station"]) && isset($_GET["destination-station"]) && isset($_GET["duration"]) && isset($_GET["train-type"])){
    $departureStationSub = $_GET["departure-station"];
    $destinationStationSub = $_GET["destination-station"];
    $duration = $_GET["duration"];
    $trainType = $_GET["train-type"];
    
    $subscriptions = $dbh->getSubscriptions($departureStationSub, $destinationStationSub, $duration, $trainType);
    if(count($subscriptions)==0){
        $templateParams["errore_ricerca_abbonamento"] = "Abbonamento non trovato";
    }
    else{
        $templateParams["abbonamenti"] = $subscriptions; 
    }
} 

$templateParams["titolo"] = "TrainTrack - Ricerca Abbonamento";
$templateParams["nome"] = "template/search-subscription-home.php";
$templateParams["nome_stazioni"] = $dbh->getStations();
$templateParams["durate"] = $dbh->getDurations();
$templateParams["tipo_treni"] = $dbh->getTrainTypes();
$templateParams["js"] = array("js/search-sub.js");



require 'template/base.php';
?>