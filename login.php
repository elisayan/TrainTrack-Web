<?php
require_once 'bootstrap.php';

if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);

    if(count($login_result)==0){
        $templateParams["errorelogin"] = "Username o password non validi";
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
    $templateParams["titolo"]="Traintrack - Home";
    $templateParams["nome"]="template/login.php";
}

$templateParams["js"] = array("js/login.js");

require 'template/base.php';
?>