<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "Ricerca Abbonamento";
$templateParams["nome"] = "search-subscription-home.php";
$templateParams["nome_stazioni"] = $dbh->getStations();
$templateParams["durate"] = $dbh->getDurations();
$templateParams["tipo_treni"] = $dbh->getTrainTypes();


require 'template/base.php';
?>