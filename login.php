<?php
require_once 'bootstrap.php';

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