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
        $query ="SELECT 	s.codservizio as CodServizio,
	s.tipotreno as tipotreno,
	s.datapartenza as datapartenza,
	s.orariopartenza as orariopartenza,
	a2.data as dataarrivo,
	a2.orarioarrivoprevisto as orarioarrivo,
	(p.prezzo / (SELECT max(a.ordine)
	 	     FROM attraversato a
	 	     where a.codpercorso = s.codpercorso)
	 * (a2.ordine - a1.ordine)) as prezzo,
	(t.PostiTotali - (SELECT COUNT(*)
                      FROM Servizio s1
                      JOIN Stazione sp2 ON s1.stazionepartenza = sp2.codstazione 
                      JOIN Stazione sa2 ON s1.stazionearrivo = sa2.codstazione
                      WHERE s1.email != 'macchinista@traintrack.com' 
                      AND sp2.nome = ?
                      AND sa2.nome = ?
                      AND s1.datapartenza = s.datapartenza
                      AND s1.orariopartenza = s.orariopartenza)) as postidisponibili
FROM servizio s
join stazione sp on s.stazionepartenza = sp.codstazione
join stazione sa on s.stazionearrivo = sa.codstazione
join percorso p on s.codpercorso = p.codpercorso
join attraversato a1 on s.codpercorso = a1.codpercorso AND s.stazionepartenza = a1.codstazione AND s.datapartenza = a1.data
join attraversato a2 on s.codpercorso = a2.codpercorso AND s.stazionepartenza = a2.codstazione 
JOIN treno t ON p.codtreno = t.codtreno 
where s.email = 'macchinista@traintrack.com'
AND sp.nome = ?
AND sa.nome = ?
AND s.datapartenza >= ?
AND s.orariopartenza >= ?
AND (t.PostiTotali - (SELECT COUNT(*)
                      FROM Servizio s1
                      JOIN Stazione sp2 ON s1.stazionepartenza = sp2.codstazione 
                      JOIN Stazione sa2 ON s1.stazionearrivo = sa2.codstazione
                      WHERE s1.email != 'macchinista@traintrack.com' 
                      AND sp2.nome = ?
                      AND sa2.nome = ?
                      AND s1.datapartenza = s.datapartenza
                      AND s1.orariopartenza = s.orariopartenza)) > ?
        ORDER BY s.OrarioPartenza";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }

        $stmt->bind_param('ssssssssi', $departureStation, $destinationStation, $departureStation, $destinationStation, $departureDate, $departureTime, $departureStation, $destinationStation, $numberTickets);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTickets($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets, $n=-1){
        $query = "SELECT 	s.codservizio as CodServizio,
	s.tipotreno as tipotreno,
	s.datapartenza as datapartenza,
	s.orariopartenza as orariopartenza,
	a2.data as dataarrivo,
	a2.orarioarrivoprevisto as orarioarrivo,
	(p.prezzo / (SELECT max(a.ordine)
	 	     FROM attraversato a
	 	     where a.codpercorso = s.codpercorso)
	 * (a2.ordine - a1.ordine)) as prezzo,
	(t.PostiTotali - (SELECT COUNT(*)
                      FROM Servizio s1
                      JOIN Stazione sp2 ON s1.stazionepartenza = sp2.codstazione 
                      JOIN Stazione sa2 ON s1.stazionearrivo = sa2.codstazione
                      WHERE s1.email != 'macchinista@traintrack.com' 
                      AND sp2.nome = ?
                      AND sa2.nome = ?
                      AND s1.datapartenza = s.datapartenza
                      AND s1.orariopartenza = s.orariopartenza)) as postidisponibili
FROM servizio s
join stazione sp on s.stazionepartenza = sp.codstazione
join stazione sa on s.stazionearrivo = sa.codstazione
join percorso p on s.codpercorso = p.codpercorso
join attraversato a1 on s.codpercorso = a1.codpercorso AND s.stazionepartenza = a1.codstazione AND s.datapartenza = a1.data
join attraversato a2 on s.codpercorso = a2.codpercorso AND s.stazionepartenza = a2.codstazione 
join treno t ON p.codtreno = t.codtreno 
where s.email = 'macchinista@traintrack.com'
AND sp.nome = ?
AND sa.nome = ?
AND s.datapartenza >= ?
AND s.orariopartenza >= ?
AND (t.PostiTotali - (SELECT COUNT(*)
                      FROM Servizio s1
                      JOIN Stazione sp2 ON s1.stazionepartenza = sp2.codstazione 
                      JOIN Stazione sa2 ON s1.stazionearrivo = sa2.codstazione
                      WHERE s1.email != 'macchinista@traintrack.com' 
                      AND sp2.nome = ?
                      AND sa2.nome = ?
                      AND s1.datapartenza = s.datapartenza
                      AND s1.orariopartenza = s.orariopartenza)) > ?
                      ORDER BY s.orariopartenza";

        if ($n > 0) {
        $query .= " LIMIT ?";
        }

        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            die("Prepare failed: " . $this->db->error);
        }
        if ($n > 0) {
            $stmt->bind_param('ssssssssii', $departureStation, $destinationStation, $departureStation, $destinationStation, $departureDate, $departureTime, $departureStation, $destinationStation, $numberTickets, $n);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getSubscriptions($departureStationSub, $destinationStationSub, $duration, $trainType) {
        $query = "SELECT
                    sa.Nome AS stazionepartenzasub, 
                    sp.Nome AS stazionearrivosub, 
                    t.Tipo AS tipotreno,
                    s.Durata AS durata, 
                    ta.Prezzo AS prezzo,
                    s.Chilometraggio,
                    s.CodServizio
                  FROM Servizio s
                  JOIN TipoAbbonamento ta ON s.Durata = ta.Durata AND s.Chilometraggio = ta.Chilometraggio
                  JOIN Percorso p ON s.CodPercorso = p.CodPercorso
                  JOIN Treno t ON p.CodTreno = t.CodTreno
                  JOIN Stazione sp ON s.StazionePartenza = sp.CodStazione
                  JOIN Stazione sa ON s.StazioneArrivo = sa.CodStazione
                  WHERE ((sp.Nome = ? AND sa.Nome = ?) OR (sp.Nome = ? AND sa.Nome = ?))
                  AND s.Durata = ?
                  AND t.Tipo = ?
                  AND s.Durata IS NOT NULL
                  AND s.Chilometraggio IS NOT NULL
                  ORDER BY ta.Prezzo
                  LIMIT 1";
                  
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
                    WHERE ((s.StazionePartenza = ? AND s.StazioneArrivo = ?)
                    OR (s.StazionePartenza = ? AND s.StazioneArrivo = ?))
                    AND s.Durata = ?
                    AND s.TipoTreno = ?
                    AND s.email = 'macchinista@traintrack.com' ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $departureStationSub, $destinationStationSub, $destinationStationSub, $departureStationSub, $duration, $trainTypeSub);
        return $stmt->execute();
    }

    public function getTicketID($departureStation, $destinationStation, $departureDate, $departureTime, $trainType){
        $query = "SELECT s.CodServizio
                    FROM Servizio s
                    WHERE s.StazionePartenza = ?
                    AND s.StazioneArrivo = ?
                    AND s.DataPartenza = ?
                    AND s.OrarioPartenza = ?
                    AND s.TipoTreno = ? 
                    AND s.Email = 'macchinista@traintrack.com' ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssss');
        return $stmt->execute();
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