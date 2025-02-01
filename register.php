<?php
require_once 'bootstrap.php';
$templateParams["titolo"] = "TrainTrack - Sign up";
$templateParams["nome"] = "template/register.php";

if(isset($_POST["nome"], $_POST["cognome"], $_POST["cf"], $_POST["email"], $_POST["password"], $_POST["confirm_password"], $_POST["telefono"], $_POST["indirizzo"])) {
    if(empty($dbh->getUserByEmail($_POST["email"]))) {
        if($_POST["password"] == $_POST["confirm_password"]) {
            $register_result = $dbh->registerUser($_POST["nome"], $_POST["cognome"], $_POST["cf"], $_POST["indirizzo"], $_POST["telefono"], $_POST["email"], $_POST["password"]);
            if($register_result) {
                header("Location: login.php");
                exit();
            } else {
                $templateParams["errore_registrazione"] = "Si è verificato un errore. Riprova più tardi.";  
            }
        } else {
            $templateParams["errore_registrazione"] = "La password e la conferma password non coincidono. Controlla e riprova.";
        }
    } else {
        $userDetails = $dbh->getUserByEmail($_POST["email"]);
        $templateParams["errore_registrazione"] = "Email già in uso. Scegli un'altra email o accedi.";

        // Stampa direttamente i dettagli dell'utente
        echo "<h3>Dettagli dell'utente esistente:</h3>";
        echo "<p>Nome: " . htmlspecialchars($userDetails["nome"]) . "</p>";
        echo "<p>Cognome: " . htmlspecialchars($userDetails["cognome"]) . "</p>";
        echo "<p>Email: " . htmlspecialchars($userDetails["email"]) . "</p>";
        $templateParams["errore_registrazione"] = "Email già in uso. Scegli un'altra email o accedi.";
    }
}

require 'template/base.php';
?>
