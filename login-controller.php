<?php
require_once 'bootstrap.php';

if(isset($_POST["email"] && isset($_POST["password"]))){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errorelogin"] = "Errore! Username o password non validi";
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
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
}

require 'template/base.php';
?>