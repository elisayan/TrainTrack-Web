<?php
require_once 'bootstrap.php';
$templateParams["titolo"] = "TrainTrack - Sign up";
$templateParams["nome"] = "template/register.php";
$templateParams["js"] = array("js/register.js");


if(isset($_POST["nome"], $_POST["cognome"], $_POST["cf"], $_POST["email"], $_POST["password"], $_POST["confirm_password"], $_POST["telefono"], $_POST["indirizzo"])) {
    if(empty($dbh->getUserByEmail($_POST["email"]))) {
        if ($_POST["password"] == $_POST["confirm_password"]) {
            $password = $_POST["password"];
            $errors = [];
            if (strlen($password) < 8) {
                $errors[] = "La password deve contenere almeno 8 caratteri.";
            }
            if (!preg_match('/\d/', $password)) {
                $errors[] = "La password deve contenere almeno un numero.";
            }
            if (!preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]+/', $password)) {
                $errors[] = "La password deve contenere almeno un carattere speciale.";
            }

            if (!empty($errors)) {
                $templateParams["errore_registrazione"] = implode("<br>", $errors);
            } else {
               $register_result = $dbh->registerUser($_POST["nome"], $_POST["cognome"], $_POST["cf"], $_POST["indirizzo"], $_POST["telefono"], $_POST["email"], $_POST["password"]);
                if($register_result) {
                    $templateParams["successo_registrazione"] = "Registrazione completata con successo! <a href='login.php'>Accedi ora</a>.";
                    $dbh->notificaBenvenuto($_POST["email"]);
                } 
            } 
        } else {
            $templateParams["errore_registrazione"] = "Si è verificato un errore. Riprova più tardi.";  
            }
    } else {
        $templateParams["errore_registrazione"] = "Email già in uso. Scegli un'altra email o accedi.";
       }
    }
            
require 'template/base.php';
?>
