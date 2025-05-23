<?php
    require_once 'bootstrap.php';

    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }
    
    $email = $_SESSION['email'];
    $persona = $dbh->getUserByEmail($email);
    $buoni = $dbh->getBuoniScontoNonUtilizzate($email);

    $templateParams["titolo"] = "TrainTrack - BuoniSconto";
    $templateParams["nome"] = "template/buoni-sconto.php";

    require 'template/base.php';
?>