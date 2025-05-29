<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'bootstrap.php';

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$templateParams = [
    'nome' => 'template/profilo-macchinista.php',
    'titolo' => 'TrainTrack - Profilo Macchinista',
    'azione' => 'template/aggiungi-percorso.php',
    'js' => ['js/aggiungi-percorso.js'],
    'user' => $dbh->getUserByEmail($_SESSION["email"]),
    'treni' => $dbh->getTreniDisponibili(),
    'stazioni' => $dbh->getStazioniDisponibili(),
    'macchinisti' => $dbh->getMacchinisti(),
];

if (
    isset($_POST["cod_percorso"]) &&
    isset($_POST["cod_treno"]) &&
    isset($_POST["email_macchinista"]) &&
    isset($_POST["tempo_percorrenza"]) &&
    isset($_POST["prezzo"])
) {
    list($cod_treno, $tipo_treno) = explode('|', $_POST['cod_treno']);

    if (empty($dbh->cercaPercorso($_POST["cod_percorso"]))) {
        $macchinista = $dbh->getUserByEmail($_POST["email_macchinista"]);

        if (!empty($macchinista) && !$dbh->isClient($_POST["email_macchinista"])) {
            $result = $dbh->creaPercorso(
                $_POST["cod_percorso"],
                $cod_treno,
                $_POST["email_macchinista"],
                $_POST["tempo_percorrenza"],
                $_POST["prezzo"]
            );

            if ($result) {
                $templateParams["successo"] = "Percorso aggiunto con successo!";
                $dbh->notificaNuovoPercorso(
                    "È stato registrato un nuovo percorso nel sistema, con codice " . $_POST["cod_percorso"],
                    $_POST["cod_percorso"]
                );
            } else {
                $templateParams["errore"] = "Si è verificato un errore. Prova più tardi";
            }
        } else {
            $templateParams["errore"] = "Macchinista non esistente";
        }
    } else {
        $templateParams["errore"] = "Codice percorso già esistente";
    }
}

require 'template/base.php';
?>
