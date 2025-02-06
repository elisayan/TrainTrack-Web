<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " .$db->connect_error);
        }
    }

    public function getStations(){
        $query = "SELECT Nome as nome_stazioni FROM stazione ORDER BY Nome";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getDurations(){
        $query = "SELECT DISTINCT Durata as durate FROM TipoAbbonamento ORDER BY Durata DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTrainTypes(){
        $query = "SELECT DISTINCT Tipo as tipo_treni FROM Treno ORDER BY Tipo DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTicketsBySearch($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets){
        $query ="SELECT t.Tipo AS tipotreno,
                a1.Data AS datapartenza,
                a1.OrarioPartenzaPrevisto AS orariopartenza,
                a2.Data AS dataarrivo,
                a2.OrarioArrivoPrevisto AS orarioarrivo,
                p.Prezzo AS prezzo,
                p.PostiDisponibili AS postidisponibili,
        (SELECT MAX(a.Ordine)
        FROM Attraversato a
        WHERE a.CodPercorso = a1.CodPercorso) AS MaxOrdine,
        a2.Ordine - a1.Ordine AS NumeroStazioni
        FROM Attraversato a1
        JOIN Attraversato a2 ON a1.CodPercorso = a2.CodPercorso
        JOIN Stazione sp ON a1.CodStazione = sp.CodStazione
        JOIN Stazione sa ON a2.CodStazione = sa.CodStazione
        JOIN Percorso p ON a1.CodPercorso = p.CodPercorso
        JOIN Treno t ON p.CodTreno = t.CodTreno
        WHERE sp.Nome = ?
        AND sa.Nome = ?
        AND a1.Data = ?
        AND (a1.OrarioPartenzaPrevisto >= ? OR a1.OrarioPartenzaReale >= ?)
        AND a1.Ordine < a2.Ordine
        AND a1.Data <= a2.Data
        AND a1.OrarioPartenzaPrevisto < a2.OrarioArrivoPrevisto
        AND p.PostiDisponibili > ?
        ORDER BY a1.OrarioPartenzaPrevisto";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }

        $stmt->bind_param('sssssi', $departureStation, $destinationStation, $departureDate, $departureTime, $departureTime, $numberTickets);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTickets($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets, $n=-1){
        $query = "SELECT t.Tipo AS tipotreno,
                a1.Data AS datapartenza,
                a1.OrarioPartenzaPrevisto AS orariopartenza,
                a2.Data AS dataarrivo,
                a2.OrarioArrivoPrevisto AS orarioarrivo,
                p.Prezzo AS prezzo,
                p.PostiDisponibili AS postidisponibili,
        (SELECT MAX(a.Ordine)
        FROM Attraversato a
        WHERE a.CodPercorso = a1.CodPercorso) AS MaxOrdine,
        a2.Ordine - a1.Ordine AS NumeroStazioni
        FROM Attraversato a1
        JOIN Attraversato a2 ON a1.CodPercorso = a2.CodPercorso
        JOIN Stazione sp ON a1.CodStazione = sp.CodStazione
        JOIN Stazione sa ON a2.CodStazione = sa.CodStazione
        JOIN Percorso p ON a1.CodPercorso = p.CodPercorso
        JOIN Treno t ON p.CodTreno = t.CodTreno
        WHERE sp.Nome = ?
        AND sa.Nome = ?
        AND a1.Data = ?
        AND (a1.OrarioPartenzaPrevisto >= ? OR a1.OrarioPartenzaReale >= ?)
        AND a1.Ordine < a2.Ordine
        AND a1.Data <= a2.Data
        AND a1.OrarioPartenzaPrevisto < a2.OrarioArrivoPrevisto
        AND p.PostiDisponibili > ?
        ORDER BY a1.OrarioPartenzaPrevisto";

        if ($n > 0) {
        $query .= " LIMIT ?";
        }

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }
        if ($n > 0) {
            $stmt->bind_param('sssssii', $departureStation, $destinationStation, $departureDate, $departureTime, $departureTime, $numberTickets, $n);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubscriptions($departureStationSub, $destinationStationSub, $duration, $trainType){
        $query ="SELECT s.StazionePartenza, s.StazioneArrivo, s.TipoTreno AS tipotreno,
                s.Durata AS durata, t.Prezzo AS prezzo, s.Chilometraggio, s.CodPercorso
                FROM Servizio s
                JOIN TipoAbbonamento t ON s.Durata = t.Durata
                AND s.Chilometraggio = t.Chilometraggio
                WHERE (s.StazionePartenza = ? AND s.StazioneArrivo = ?
                OR s.StazionePartenza = ? AND s.StazioneArrivo = ?)
                AND s.Durata = ?
                AND s.TipoTreno = ?
                ORDER BY t.prezzo";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }

        $stmt->bind_param('ssssss', $departureStationSub, $destinationStationSub, $destinationStationSub, $departureStationSub, $duration, $trainType);

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>