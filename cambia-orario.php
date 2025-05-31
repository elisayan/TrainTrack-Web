<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$templateParams["titolo"] = "TrainTrack - Profilo Macchinista";
$templateParams["nome"] = "template/profilo-macchinista.php";
$templateParams["azione"] = "template/cambia-orario.php";

$email = $_SESSION["email"];
$user = $dbh->getUserByEmail($email);
$percorsi = $dbh->getPercorsi();

if (isset($_POST["cod_percorso"])) {
    $stazioni = $dbh->getStazioniOfPercorso($_POST["cod_percorso"]);

    if (
        isset($_POST["cod_stazione"])
        && isset($_POST["orario_partenza_previsto"])
        && isset($_POST["orario_arrivo_previsto"])
    ) {
        $codPercorso = $_POST["cod_percorso"];
        $codStazione = $_POST["cod_stazione"];
        $newPartenzaStr = $_POST["orario_partenza_previsto"];
        $newArrivoStr = $_POST["orario_arrivo_previsto"];

        $vecchiOrari = $dbh->cambiaOrario(
            $codPercorso,
            $codStazione,
            $newPartenzaStr,
            $newArrivoStr
        );

        if ($vecchiOrari !== false) {
            $oldPartenza = $vecchiOrari['oldPartenza'];
            $oldArrivo = $vecchiOrari['oldArrivo'];
            $newPartenza = $newPartenzaStr;
            $newArrivo = $newArrivoStr;

            $notificaResult = $dbh->notificaCambioOrario(
                $codPercorso,
                $codStazione,
                $oldPartenza,
                $oldArrivo,
                $newPartenza,
                $newArrivo
            );

            if ($notificaResult) {
                $templateParams["successo"] = "Modifiche salvate e notifica inviata correttamente!";
            } else {
                $templateParams["errore"] = "Modifiche salvate, ma errore durante l’invio della notifica!";
            }
        } else {
            $templateParams["errore"] = "Errore durante il salvataggio degli orari!";
        }
    }
}

require 'template/base.php';
?>