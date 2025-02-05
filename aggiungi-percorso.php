<?php
require_once 'bootstrap.php';

if (!isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

$templateParams["titolo"] = "TrainTrack - Profilo Macchinista";
$templateParams["nome"] = "template/profilo-macchinista.php";
$templateParams["azione"] = "template/aggiungi-percorso.php";

$email = $_SESSION["email"];
$user = $dbh->getUserByEmail($email);
$treni = $dbh->getTreniDisponibili();

if(isset($_POST["cod_percorso"]) && isset($_POST["cod_treno"]) && isset($_POST["email_macchinista"]) && isset($_POST["tempo_percorrenza"]) && isset($_POST["prezzo"])){
    $cod_treno = $_POST["cod_treno"];
    $posti_totali = null;
    
    foreach($treni as $treno) {
        if($treno['CodTreno'] === $cod_treno) {
            $posti_totali = $treno['PostiTotali'];
        }
    }
    
    if($posti_totali !== null) {
        if(empty($dbh->cercaPercorso($_POST["cod_percorso"]))) {
            $macchinista = $dbh->getUserByEmail($_POST["email_macchinista"]);
            if(!empty($macchinista) && !$dbh->isClient($_POST["email_macchinista"])){
                    $result = $dbh->creaPercorso(
                        $_POST["cod_percorso"], 
                        $cod_treno, 
                        $_POST["email_macchinista"],
                        $_POST["tempo_percorrenza"], 
                        $_POST["prezzo"], 
                        $posti_totali
                    );
                    if($result){
                        $templateParams["successo"] = "Percorso aggiunto con successo!";
                        $dbh->notificaNuovoPercorso("È stato registrato un nuovo percorso nel sistema, con codice " . $_POST["cod_percorso"], $_POST["cod_percorso"]);
                    } else {
                        $templateParams["errore"] = "Si è verificato un errore. Prova più tardi";
                    }
            } else {
                $templateParams["errore"] = "Macchinista non esistente";
            }
        } else {
            $templateParams["errore"] = "Codice percorso già esistente";
        }
    } else {
        $templateParams["errore"] = "Treno non valido";
    }
}

require 'template/base.php';
?>