<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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