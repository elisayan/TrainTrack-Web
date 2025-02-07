<?php
require_once 'bootstrap.php';

if(isset($_GET["departure-station"]) && isset($_GET["destination-station"]) && isset($_GET["duration"]) && isset($_GET["train-type"])){
    $departureStationSub = $_GET["departure-station"];
    $destinationStationSub = $_GET["destination-station"];
    $duration = $_GET["duration"];
    $trainType = $_GET["train-type"];
    $startDate = date('Y-m-d');
    
    $subscriptions = $dbh->getSubscriptions($departureStationSub, $destinationStationSub, $duration, $trainType);
    if(count($subscriptions)>0){
        

        $templateParams["titolo"] = "Risultati Ricerca Abbonamento";
        $templateParams["nome"] = "search-subscription-results.php";

        $templateParams["abbonamenti"] = $subscriptions;
    }
    else{
        $templateParams["titolo"] = "Abbonamento non trovato"; 
        $templateParams["abbonamenti"] = array();   
    }

}
else{
    
}

require 'template/base.php';
?>