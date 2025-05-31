<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$templateParams["titolo"] = "TrainTrack - Profilo Macchinista";
$templateParams["nome"] = "template/profilo-macchinista.php";
$templateParams["azione"] = "template/aggiungi-percorso.php";
$templateParams["js"] = ['js/aggiungi-percorso.js'];

$email = $_SESSION["email"];
$templateParams["user"] = $dbh->getUserByEmail($email);
$templateParams["treni"] = $dbh->getTreniDisponibili();
$templateParams["stazioni"] = $dbh->getStazioniDisponibili();
$templateParams["macchinisti"] = $dbh->getMacchinisti();

if (
    isset($_POST["cod_percorso"]) &&
    isset($_POST["cod_treno"]) &&
    isset($_POST["email_macchinista"]) &&
    isset($_POST["tempo_percorrenza"]) &&
    isset($_POST["prezzo"]) &&
    isset($_POST["cod_stazione"]) && is_array($_POST["cod_stazione"]) &&
    isset($_POST["ordine"]) && is_array($_POST["ordine"]) &&
    isset($_POST["binario"]) && is_array($_POST["binario"]) &&
    isset($_POST["orario_partenza_previsto"]) && is_array($_POST["orario_partenza_previsto"]) &&
    isset($_POST["orario_arrivo_previsto"]) && is_array($_POST["orario_arrivo_previsto"])
) {
    list($codTreno, $tipoTreno) = explode('|', $_POST['cod_treno']);
    $codPercorso = $_POST["cod_percorso"];
    $percorsoEsistente = $dbh->cercaPercorso($codPercorso);

    if (!empty($percorsoEsistente)) {
        $templateParams["errore"] = "Codice percorso già esistente";
    } else {
        $emailMacchinista = $_POST["email_macchinista"];
        $macchinista = $dbh->getUserByEmail($emailMacchinista);
        if (empty($macchinista) || $dbh->isClient($emailMacchinista)) {
            $templateParams["errore"] = "Macchinista non valido";
        } else {
            $durata = $_POST["tempo_percorrenza"];
            $prezzo = $_POST["prezzo"];
            $resultPercorso = $dbh->creaPercorso(
                $codPercorso,
                $codTreno,
                $emailMacchinista,
                $durata,
                $prezzo
            );

            if ($resultPercorso) {
                $codStazioni = $_POST["cod_stazione"];
                $ordini = $_POST["ordine"];
                $binari = $_POST["binario"];
                $orariPartenza = $_POST["orario_partenza_previsto"];
                $orariArrivo = $_POST["orario_arrivo_previsto"];

                $resultStazioni = $dbh->aggiungiStazioniAttraversate(
                    $codPercorso,
                    $codStazioni,
                    $ordini,
                    $binari,
                    $orariPartenza,
                    $orariArrivo
                );

                if ($resultStazioni) {
                    $nomiStazioni = [];
                    foreach ($codStazioni as $codSt) {
                        $row = $dbh->getStazioneByCodice($codSt);
                        if ($row && isset($row['Nome'])) {
                            $nomiStazioni[] = $row['Nome'];
                        }
                    }
                    $listaNomi = implode(', ', $nomiStazioni);

                    $testoNotifica = sprintf(
                        "È stato registrato un nuovo percorso (Codice: %s). Stazioni attraversate: %s.",
                        $codPercorso,
                        $listaNomi
                    );

                    $dbh->notificaNuovoPercorso($testoNotifica, $codPercorso);

                    $templateParams["successo"] = "Percorso e stazioni aggiunti con successo! Notifica inviata.";
                } else {
                    $templateParams["errore"] = "Percorso creato, ma errore nell'inserimento delle stazioni";
                }
            } else {
                $templateParams["errore"] = "Errore durante la creazione del percorso";
            }
        }
    }
}

require 'template/base.php';
