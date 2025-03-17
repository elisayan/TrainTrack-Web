<?php
require_once 'bootstrap.php';

if(isset($_GET["stazione-partenza"]) && isset($_GET["stazione-arrivo"]) && isset($_GET["durata"]) && isset($_GET["tipo-treno"]) && isset($_GET["data-partenza"])){
    $departureStationSub = $_GET["stazione-partenza"];
    $destinationStationSub = $_GET["stazione-arrivo"];
    $duration = $_GET["durata"];
    $trainType = $_GET["tipo-treno"];
    $startDate = date('Y-m-d');
    
    $subscriptions_selected = $dbh->getSubscriptionsSelected($departureStationSub, $destinationStationSub, $duration, $trainType);
    if(count($subscriptions_selected)>0){
        

        $templateParams["titolo"] = "Carrello";
        $templateParams["nome"] = "cart.php";

        $templateParams["abbonamenti-selezionati"] = $subscriptions_selected;
    }
    else{
        $templateParams["titolo"] = "Carrello vuoto"; 
        $templateParams["abbonamenti-selezionati"] = array(); 
        $templateParams["errore_carrello"] = "Carrello vuoto";
        $templateParams["nome"] = "cart.php";  
    }

}
else{
    $templateParams["titolo"] = "Carrello vuoto"; 
    $templateParams["abbonamenti-selezionati"] = array(); 
    $templateParams["errore_carrello"] = "Carrello vuoto";
    $templateParams["nome"] = "cart.php"; 
}


if(isset($_GET["stazione_partenza"]) && isset($_GET["stazione_arrivo"]) && isset($_GET["data_partenza"]) && isset($_GET["orario_partenza"]) && isset($_GET["numero_biglietti_adulti"]) && isset($_GET["numero_biglietti_bambini"])){
    $departureStation = $_GET["stazione_partenza"];
    $destinationStation = $_GET["stazione_arrivo"];
    $departureDate = $_GET["data_partenza"];
    $departureTime = $_GET["orario_partenza"];
    $numberTickets = $_GET["numero_biglietti_adulti"] + $_GET["numero_biglietti_bambini"];

    
    $tickets_selected = $dbh->getTicketsSelectedBySearch($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets);
    if(count($tickets_selected)>0){
        

        $templateParams["titolo"] = "Carrello";
        $templateParams["nome"] = "cart.php";

        $templateParams["biglietti"] = $dbh->getTicketsSelected($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets, 6);
    }
    else{
        $templateParams["titolo"] = "Carrello vuoto"; 
        $templateParams["biglietti-selezionati"] = array();   
        $templateParams["errore_carrello"] = "Carrello vuoto";
        $templateParams["nome"] = "cart.php";
    }


}
else{
    $templateParams["titolo"] = "Carrello vuoto"; 
    $templateParams["biglietti-selezionati"] = array();   
    $templateParams["errore_carrello"] = "Carrello vuoto";
    $templateParams["nome"] = "cart.php";
}

require 'template/base.php';
?>