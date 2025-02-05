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

    public function getStazioneNome(){
        $query = "SELECT *
                    FROM Stazione";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
}
?>