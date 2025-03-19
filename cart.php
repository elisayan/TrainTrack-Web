<?php
require_once 'bootstrap.php';

// Initialize template parameters
$templateParams = [
    "titolo" => "Carrello vuoto",
    "nome" => "cart.php",
    "abbonamenti-selezionati" => [],
    "biglietti-selezionati" => [],
    "errore_carrello" => "Carrello vuoto"
];

// Check if the user is logged in
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
} else {
    $email = null;
}

// Handle subscription addition to the cart
if (isset($_GET["stazione-partenza-sub"]) && isset($_GET["stazione-arrivo-sub"]) && isset($_GET["durata"]) && isset($_GET["tipo-treno"])) {
    $departureStationSub = $_GET["stazione-partenza-sub"];
    $destinationStationSub = $_GET["stazione-arrivo-sub"];
    $duration = $_GET["durata"];
    $trainType = $_GET["tipo-treno"];

    // Retrieve or create the cart ID
    if (!isset($_SESSION["codcarello"])) {
        // Create a new cart if it doesn't exist
        $codcarrello = $dbh->addEmptyCart($email);
        if ($codcarrello) {
            $_SESSION["codcarello"] = $codcarrello;
        } else {
            die("Failed to create a new cart.");
        }
    } else {
        $codcarrello = $_SESSION["codcarello"];
    }

    // Add the subscription to the cart
    $subscriptionAdded = $dbh->addSubscriptionIntoCart($codcarrello, $departureStationSub, $destinationStationSub, $duration, $trainType);

    if ($subscriptionAdded) {
        // Fetch the updated cart contents
        $subscriptions_selected = $dbh->getSubscriptionsSelected($departureStationSub, $destinationStationSub, $duration, $trainType);

        if (count($subscriptions_selected) > 0) {
            $templateParams["titolo"] = "Carrello";
            $templateParams["abbonamenti-selezionati"] = $subscriptions_selected;
            $templateParams["errore_carrello"] = ""; // Clear error if there are selections
        }
    }
}

// Handle ticket addition to the cart
elseif (isset($_GET["stazione_partenza"]) && isset($_GET["stazione_arrivo"]) && isset($_GET["data_partenza"]) && isset($_GET["orario_partenza"]) && isset($_GET["numero_biglietti_adulti"]) && isset($_GET["numero_biglietti_bambini"])) {
    $departureStation = $_GET["stazione_partenza"];
    $destinationStation = $_GET["stazione_arrivo"];
    $departureDate = $_GET["data_partenza"];
    $departureTime = $_GET["orario_partenza"];
    $numberTickets = $_GET["numero_biglietti_adulti"] + $_GET["numero_biglietti_bambini"];

    // Fetch selected tickets
    $tickets_selected = $dbh->getTicketsSelectedBySearch($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets);

    if (count($tickets_selected) > 0) {
        $templateParams["titolo"] = "Carrello";
        $templateParams["biglietti-selezionati"] = $tickets_selected;
        $templateParams["errore_carrello"] = ""; // Clear error if there are selections
    }
}

// Default case: Empty cart
if (count($templateParams["abbonamenti-selezionati"]) == 0 && count($templateParams["biglietti-selezionati"]) == 0) {
    $templateParams["titolo"] = "Carrello vuoto";
    $templateParams["errore_carrello"] = "Carrello vuoto";
}

// Load the base template
require 'template/base.php';
?>