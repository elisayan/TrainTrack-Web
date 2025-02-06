<?php
require_once 'bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['codice'])) {
    
    if($dbh->eliminaBuonoSconto($_SESSION['email'], $_POST['codice'])){
        header('Location: buoni-sconto.php?msg=success');
    } else {
        header('Location: buoni-sconto.php?msg=error');
    }
    exit();
}
?>