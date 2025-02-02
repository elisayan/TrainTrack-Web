<?php
require_once 'bootstrap.php';

$response = ["logineseguito" => false, "errorelogin" => ""]; // Inizializza la risposta JSON

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);

    if (count($login_result) == 0) {
        $response["errorelogin"] = "Errore! Email o password non validi";
    } else {
        registerLoggedUser($login_result[0]);
        $response["logineseguito"] = true;
    }
}

header('Content-Type: application/json');
echo json_encode($response);
exit();

require 'template/base.php';
?>