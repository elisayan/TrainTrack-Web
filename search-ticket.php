<?php
require_once 'bootstrap.php';

if(isset($_GET["stazione_partenza"]) && isset($_GET["stazione_arrivo"]) && isset($_GET["data_partenza"]) && isset($_GET["orario_partenza"]) && isset($_GET["numero_biglietti_adulti"]) && isset($_GET["numero_biglietti_bambini"])){
    $departureStation = $_GET["stazione_partenza"];
    $destinationStation = $_GET["stazione_arrivo"];
    $departureDate = $_GET["data_partenza"];
    $departureTime = $_GET["orario_partenza"];
    $numberTickets = $_GET["numero_biglietti_adulti"] + $_GET["numero_biglietti_bambini"];

    $tickets = $dbh->getTicketsBySearch($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets);
    if(count($tickets)==0){
        $templateParams["errore_ricerca_biglietto"] = "Biglietto non trovato";
    }
    else{
        $templateParams["biglietti"] = $tickets; 
    }
}

$templateParams["titolo"] = "Ricerca Biglietto";
$templateParams["nome"] = "template/search-ticket-home.php";
$templateParams["nome_stazioni"] = $dbh->getStations();

require 'template/base.php';
?>