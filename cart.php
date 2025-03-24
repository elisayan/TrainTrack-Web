<?php
require_once 'bootstrap.php';

$templateParams["nome"] = "cart.php";
$templateParams["titolo"] = "Carrello vuoto";
$templateParams["errorecarrello"] = "Carrello vuoto";
$templateParams["abbonamenti-selezionati"] = [];
$templateParams["biglietti-selezionati"] = [];
$templateParams["abbonamenti-presenti"]= "";
$templateParams["biglietti-presenti"]= "";


if (isset($_GET["stazione-partenza-sub"]) && isset($_GET["stazione-arrivo-sub"]) && isset($_GET["durata"]) && isset($_GET["tipo-treno"])) {
    $departureStationSub = $_GET["stazione-partenza-sub"];
    $destinationStationSub = $_GET["stazione-arrivo-sub"];
    $duration = $_GET["durata"];
    $trainType = $_GET["tipo-treno"];
    $price = $_GET["prezzo"];

    $itemId = $dbh->getSubscriptionID($departureStationSub, $destinationStationSub, $duration, $trainType);

    if (isset($_SESSION["email"])) {
        $email = $_SESSION["email"];
        $dbh->addToCartDb($email, $itemId, 1);
        $cartItems = $dbh->getCart(isset($_SESSION['email']) ? $_SESSION['email'] : null);

    } else {
        $email = null;
        addToCart($itemId, 1);
        $cartItems = getCartItems();
    }


    if(count($cartItems) > 0) {
        $templateParams["titolo"] = "Carrello";
        $templateParams["errorecarrello"] = "";
        $templateParams["abbonamenti-presenti"] = "Abbonamenti Selezionati";
        $templateParams["abbonamenti-selezionati"] = $cartItems;
        $templateParams["stazione-partenza-sub"] = $departureStationSub;
        $templateParams["stazione-arrivo-sub"] = $destinationStationSub;
        $templateParams["tipo-treno-sub"] = $trainType;
        $templateParams["durata"] = $duration;
        $templateParams["data-partenza-sub"] = date('Y-m-d');
        $templateParams["prezzo-sub"] = $price;

            
    }


} 

if (isset($_GET["stazione_partenza"]) && isset($_GET["stazione_arrivo"]) && isset($_GET["data_partenza"]) && isset($_GET["orario_partenza"]) && isset($_GET["numero_biglietti_adulti"]) && isset($_GET["numero_biglietti_bambini"])) {
    $departureStation = $_GET["stazione_partenza"];
    $destinationStation = $_GET["stazione_arrivo"];
    $departureDate = $_GET["data_partenza"];
    $departureTime = $_GET["orario_partenza"];
    $numberTickets = $_GET["numero_biglietti_adulti"] + $_GET["numero_biglietti_bambini"];

    $tickets_selected = $dbh->getTicketsSelectedBySearch($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets);

    if (count($tickets_selected) > 0) {
        $templateParams["titolo"] = "Carrello";
        $templateParams["errorecarrello"] = "";
        $templateParams["biglietti-presenti"] = "Biglietti Selezionati";
        $templateParams["biglietti-selezionati"] = $tickets_selected;
    } 
    
}

require 'template/base.php';
?>