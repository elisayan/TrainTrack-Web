<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    // public function __construct() {
    //     // XAMPP MySQL defaults su macOS
    //     $servername = '127.0.0.1';
    //     $username   = 'root';
    //     $password   = '';         // password vuota di default
    //     $dbname     = 'traintrack';
    //     $port       = 3306;       // porta MySQL di XAMPP

    //     $this->db = new mysqli(
    //         $servername,
    //         $username,
    //         $password,
    //         $dbname,
    //         $port
    //     );

    //     if ($this->db->connect_error) {
    //         die("Connection failed: " . $this->db->connect_error);
    //     }
    // }

    public function getStations()
    {
        $query = "SELECT Nome as nome_stazioni FROM stazione ORDER BY Nome";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getDurations()
    {
        $query = "SELECT DISTINCT Durata as durate FROM TipoAbbonamento ORDER BY Durata DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTrainTypes()
    {
        $query = "SELECT DISTINCT Tipo as tipo_treni FROM Treno ORDER BY Tipo DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTicketsBySearch($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets)
    {
        $query = "SELECT 	s.codservizio as CodServizio,
	s.tipotreno as tipotreno,
	s.datapartenza as datapartenza,
	s.orariopartenza as orariopartenza,
	a2.data as dataarrivo,
	a2.orarioarrivoprevisto as orarioarrivo,
	s.prezzo,
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

    public function getTickets($departureStation, $destinationStation, $departureDate, $departureTime, $numberTickets, $n = -1)
    {
        $query = "SELECT s.codservizio as CodServizio,
	                     s.tipotreno as tipotreno,
	                     s.datapartenza as datapartenza,
	                     s.orariopartenza as orariopartenza,
	                     a2.data as dataarrivo,
                    	 a2.orarioarrivoprevisto as orarioarrivo,
	                     s.prezzo,
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

    public function getSubscriptions($departureStationSub, $destinationStationSub, $duration, $trainType)
    {
        $query = "SELECT
                    sa.Nome AS stazionepartenzasub, 
                    sp.Nome AS stazionearrivosub, 
                    t.Tipo AS tipotreno,
                    s.Durata AS durata, 
                    ta.Prezzo AS prezzo,
                    s.Chilometraggio,
                    s.CodServizio as CodServizio
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
                  AND s.DataPartenza >= CURDATE()
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

    public function getSubscriptionID($departureStationSub, $destinationStationSub, $duration, $trainTypeSub)
    {
        $query = "SELECT s.codservizio
                    FROM Servizio s
                    JOIN TipoAbbonamento t ON s.Durata = t.Durata
                    AND s.Chilometraggio = t.Chilometraggio
                    WHERE ((s.StazionePartenza = ? AND s.StazioneArrivo = ?)
                    OR (s.StazionePartenza = ? AND s.StazioneArrivo = ?))
                    AND s.Durata = ?
                    AND s.TipoTreno = ?
                    AND s.datapartenza >= CURDATE()
                    AND s.email = 'macchinista@traintrack.com' ";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $departureStationSub, $destinationStationSub, $destinationStationSub, $departureStationSub, $duration, $trainTypeSub);
        return $stmt->execute();
    }

    public function getTicketID($departureStation, $destinationStation, $departureDate, $departureTime, $trainType)
    {
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


    public function addToCart($codServizio, $quantita, $email = null, $sessionId = null)
    {
        try {

            $codCarrello = $this->getOrCreateCart($email, $sessionId);
            if (!$codCarrello) {
                return false;
            }

            $stmt = $this->db->prepare("SELECT CodDettaglioCarrello, Quantità FROM DettaglioCarrello 
                                          WHERE CodCarrello = ? AND CodServizio = ?");
            $stmt->bind_param("ii", $codCarrello, $codServizio);
            $stmt->execute();
            $result = $stmt->get_result();
            $existingItem = $result->fetch_assoc();

            if ($existingItem) {
                $newQuantity = $existingItem['Quantità'] + $quantita;
                $stmt = $this->db->prepare("UPDATE DettaglioCarrello SET Quantità = ? 
                                              WHERE CodDettaglioCarrello = ?");
                $stmt->bind_param("ii", $newQuantity, $existingItem['CodDettaglioCarrello']);
                $success = $stmt->execute();
            } else {
                $stmt = $this->db->prepare("INSERT INTO DettaglioCarrello (CodServizio, Quantità, CodCarrello) 
                                              VALUES (?, ?, ?)");
                $stmt->bind_param("iii", $codServizio, $quantita, $codCarrello);
                $success = $stmt->execute();
            }

            if ($success) {
                $this->updateCartTotal($codCarrello);
            }

            return $success;
        } catch (Exception $e) {
            error_log("Error adding to cart: " . $e->getMessage());
            return false;
        }
    }

    public function removeFromCart($codDettaglioCarrello)
    {
        $stmt = $this->db->prepare("SELECT CodCarrello FROM DettaglioCarrello WHERE CodDettaglioCarrello = ?");
        $stmt->bind_param("i", $codDettaglioCarrello);
        $stmt->execute();
        $result = $stmt->get_result();
        $item = $result->fetch_assoc();

        if (!$item) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM DettaglioCarrello WHERE CodDettaglioCarrello = ?");
        $stmt->bind_param("i", $codDettaglioCarrello);
        $success = $stmt->execute();

        $this->updateCartTotal($item['CodCarrello']);

        return $success;
    }


    public function getCartItems($email = null, $sessionId = null)
    {
        $result = ['tickets' => [], 'subscriptions' => []];

        $codCarrello = $this->getCartId($email, $sessionId);
        if (!$codCarrello) {
            return $result;
        }
        $stmt = $this->db->prepare("SELECT dc.CodDettaglioCarrello, dc.CodServizio as CodServizio, dc.Quantità, 
                                    s.Prezzo, s.Durata, s.Chilometraggio, s.TipoTreno,
                                    s.StazionePartenza, s.StazioneArrivo, s.DataPartenza, s.OrarioPartenza,
                                    sp.Nome AS NomePartenza, sa.Nome AS NomeArrivo, a2.data as DataArrivo, a2.orarioarrivoprevisto as OrarioArrivo, 
                                    s.CodPercorso,
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
                                    AND s.datapartenza <= a2.data
                                    AND s.datapartenza >= CURDATE()");
        $stmt->bind_param("i", $codCarrello);
        $stmt->execute();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($items as $item) {
            if ($item['Durata'] !== null && $item['Chilometraggio'] !== null) {
                $result['subscriptions'][] = $item;
            } else {
                $result['tickets'][] = $item;
            }
        }

        return $result;
    }


    private function getOrCreateCart($email = null, $sessionId = null)
    {
        $codCarrello = $this->getCartId($email, $sessionId);

        if ($codCarrello) {
            return $codCarrello;
        }

        $stmt = $this->db->prepare("INSERT INTO Carrello (Email, SessionID) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $sessionId);
        if ($stmt->execute()) {
            return $this->db->insert_id;
        }

        return false;
    }


    private function getCartId($email = null, $sessionId = null)
    {
        if ($email) {
            $stmt = $this->db->prepare("SELECT CodCarrello FROM Carrello WHERE Email = ?");
            $stmt->bind_param("s", $email);
        } elseif ($sessionId) {
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


    public function updateCartTotal($codCarrello)
    {
        try {
            $stmt = $this->db->prepare("SELECT SUM(dc.Quantità * s.Prezzo) AS Total
                                          FROM DettaglioCarrello dc
                                          JOIN Servizio s ON dc.CodServizio = s.CodServizio
                                          WHERE dc.CodCarrello = ?");
            $stmt->bind_param("i", $codCarrello);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $total = $row['Total'] ?? 0;

            $stmt = $this->db->prepare("UPDATE Carrello SET PrezzoTotale = ? WHERE CodCarrello = ?");
            $stmt->bind_param("di", $total, $codCarrello);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Error updating cart total: " . $e->getMessage());
            return false;
        }
    }


    // public function transferGuestCart($sessionId, $email) {
    //         // Check if user already has a cart
    //     $userCartId = $this->getCartId($email);
    //     $guestCartId = $this->getCartId(null, $sessionId);

    //     if (!$guestCartId) {
    //         return true; // No guest cart to transfer
    //     }

    //     if ($userCartId) {
    //             // Merge guest cart into user's existing cart
    //         $stmt = $this->db->prepare("UPDATE DettaglioCarrello SET CodCarrello = ? 
    //                                       WHERE CodCarrello = ?");
    //         $stmt->bind_param("ii", $userCartId, $guestCartId);
    //         $stmt->execute();

    //             // Delete guest cart
    //         $stmt = $this->db->prepare("DELETE FROM Carrello WHERE CodCarrello = ?");
    //         $stmt->bind_param("i", $guestCartId);
    //         $stmt->execute();

    //             // Update user cart total
    //         $this->updateCartTotal($userCartId);
    //     } else {
    //             // Simply assign guest cart to user
    //         $stmt = $this->db->prepare("UPDATE Carrello SET Email = ?, SessionID = NULL 
    //                                       WHERE CodCarrello = ?");
    //         $stmt->bind_param("si", $email, $guestCartId);
    //         $stmt->execute();
    //     }

    //     return true;
    // }

    public function transferGuestCart(string $sessionId, string $email): bool
    {
        $userCartId = $this->getCartId($email);
        $guestCartId = $this->getCartId(null, $sessionId);

        if (!$guestCartId) {
            return true;
        }

        if ($userCartId && $userCartId === $guestCartId) {
            $stmt = $this->db->prepare(
                "UPDATE Carrello
                    SET SessionID = NULL
                WHERE CodCarrello = ?"
            );
            $stmt->bind_param("i", $guestCartId);
            $stmt->execute();
            $stmt->close();
            return true;
        }

        if ($userCartId) {
            $stmt = $this->db->prepare(
                "UPDATE DettaglioCarrello
                    SET CodCarrello = ?
                WHERE CodCarrello = ?"
            );
            $stmt->bind_param("ii", $userCartId, $guestCartId);
            $stmt->execute();
            $stmt->close();

            $stmt = $this->db->prepare(
                "DELETE FROM Carrello
                WHERE CodCarrello = ?"
            );
            $stmt->bind_param("i", $guestCartId);
            $stmt->execute();
            $stmt->close();

            $this->updateCartTotal($userCartId);

        } else {
            $stmt = $this->db->prepare(
                "UPDATE Carrello
                    SET Email = ?, SessionID = NULL
                WHERE CodCarrello = ?"
            );
            $stmt->bind_param("si", $email, $guestCartId);
            $stmt->execute();
            $stmt->close();
        }

        return true;
    }

    public function checkLogin($email, $password)
    {
        $query = "SELECT * FROM persona WHERE email=? AND password=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function isClient($email)
    {
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

    public function registerUser($nome, $cognome, $cf, $indirizzo, $telefono, $email, $password)
    {
        $query = "INSERT INTO  persona (Nome, Cognome, CF, Indirizzo, Telefono, Email, Password, SpesaTotale, TipoPersona, TipoCliente)
                    VALUES (?, ?, ?, ?, ?, ?, ?, 0, 'cliente', 'utente')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssssss', $nome, $cognome, $cf, $indirizzo, $telefono, $email, $password);
        return $stmt->execute();
    }

    public function getUserByEmail($email)
    {
        $query = "SELECT * FROM persona WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMacchinisti()
    {
        $query = "SELECT Email FROM Persona WHERE TipoPersona = 'macchinista'";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            throw new Exception("Errore prepare(): " . $this->db->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $emails = [];
        while ($row = $result->fetch_assoc()) {
            $emails[] = $row['Email'];
        }
        return $emails;
    }

    public function getPercorsiByMacchinista($email)
    {
        $sql = "SELECT CodPercorso, CodTreno, TempoPercorrenza, Prezzo
                FROM Percorso
                WHERE Email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    public function getTicketOrders($email)
    {
        $query = "
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

    public function getSubscriptionOrders($email)
    {
        $query = "
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

    public function getNotificheByUtente($email)
    {
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

    public function segnaNotificaLetta($notifica, $email)
    {
        $query = "UPDATE StatoNotifica SN
                    SET SN.Letto = TRUE
                    WHERE SN.CodNotifica = ? AND SN.Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_Param('ss', $notifica, $email);
        return $stmt->execute();
    }

    public function cancellaNotifica($notifica, $email)
    {
        $query = "DELETE sn 
                  FROM StatoNotifica sn
                  WHERE sn.CodNotifica = ? 
                  AND sn.Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $notifica, $email);
        return $stmt->execute();
    }

    public function notificaBenvenuto($email)
    {
        $query = "INSERT INTO StatoNotifica (CodNotifica, Email)
                    SELECT (SELECT CodNotifica FROM Notifica WHERE CodNotifica = '1'), Email 
                    FROM Persona 
                    WHERE TipoPersona = 'cliente' AND 
                        TipoCliente = 'utente' AND
                        Email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        return $stmt->execute();
    }

    public function getTreniDisponibili()
    {
        $query = "SELECT *  FROM Treno";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStazioniDisponibili()
    {
        $query = "SELECT *  FROM Stazione";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStazioneByCodice($codStazione)
    {
        $query = "SELECT CodStazione, Nome FROM Stazione WHERE CodStazione = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return null;
        }
        $stmt->bind_param('s', $codStazione);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();
        return $row ?: null;
    }

    public function creaPercorso($codicePercorso, $codiceTreno, $email, $durata, $prezzo)
    {
        $query = "INSERT INTO Percorso
                    (CodPercorso, CodTreno, Email, TempoPercorrenza, Prezzo)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'sssii',
            $codicePercorso,
            $codiceTreno,
            $email,
            $durata,
            $prezzo
        );
        return $stmt->execute();
    }

    public function cercaPercorso($codicePercorso)
    {
        $query = "SELECT codPercorso
                    FROM Percorso
                    WHERE codPercorso = ?";

        $stmt = $this->db->prepare($query);
        $stmt->bind_Param('s', $codicePercorso);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function notificaNuovoPercorso($testo, $percorso)
    {
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

    public function aggiungiStazioniAttraversate($codPercorso, $codStazioni, $ordini, $binari, $orariPartenza, $orariArrivo)
    {
        $sql = "
            INSERT INTO Attraversato (
                CodPercorso,
                CodStazione,
                Data,
                Ordine,
                OrarioPartenzaPrevisto,
                OrarioArrivoPrevisto,
                Binario
            ) VALUES (
                ?, ?, CURDATE(), ?, ?, ?, ?
            )
        ";
        $stmt = $this->db->prepare($sql);
        if (!$stmt) {
            return false;
        }

        foreach ($codStazioni as $i => $codStazione) {
            $ordine = (int) $ordini[$i];
            $partenzaPrev = $orariPartenza[$i];
            $arrivoPrev = $orariArrivo[$i];
            $binarioInt = (int) $binari[$i];

            $stmt->bind_param(
                "ssissi",
                $codPercorso,
                $codStazione,
                $ordine,
                $partenzaPrev,
                $arrivoPrev,
                $binarioInt
            );
            if (!$stmt->execute()) {
                $stmt->close();
                return false;
            }
        }

        $stmt->close();
        return true;
    }

    public function cambiaOrario($codPercorso, $codStazione, $nuovoPartenza, $nuovoArrivo)
    {
        $sqlSel = "SELECT OrarioPartenzaPrevisto, OrarioArrivoPrevisto
                    FROM Attraversato
                    WHERE CodPercorso = ? 
                    AND CodStazione = ?
                    LIMIT 1";
        $stmtSel = $this->db->prepare($sqlSel);
        $stmtSel->bind_param('ss', $codPercorso, $codStazione);
        if (!$stmtSel->execute()) {
            return false;
        }
        $res = $stmtSel->get_result()->fetch_assoc();
        if (!$res) {
            return false;
        }
        $oldPartenza = $res['OrarioPartenzaPrevisto'];
        $oldArrivo = $res['OrarioArrivoPrevisto'];
        $stmtSel->close();

        $sqlUpd = "UPDATE Attraversato
                    SET OrarioPartenzaPrevisto = ?, OrarioArrivoPrevisto = ?
                    WHERE CodPercorso = ? AND CodStazione = ?";
        $stmtUpd = $this->db->prepare($sqlUpd);
        $stmtUpd->bind_param('ssss', $nuovoPartenza, $nuovoArrivo, $codPercorso, $codStazione);
        if (!$stmtUpd->execute()) {
            return false;
        }
        $stmtUpd->close();

        return [
            'oldPartenza' => $oldPartenza,
            'oldArrivo' => $oldArrivo
        ];
    }

    public function notificaCambioOrario($codPercorso, $codStazione, $oldPartenza, $oldArrivo, $newPartenza, $newArrivo)
    {
        $oldP = substr($oldPartenza, 0, 5);
        $oldA = substr($oldArrivo, 0, 5);
        $newP = substr($newPartenza, 0, 5);
        $newA = substr($newArrivo, 0, 5);

        $descrizione = sprintf(
            "Cambio orario Percorso %s – Stazione %s: Partenza da %s a %s, Arrivo da %s a %s",
            $codPercorso,
            $codStazione,
            $oldP,
            $newP,
            $oldA,
            $newA
        );

        $query = "INSERT INTO Notifica (Descrizione, CodPercorso) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ss', $descrizione, $codPercorso);
        if (!$stmt->execute()) {
            return false;
        }

        $codNotifica = $this->db->insert_id;
        $stmt->close();

        $queryStato = " INSERT INTO StatoNotifica (CodNotifica, Email, Letto)
                        SELECT ?, Email, FALSE
                        FROM Persona
                        WHERE TipoPersona = 'cliente'
                        AND TipoCliente = 'utente'    ";
        $stmtStato = $this->db->prepare($queryStato);
        if (!$stmtStato) {
            return false;
        }
        $stmtStato->bind_param('i', $codNotifica);
        $esito = $stmtStato->execute();
        $stmtStato->close();

        return $esito;
    }

    public function getPercorsi()
    {
        $query = "SELECT CodPercorso
                    FROM Percorso";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getStazioniOfPercorso($codicePercorso)
    {
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

    public function getBuoniScontoNonUtilizzate($email)
    {
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

    public function eliminaBuonoSconto($email, $buonoSconto)
    {
        $queryUtilizzo = "DELETE FROM Utilizzo WHERE CodBuonoSconto = ?";
        $stmtUtilizzo = $this->db->prepare($queryUtilizzo);
        $stmtUtilizzo->bind_param('i', $buonoSconto);
        $stmtUtilizzo->execute();

        $queryBuono = "DELETE FROM BuonoSconto WHERE CodBuonoSconto = ? AND Email = ?";
        $stmtBuono = $this->db->prepare($queryBuono);
        $stmtBuono->bind_param('is', $buonoSconto, $email);

        return $stmtBuono->execute();
    }

    public function checkAvailableForCoupon($emailUtente)
    {
        $query = "SELECT SpesaTotale, UltimaSpesaCoupon
                FROM Persona
                WHERE Email = ?
                AND TipoPersona = 'cliente'";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('s', $emailUtente);
        $stmt->execute();
        $res = $stmt->get_result();
        $row = $res->fetch_assoc();
        $stmt->close();

        if (!$row) {
            return false;
        }

        $spesaTotale = floatval($row['SpesaTotale']);
        $ultimaSpesaCoupon = intval($row['UltimaSpesaCoupon']);

        $soglieRaggiunte = floor($spesaTotale / 100);
        $sogliePrecedenti = floor($ultimaSpesaCoupon / 100);
        $nuoveSoglie = $soglieRaggiunte - $sogliePrecedenti;

        if ($nuoveSoglie <= 0) {
            return true;
        }

        $insertCouponQuery = "INSERT INTO BuonoSconto (Importo, DataInizioValidita, DataScadenza, Email)
                                VALUES (?, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY), ?)";
        $stmtIns = $this->db->prepare($insertCouponQuery);
        if (!$stmtIns) {
            return false;
        }

        $importoCoupon = 10.00;
        for ($i = 0; $i < $nuoveSoglie; $i++) {
            $stmtIns->bind_param('ds', $importoCoupon, $emailUtente);
            if (!$stmtIns->execute()) {
                $stmtIns->close();
                return false;
            }
        }
        $stmtIns->close();

        $nuovaUltima = $soglieRaggiunte * 100;
        $updateQuery = "UPDATE Persona
                        SET UltimaSpesaCoupon = ?
                        WHERE Email = ?
                        AND TipoPersona = 'cliente'";
        $stmtUpd = $this->db->prepare($updateQuery);
        if (!$stmtUpd) {
            return false;
        }
        $stmtUpd->bind_param('is', $nuovaUltima, $emailUtente);
        $ok = $stmtUpd->execute();
        $stmtUpd->close();

        return $ok;
    }

    public function insertTicket($email, $nomePasseggero, $cognomePasseggero, $codPercorso, $stazionePartenza, $stazioneArrivo, $tipoTreno, $dataPartenza, $orarioPartenza, $prezzo)
    {
        $query = "INSERT INTO Servizio (email, NomePasseggero, CognomePasseggero, CodPercorso, StazionePartenza, StazioneArrivo, TipoTreno, DataPartenza, OrarioPartenza, Prezzo)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'sssssssssd',
            $email,
            $nomePasseggero,
            $cognomePasseggero,
            $codPercorso,
            $stazionePartenza,
            $stazioneArrivo,
            $tipoTreno,
            $dataPartenza,
            $orarioPartenza,
            $prezzo
        );
        return $stmt->execute();
    }

    public function insertSubscription($email, $nomePasseggero, $cognomePasseggero, $codPercorso, $stazionePartenza, $stazioneArrivo, $tipoTreno, $dataPartenza, $durata, $chilometraggio, $prezzo)
    {
        $query = "INSERT INTO Servizio (email, NomePasseggero, CognomePasseggero, codPercorso, StazionePartenza, StazioneArrivo, TipoTreno, DataPartenza, Durata, Chilometraggio, Prezzo)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param(
            'sssssssssid',
            $email,
            $nomePasseggero,
            $cognomePasseggero,
            $codPercorso,
            $stazionePartenza,
            $stazioneArrivo,
            $tipoTreno,
            $dataPartenza,
            $durata,
            $chilometraggio,
            $prezzo
        );
        return $stmt->execute();
    }

    public function getGuestByEmail($email)
    {
        $query = "SELECT * FROM persona WHERE Email = ? AND TipoPersona = 'cliente' AND TipoCliente = 'ospite'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertGuest($nome, $cognome, $cf, $indirizzo, $telefono, $email)
    {
        $query = "INSERT INTO persona (Nome, Cognome, CF, Indirizzo, Telefono, Email, SpesaTotale, TipoPersona, TipoCliente)
                  VALUES (?, ?, ?, ?, ?, ?,  0, 'cliente', 'ospite')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssssss', $nome, $cognome, $cf, $indirizzo, $telefono, $email);

        if (!$stmt->execute()) {
            return false;
        }
    }

    public function getRouteCode($ServiceID)
    {
        $query = "SELECT s.CodPercorso
                  FROM Servizio s
                  WHERE s.CodServizio = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            error_log("Prepare failed in getRouteCode: " . $this->db->error);
            return [];
        }
        $stmt->bind_param("i", $ServiceID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function deleteCart($email = null, $sessionId = null)
    {
        $codCarrello = $this->getCartId($email, $sessionId);
        if (!$codCarrello) {
            return false;
        }

        $stmt = $this->db->prepare("DELETE FROM DettaglioCarrello WHERE CodCarrello = ?");
        $stmt->bind_param("i", $codCarrello);
        $stmt->execute();

        $stmt = $this->db->prepare("DELETE FROM Carrello WHERE CodCarrello = ?");
        $stmt->bind_param("i", $codCarrello);
        return $stmt->execute();
    }

    public function updateCartItemQuantity($codDettaglioCarrello, $newQuantity)
    {
        $stmt = $this->db->prepare(
            "SELECT CodCarrello
         FROM DettaglioCarrello
         WHERE CodDettaglioCarrello = ?"
        );
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("i", $codDettaglioCarrello);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if (!$row || !isset($row['CodCarrello'])) {
            return false;
        }

        $codCarrello = (int) $row['CodCarrello'];

        $stmt2 = $this->db->prepare(
            "UPDATE DettaglioCarrello
         SET Quantità = ?
         WHERE CodDettaglioCarrello = ?"
        );
        if (!$stmt2) {
            return false;
        }
        $stmt2->bind_param("ii", $newQuantity, $codDettaglioCarrello);
        $success = $stmt2->execute();
        $stmt2->close();

        if (!$success) {
            return false;
        }

        return $this->updateCartTotal($codCarrello);
    }

    public function aggiornaSpesaCliente($email, $amount)
    {
        $query = "UPDATE Persona
                    SET SpesaTotale = SpesaTotale + ?
                    WHERE Email = ?";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param("ds", $amount, $email);
        $ok = $stmt->execute();
        $stmt->close();
        return $ok;
    }

    public function notificaAcquistoBiglietti($emailCliente, $quantita, $codPercorso, $nomePasseggero, $cognomePasseggero)
    {
        $descrizione = sprintf(
            "Hai appena acquistato %d biglietti per il percorso %s per il passeggero %s %s",
            $quantita,
            $codPercorso,
            $nomePasseggero,
            $cognomePasseggero
        );

        $query = "INSERT INTO Notifica (Descrizione, CodPercorso) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ss', $descrizione, $codPercorso);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $codNotifica = $this->db->insert_id;
        $stmt->close();

        $queryStato = "
        INSERT INTO StatoNotifica (CodNotifica, Email, Letto)
        VALUES (?, ?, FALSE)
    ";
        $stmtStato = $this->db->prepare($queryStato);
        if (!$stmtStato) {
            return false;
        }
        $stmtStato->bind_param('is', $codNotifica, $emailCliente);
        $ok = $stmtStato->execute();
        $stmtStato->close();

        return $ok;
    }

    public function notificaAcquistoAbbonamento($emailCliente, $codPercorso, $durataAbbonamento, $nomePasseggero, $cognomePasseggero)
    {
        $descrizione = sprintf(
            "Hai appena acquistato un abbonamento %s per il percorso %s per il passeggero %s %s",
            $durataAbbonamento,
            $codPercorso,
            $nomePasseggero,
            $cognomePasseggero
        );

        $query = "INSERT INTO Notifica (Descrizione, CodPercorso) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        if (!$stmt) {
            return false;
        }
        $stmt->bind_param('ss', $descrizione, $codPercorso);
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
        $codNotifica = $this->db->insert_id;
        $stmt->close();

        $queryStato = "INSERT INTO StatoNotifica (CodNotifica, Email, Letto)
                        VALUES (?, ?, FALSE)";
        $stmtStato = $this->db->prepare($queryStato);
        if (!$stmtStato) {
            return false;
        }
        $stmtStato->bind_param('is', $codNotifica, $emailCliente);
        $ok = $stmtStato->execute();
        $stmtStato->close();

        return $ok;
    }

    public function verificaBuonoSconto($codice, $email)
    {
        $stmt = $this->db->prepare("SELECT * 
                                            FROM BuonoSconto
                                            WHERE CodBuonoSconto = ?
                                            AND Email = ?
                                            AND CURDATE() BETWEEN DataInizioValidita AND DataScadenza
                                            AND CodBuonoSconto NOT IN (SELECT CodBuonoSconto 
                                                                        FROM Utilizzo)");
        $stmt->bind_param("is", $codice, $email);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->num_rows > 0 ? $res->fetch_assoc() : null;
    }

    public function applicaScontoAlCarrello($importoSconto, $email)
    {
        $stmt = $this->db->prepare("SELECT CodCarrello, PrezzoTotale 
                                            FROM Carrello 
                                            WHERE Email = ? 
                                            ORDER BY CodCarrello 
                                            DESC LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $carrello = $res->fetch_assoc();
            $codCarrello = $carrello["CodCarrello"];
            $nuovoTotale = max(0, $carrello["PrezzoTotale"] - $importoSconto);

            $update = $this->db->prepare("UPDATE Carrello 
                                                    SET PrezzoTotale = ? 
                                                    WHERE CodCarrello = ?");
            $update->bind_param("di", $nuovoTotale, $codCarrello);
            $update->execute();

            return $nuovoTotale;
        }
        return false;
    }

    public function getPrimoServizioNelCarrello($email)
    {
        $stmt = $this->db->prepare("SELECT dc.CodServizio
                                            FROM Carrello c
                                            JOIN DettaglioCarrello dc ON c.CodCarrello = dc.CodCarrello
                                            WHERE c.Email = ?
                                            ORDER BY c.CodCarrello DESC, dc.CodDettaglioCarrello ASC
                                            LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            return $res->fetch_assoc()["CodServizio"];
        }
        return null;
    }

    public function segnaBuonoComeUtilizzato($codiceBuono, $codServizio)
    {
        $oggi = date('Y-m-d');
        $stmt = $this->db->prepare("INSERT INTO Utilizzo (CodBuonoSconto, CodServizio, Data)
                                            VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $codiceBuono, $codServizio, $oggi);
        return $stmt->execute();
    }
}
?>