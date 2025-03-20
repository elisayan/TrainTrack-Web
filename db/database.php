<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " .$this->db->connect_error);
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

    public function getSubscriptionID($departureStationSub, $destinationStationSub, $duration, $trainTypeSub){
        $query = "SELECT s.codservizio
                    FROM Servizio s
                    JOIN TipoAbbonamento t ON s.Durata = t.Durata
                    AND s.Chilometraggio = t.Chilometraggio
                    WHERE (s.StazionePartenza = ? AND s.StazioneArrivo = ?
                    OR s.StazionePartenza = ? AND s.StazioneArrivo = ?)
                    AND s.Durata = ?
                    AND s.TipoTreno = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $departureStationSub, $destinationStationSub, $destinationStationSub, $departureStationSub, $duration, $trainTypeSub);
        return $stmt->execute();
    }

    function addToCartDb($email, $itemId, $quantity) {

        $query = "SELECT CodCarello FROM carello WHERE Email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $codCarello = $row['CodCarello'];
        } else {
            $query = "INSERT INTO carello (Email) VALUES (?)";
            $stmt = $dbh->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $codCarello = $stmt->insert_id;
        }
    
        $query = "INSERT INTO dettagliocarello (CodCarello, CodServizio, Quantità) VALUES (?, ?, ?)
                  ON DUPLICATE KEY UPDATE Quantità = Quantità + ?";
        $stmt = $dbh->prepare($query);
        $stmt->bind_param('iiii', $codCarello, $itemId, $quantity, $quantity);
        $stmt->execute();
    }


    function getCart($email = null) {
        if ($email) {
            $query = "SELECT dc.CodServizio, dc.Quantità, s.Prezzo 
                      FROM dettagliocarello dc
                      JOIN Servizio s ON dc.CodServizio = s.CodServizio
                      JOIN carello c ON dc.CodCarello = c.CodCarello
                      WHERE c.Email = ?";
            $stmt = $dbh->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            $cartItems = [];
            foreach ($_SESSION['cart'] as $itemId => $quantity) {
                $query = "SELECT CodServizio, Prezzo FROM Servizio WHERE CodServizio = ?";
                $stmt = $dbh->prepare($query);
                $stmt->bind_param('i', $itemId);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                if ($row) {
                    $cartItems[] = [
                        'CodServizio' => $row['CodServizio'],
                        'Quantità' => $quantity,
                        'Prezzo' => $row['Prezzo']
                    ];
                }
            }
            return $cartItems;
        }
    }

    function mergeCarts($email) {
    
        $sessionCart = $_SESSION['cart'];
    
        $query = "SELECT CodCarello FROM carello WHERE Email = ?";
        $stmt = $dbh->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $codCarello = $row['CodCarello'];
        } else {
            // Create a new cart for the user
            $query = "INSERT INTO carello (Email) VALUES (?)";
            $stmt = $dbh->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $codCarello = $stmt->insert_id;
        }
    
        foreach ($sessionCart as $itemId => $quantity) {
            $query = "INSERT INTO dettagliocarello (CodCarello, CodServizio, Quantità) VALUES (?, ?, ?)
                      ON DUPLICATE KEY UPDATE Quantità = Quantità + ?";
            $stmt = $dbh->prepare($query);
            $stmt->bind_param('iiii', $codCarello, $itemId, $quantity, $quantity);
            $stmt->execute();
        }
    
        $_SESSION['cart'] = [];
    }


    public function checkLogin($email, $password){
        $query = "SELECT * FROM persona WHERE email=? AND password=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss',$email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isClient($email){
        $query = "SELECT tipopersona FROM persona WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $result = $result->fetch_all(MYSQLI_ASSOC)[0]["tipopersona"];
        if ($result == "cliente") {
            return true;
        }
        return false;
    }

    public function registerUser($nome, $cognome, $cf, $indirizzo, $telefono, $email, $password){
        $query = "INSERT INTO  persona (Nome, Cognome, CF, Indirizzo, Telefono, Email, Password, SpesaTotale, TipoPersona, TipoCliente)
                    VALUES (?, ?, ?, ?, ?, ?, ?, 0, 'cliente', 'utente')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssss', $nome, $cognome, $cf, $indirizzo, $telefono, $email, $password);
        return $stmt->execute();
    }

    public function getUserByEmail($email) {
        $query = "SELECT * FROM persona WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTicketOrders($email) {
        $query ="
            SELECT 
                s.CodServizio,
                s.NomePasseggero,
                s.CognomePasseggero,
                s.CodPercorso,
                s.StazionePartenza,
                s.StazioneArrivo,
                s.TipoTreno,
                s.DataPartenza,
                s.OrarioPartenza,
                s.Prezzo
            FROM Servizio s
            JOIN Persona p ON s.Email = p.Email
            WHERE p.Email = ?
            AND s.Durata IS NULL
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_Param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function getSubscriptionOrders($email) {
        $query ="
            SELECT 
                s.CodServizio,
                s.NomePasseggero,
                s.CognomePasseggero,
                s.StazionePartenza,
                s.StazioneArrivo,
                s.TipoTreno,
                s.DataPartenza AS DataInizio,
                s.Durata,
                s.Chilometraggio,
                t.Prezzo
            FROM Servizio s
            JOIN Persona p ON s.Email = p.Email
            JOIN TipoAbbonamento t ON s.Durata = t.Durata AND s.Chilometraggio = t.Chilometraggio
            WHERE p.Email = ?
            AND s.Durata IS NOT NULL
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_Param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotificheByUtente($email) {
        $query = "SELECT n.CodNotifica, n.Descrizione, sn.Letto
              FROM Notifica n
              JOIN StatoNotifica sn ON n.CodNotifica = sn.CodNotifica
              JOIN Persona p ON sn.Email = p.Email
              WHERE p.TipoPersona = 'cliente' AND p.Email = ?
              ORDER BY n.CodNotifica DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_Param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function segnaNotificaLetta($notifica, $email){
        $query = "UPDATE StatoNotifica SN
                    SET SN.Letto = TRUE
                    WHERE SN.CodNotifica = ? AND SN.Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_Param('ss', $notifica, $email);
        return $stmt->execute();
    }

    public function cancellaNotifica($notifica, $email) {
        $query = "DELETE sn 
                  FROM StatoNotifica sn
                  WHERE sn.CodNotifica = ? 
                  AND sn.Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $notifica, $email);
        return $stmt->execute();
    }

    public function notificaBenvenuto($email){
        $query = "INSERT INTO StatoNotifica (CodNotifica, Email)
                    SELECT 1, Email 
                    FROM Persona 
                    WHERE TipoPersona = 'cliente' AND 
                        TipoCliente = 'utente' AND
                        Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        return $stmt->execute();
    }

    public function getTreniDisponibili(){
        $query = "SELECT *  FROM Treno";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function creaPercorso($codicePercorso, $codiceTreno, $email, $durata, $prezzo, $posti){
        $query = "INSERT INTO Percorso (CodPercorso, CodTreno, Email, TempoPercorrenza, Prezzo, PostiDisponibili) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssidi', $codicePercorso, $codiceTreno, $email, $durata, $prezzo, $posti);
        return $stmt->execute();
    }

    public function cercaPercorso($codicePercorso){
        $query = "SELECT codPercorso
                    FROM Percorso
                    WHERE codPercorso = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_Param('s', $codicePercorso);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function notificaNuovoPercorso($testo, $percorso) {
        $query = "INSERT INTO Notifica (Descrizione, CodPercorso) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $testo, $percorso);
        
        if (!$stmt->execute()) {
            return false;
        }
    
        $codNotifica = $this->db->insert_id;
    
        $queryStato = "INSERT INTO StatoNotifica (CodNotifica, Email, Letto)
                       SELECT ?, Email, FALSE
                       FROM Persona
                       WHERE TipoPersona = 'cliente' AND TipoCliente = 'utente'";
    
        $stmtStato = $this->db->prepare($queryStato);
        $stmtStato->bind_param('i', $codNotifica);
        
        return $stmtStato->execute();
    }

    public function aggiungiStazioniAttraversate(){
        
    }

    public function cambiaOrario($percorso, $stazione, $orario_partenza, $orario_arrivo){
        $query = "UPDATE Attraversato
                    SET OrarioPartenzaPrevisto = ?,
                        OrarioArrivoPrevisto = ?
                    WHERE CodPercorso = ?
                    AND CodStazione = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $orario_partenza, $orario_arrivo, $percorso, $stazione);
        return $stmt->execute();
    }

    public function getPercorsi(){
        $query = "SELECT CodPercorso
                    FROM Percorso";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStazioniOfPercorso($codicePercorso){
        $query = "SELECT s.Nome, s.CodStazione
                    FROM Attraversato a
                    JOIN Stazione s ON a.CodStazione = s.CodStazione
                    WHERE a.CodPercorso = ? 
                    ORDER BY a.Ordine";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $codicePercorso);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBuoniScontoNonUtilizzate($email){
        $query = "SELECT *
                  FROM BuonoSconto
                  WHERE Email = ? 
                  AND CodBuonoSconto NOT IN (SELECT CodBuonoSconto
                                                FROM Utilizzo)
                  ORDER BY CodBuonoSconto DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function eliminaBuonoSconto($email, $buonoSconto) {
        $queryUtilizzo = "DELETE FROM Utilizzo WHERE CodBuonoSconto = ?";
        $stmtUtilizzo = $this->db->prepare($queryUtilizzo);
        $stmtUtilizzo->bind_param('i', $buonoSconto);
        $stmtUtilizzo->execute();
        
        $queryBuono = "DELETE FROM BuonoSconto WHERE CodBuonoSconto = ? AND Email = ?";
        $stmtBuono = $this->db->prepare($queryBuono);
        $stmtBuono->bind_param('is', $buonoSconto, $email);
        
        return $stmtBuono->execute();
    }
    


}
?>