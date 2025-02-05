<?php
require_once 'bootstrap.php';

if(isset($_GET["stazione_partenza"]) && isset($_GET["stazione_arrivo"]) && isset($_GET["data_partenza"]) && isset($_GET["orario_partenza"]) && isset($_GET["numero_biglietti_adulti"]) && isset($_GET["numero_biglietti_bambini"])){
    $departureStation = $_GET["stazione_partenza"];
    $destinationStation = $_GET["stazione_arrivo"];
    $departureDate = $_GET["data_partenza"];
    $departureTime = $_GET["orario_partenza"];
    $numberTickets = $_GET["numero_biglietti_adulti"] + $_GET["numero_biglietti_bambini"];

    
    $tickets = $dbh->getTicketsBySearch($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets);
    if(count($tickets)>0){
        

        $templateParams["titolo"] = "Risultati Ricerca Biglietto";
        $templateParams["nome"] = "search-ticket-results.php";

        $templateParams["biglietti"] = $dbh->getTickets($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets, 6);
    }
    else{
        $templateParams["titolo_pagina"] = "Biglietto non trovato"; 
        $templateParams["biglietti"] = array();   
    }


}
else{
    
}

require 'template/base.php';
?>