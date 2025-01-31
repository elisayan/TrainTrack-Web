<?php
require_once 'bootstrap.php';

if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);

    echo "<pre>";
    print_r($login_result);
    echo "</pre>";

    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Username o password non validi";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}


if(isUserLoggedIn()){
    if($dbh->isClient($_SESSION["email"])) {
        header("Location: profilo-cliente.php");
        exit();
    } else {
        header("Location: profilo-macchinista.php");
        exit();
    }
} else{
    $templateParams["titolo"]="Traintrack - Login";
    $templateParams["nome"]="template/login.php";
}

/*if(isUserLoggedIn()){
    $result["logineseguito"] = true;
    
}

header('Content-Type: application/json');
echo json_encode($result);*/

/*if(isUserLoggedIn()){
    if(isClient()){
        $templateParams["titolo"] = "TrainTrack - Profilo";
        $templateParams["nome"] = "template/profilo-cliente.php";
    } else{
        $templateParams["titolo"] = "TrainTrack - Admin";
        $templateParams["nome"] = "template/profilo-macchinista.php";
    }
} else{
    $templateParams["titolo"]="Traintrack - Login";
    $templateParams["nome"]="template/login.php";
}*/

/*$templateParams["titolo"]="Traintrack - Login";
$templateParams["nome"]="template/login.php";*/

require 'template/base.php';
?>