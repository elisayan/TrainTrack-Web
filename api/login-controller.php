<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');

$response = [
    "logineseguito" => false,
    "errorelogin" => ""
];

if (isset($_POST["email"], $_POST["password"])) {
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);

    if (count($login_result) === 0) {
        $response["errorelogin"] = "Email o password non validi";
    } else {
        registerLoggedUser($login_result[0]);
        $response["logineseguito"] = true;
    }
}

echo json_encode($response);
exit();
