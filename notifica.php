<?php
require_once 'bootstrap.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['azione'], $_POST['id_notifica'])) {
        $id_notifica = $_POST['id_notifica'];
        $azione = $_POST['azione'];

        switch ($azione) {
            case 'segna_letta':
                $dbh->segnaNotificaLetta($id_notifica, $email);
                break;

            case 'cancella':
                $dbh->cancellaNotifica($id_notifica, $email);
                break;
        }

        header("Location: notifica.php");
        exit();
    }
}

$notifiche = $dbh->getNotificheByUtente($email);

$templateParams["notifiche"] = $notifiche;
$templateParams["titolo"] = "TrainTrack - Notifiche";
$templateParams["nome"] = "template/notifica.php";

require 'template/base.php';
?>