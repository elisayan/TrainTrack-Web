<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$user = $dbh->getUserByEmail($_SESSION["email"]);

$percorsi = $dbh->getPercorsiByMacchinista($_SESSION["email"]);

$templateParams = [
    'nome'     => 'template/percorsi.php',
    'titolo'   => 'TrainTrack - I miei percorsi',
    'js'       => [],
    'user'     => $user,
    'percorsi' => $percorsi
];

require 'template/base.php';
?>
