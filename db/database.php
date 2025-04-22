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
join attraversato a2 on s.codpercorso = a2.codpercorso AND s.stazionearrivo = a2.codstazione 
JOIN treno t ON p.codtreno = t.codtreno 
where s.email = 'macchinista@traintrack.com'
AND sp.nome = ?
AND sa.nome = ?
AND s.datapartenza >= ?
AND s.orariopartenza >= ?
AND s.datapartenza <= a2.data
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
        $query = "SELECT s.codservizio as CodServizio,
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
                    join attraversato a2 on s.codpercorso = a2.codpercorso AND s.stazionearrivo = a2.codstazione 
                    join treno t ON p.codtreno = t.codtreno 
                    where s.email = 'macchinista@traintrack.com'
                    AND sp.nome = ?
                    AND sa.nome = ?
                    AND s.datapartenza >= ?
                    AND s.orariopartenza >= ?
                    AND s.datapartenza <= a2.data
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

 
    public function addToCart($codServizio, $quantita, $email = null, $sessionId = null) {
            try {
                
                $codCarrello = $this->getOrCreateCart($email, $sessionId);
                if (!$codCarrello) {
                    return false;
                }
        
                // Check if item already exists in cart
                $stmt = $this->db->prepare("SELECT CodDettaglioCarrello, Quantità FROM DettaglioCarrello 
                                          WHERE CodCarrello = ? AND CodServizio = ?");
                $stmt->bind_param("ii", $codCarrello, $codServizio);
                $stmt->execute();
                $result = $stmt->get_result();
                $existingItem = $result->fetch_assoc();
        
                if ($existingItem) {
                    // Update quantity if item exists
                    $newQuantity = $existingItem['Quantità'] + $quantita;
                    $stmt = $this->db->prepare("UPDATE DettaglioCarrello SET Quantità = ? 
                                              WHERE CodDettaglioCarrello = ?");
                    $stmt->bind_param("ii", $newQuantity, $existingItem['CodDettaglioCarrello']);
                    $success = $stmt->execute();
                } else {
                    // Add new item
                    $stmt = $this->db->prepare("INSERT INTO DettaglioCarrello (CodServizio, Quantità, CodCarrello) 
                                              VALUES (?, ?, ?)");
                    $stmt->bind_param("iii", $codServizio, $quantita, $codCarrello);
                    $success = $stmt->execute();
                }
        
                // Update cart total price
                if ($success) {
                    $this->updateCartTotal($codCarrello);
                }
                
                return $success;
            } catch (Exception $e) {
                error_log("Error adding to cart: " . $e->getMessage());
                return false;
            }
        }
    
    public function removeFromCart($codDettaglioCarrello) {
            // Get cart ID FROM the item
        $stmt = $this->db->prepare("SELECT CodCarrello FROM DettaglioCarrello WHERE CodDettaglioCarrello = ?");
        $stmt->bind_param("i", $codDettaglioCarrello);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();
            
        if (!$item) {
            return false; // Item doesn't exist
        }
    
            // Delete the item
        $stmt = $this->db->prepare("DELETE FROM DettaglioCarrello WHERE CodDettaglioCarrello = ?");
        $stmt->bind_param("i", $codDettaglioCarrello);
        $success = $stmt->execute();
    
            // Update cart total price
        $this->updateCartTotal($item['CodCarrello']);
            
        return $success;
    }
    
        
    public function getCartItems($email = null, $sessionId = null) {
        $result = ['tickets' => [], 'subscriptions' => []];
            
            // Get cart ID
        $codCarrello = $this->getCartId($email, $sessionId);
        if (!$codCarrello) {
            return $result; // Empty cart
        }
    
            // Get all items in cart
        $stmt = $this->db->prepare("SELECT dc.CodDettaglioCarrello, dc.CodServizio, dc.Quantità, 
                                    s.Prezzo, s.Durata, s.Chilometraggio, s.TipoTreno,
                                    s.StazionePartenza, s.StazioneArrivo, s.DataPartenza, s.OrarioPartenza,
                                    sp.Nome AS NomePartenza, sa.Nome AS NomeArrivo, a2.data as DataArrivo, a2.orarioarrivoprevisto as OrarioArrivo,
                                    (t.PostiTotali - (SELECT COUNT(*)
                                            FROM Servizio s1
                                            JOIN Stazione sp2 ON s1.stazionepartenza = sp2.codstazione 
                                            JOIN Stazione sa2 ON s1.stazionearrivo = sa2.codstazione
                                            WHERE s1.email != 'macchinista@traintrack.com' 
                                            AND sp2.nome = sp.nome
                                            AND sa2.nome = sa.nome
                                            AND s1.datapartenza = s.datapartenza
                                            AND s1.orariopartenza = s.orariopartenza) - dc.quantità) as postidisponibili
                                    FROM DettaglioCarrello dc
                                    JOIN Servizio s ON dc.CodServizio = s.CodServizio
                                    JOIN Stazione sp ON s.StazionePartenza = sp.CodStazione
                                    JOIN Stazione sa ON s.StazioneArrivo = sa.CodStazione
                                    join attraversato a2 on s.codpercorso = a2.codpercorso AND s.stazionearrivo = a2.codstazione 
                                    join percorso p on s.codpercorso = p.codpercorso
                                    join treno t ON p.codtreno = t.codtreno 
                                    WHERE dc.CodCarrello = ?
                                    AND s.datapartenza <= a2.data");
        $stmt->bind_param("i", $codCarrello);
        $stmt->execute();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
        foreach ($items as $item) {
            if ($item['Durata'] !== null && $item['Chilometraggio'] !== null) {
                    // This is a subscription
                $result['subscriptions'][] = $item;
            } else {
                    // This is a ticket
                $result['tickets'][] = $item;
            }
        }
    
        return $result;
    }
    
        
    private function getOrCreateCart($email = null, $sessionId = null) {
            // Try to get existing cart
        $codCarrello = $this->getCartId($email, $sessionId);
            
        if ($codCarrello) {
            return $codCarrello;
        }
    
            // Create new cart
        $stmt = $this->db->prepare("INSERT INTO Carrello (Email, SessionID) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $sessionId);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }
            
        return false;
    }
    
        
    private function getCartId($email = null, $sessionId = null) {
        if ($email) {
                // For logged in users
            $stmt = $this->db->prepare("SELECT CodCarrello FROM Carrello WHERE Email = ?");
            $stmt->bind_param("s", $email);
        } elseif ($sessionId) {
                // For guests
            $stmt = $this->db->prepare("SELECT CodCarrello FROM Carrello WHERE SessionID = ?");
            $stmt->bind_param("s", $sessionId);
        } else {
            return false;
        }
    
        $stmt->execute();
        $result = $stmt->get_result();
        $cart = $result->fetch_assoc();
            
        return $cart ? $cart['CodCarrello'] : false;
    }
    
        
    public function updateCartTotal($codCarrello) {
            try {
                // Calculate new total
                $stmt = $this->db->prepare("SELECT SUM(dc.Quantità * s.Prezzo) AS Total
                                          FROM DettaglioCarrello dc
                                          JOIN Servizio s ON dc.CodServizio = s.CodServizio
                                          WHERE dc.CodCarrello = ?");
                $stmt->bind_param("i", $codCarrello);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $total = $row['Total'] ?? 0;
        
                // Update cart
                $stmt = $this->db->prepare("UPDATE Carrello SET PrezzoTotale = ? WHERE CodCarrello = ?");
                $stmt->bind_param("di", $total, $codCarrello);
                return $stmt->execute();
            } catch (Exception $e) {
                error_log("Error updating cart total: " . $e->getMessage());
                return false;
            }
        }
    
        
    public function transferGuestCart($sessionId, $email) {
            // Check if user already has a cart
        $userCartId = $this->getCartId($email);
        $guestCartId = $this->getCartId(null, $sessionId);
    
        if (!$guestCartId) {
            return true; // No guest cart to transfer
        }
    
        if ($userCartId) {
                // Merge guest cart into user's existing cart
            $stmt = $this->db->prepare("UPDATE DettaglioCarrello SET CodCarrello = ? 
                                          WHERE CodCarrello = ?");
            $stmt->bind_param("ii", $userCartId, $guestCartId);
            $stmt->execute();
    
                // Delete guest cart
            $stmt = $this->db->prepare("DELETE FROM Carrello WHERE CodCarrello = ?");
            $stmt->bind_param("i", $guestCartId);
            $stmt->execute();
    
                // Update user cart total
            $this->updateCartTotal($userCartId);
        } else {
                // Simply assign guest cart to user
            $stmt = $this->db->prepare("UPDATE Carrello SET Email = ?, SessionID = NULL 
                                          WHERE CodCarrello = ?");
            $stmt->bind_param("si", $email, $guestCartId);
            $stmt->execute();
        }
    
        return true;
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
                    SELECT (SELECT CodNotifica FROM Notifica WHERE CodNotifica = 'NOT001'), Email 
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