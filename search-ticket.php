<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Ricerca Biglietto";
$templateParams["nome"] = "search-ticket-home.php";
$templateParams["nome_stazioni"] = $dbh->getStations();
$templateParams["durate"] = $dbh->getDurations();
$templateParams["tipo_treni"] = $dbh->getTrainTypes();

require 'template/base.php';
?>