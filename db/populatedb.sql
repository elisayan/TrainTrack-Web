-- 1. Add a macchinista (train driver) as a Persona
INSERT INTO Persona (Email, Nome, Cognome, Indirizzo, Telefono, CF, Password, SpesaTotale, TipoPersona, TipoCliente, UltimaSpesaCoupon)
VALUES ('macchinista@traintrack.com', 'Mario', 'Rossi', 'Via Roma 1, Bologna', '051123456', 'RSSMRA80A01H501R', 'train123', 0, 'macchinista', NULL, NULL);

INSERT INTO Persona 
    (Email, Nome, Cognome, Indirizzo, Telefono, CF, Password, SpesaTotale, TipoPersona, TipoCliente, UltimaSpesaCoupon)
VALUES
    ('utente@traintrack.com',   -- Email
     'Luca',                    -- Nome
     'Bianchi',                 -- Cognome
     'Via Verdi 10, Milano',    -- Indirizzo
     '02-98765432',             -- Telefono
     'BNCLCU85M01F205X',        -- Codice Fiscale
     'password123',             -- Password (in chiaro; idealmente va hashata!)
     0,                         -- SpesaTotale iniziale
     'cliente',                 -- TipoPersona
     'utente',                  -- TipoCliente
     NULL                       -- UltimaSpesaCoupon (nessun coupon usato)
    );


-- 2. Add 5 trains
INSERT INTO Treno (CodTreno, PostiTotali, Tipo) VALUES
('TR001', 300, 'Regionale'),
('TR002', 450, 'Intercity'),
('TR003', 200, 'Regionale'),
('TR004', 500, 'Frecciarossa'),
('TR005', 350, 'Intercity'),
('TR006', 400, 'Regionale');

-- 3. Add stations for Emilia-Romagna cities
INSERT INTO Stazione (CodStazione, Nome) VALUES
('BO', 'Bologna Centrale'),
('FE', 'Ferrara'),
('MO', 'Modena'),
('PR', 'Parma'),
('PC', 'Piacenza'),
('RA', 'Ravenna'),
('RE', 'Reggio Emilia'),
('RN', 'Rimini'),
('FC', 'Forlì');

-- 4. Add 5 routes (percorso)
INSERT INTO Percorso (CodPercorso, CodTreno, Email, TempoPercorrenza, Prezzo) VALUES
('PR001', 'TR001', 'macchinista@traintrack.com', '01:30', 12.50),
('PR002', 'TR002', 'macchinista@traintrack.com', '02:15', 18.00),
('PR003', 'TR003', 'macchinista@traintrack.com', '00:45', 8.50),
('PR004', 'TR004', 'macchinista@traintrack.com', '03:00', 25.00),
('PR005', 'TR005', 'macchinista@traintrack.com', '01:15', 15.00),
('PR006', 'TR006', 'macchinista@traintrack.com', '04:30', 30.00),
('PR001R', 'TR001', 'macchinista@traintrack.com', '01:30', 12.50),
('PR002R', 'TR002', 'macchinista@traintrack.com', '02:15', 18.00),
('PR003R', 'TR003', 'macchinista@traintrack.com', '00:45', 8.50),
('PR004R', 'TR004', 'macchinista@traintrack.com', '03:00', 25.00),
('PR005R', 'TR005', 'macchinista@traintrack.com', '01:15', 15.00),
('PR006R', 'TR006', 'macchinista@traintrack.com', '04:30', 30.00);

-- 6. Add all possible combinations of TipoAbbonamento
INSERT INTO TipoAbbonamento (Durata, Chilometraggio, Prezzo) VALUES
('Settimanale', 30, 50.00),
('Settimanale', 50, 65.00),
('Settimanale', 100, 80.00),
('Mensile', 30, 120.00),
('Mensile', 50, 150.00),
('Mensile', 100, 180.00),
('Annuale', 30, 500.00),
('Annuale', 50, 600.00),
('Annuale', 100, 700.00);


-- Add some notifications
INSERT INTO Notifica ( Descrizione, CodPercorso) VALUES
('Benvenuto su TrainTrack!', 'PR001');


-- 5. Add attraversato records for each route with current date
-- Route PR001: Bologna -> Modena -> Reggio Emilia -> Parma
INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, Binario, StatoArrivo, StatoPartenza) VALUES
('PR001', 'BO', CURDATE(), 1, '08:00:00', '08:00:00', '08:00:00', '08:05:00', 3, 'In orario', 'In ritardo'),
('PR001', 'MO', CURDATE(), 2, '08:35:00', '08:30:00', '08:30:00', '08:40:00', 2, 'In orario', 'In ritardo'),
('PR001', 'RE', CURDATE(), 3, '09:05:00', '09:00:00', '09:00:00', '09:10:00', 1, 'In orario', 'In ritardo'),
('PR001', 'PR', CURDATE(), 4, '09:30:00', '09:30:00', '09:30:00', '09:30:00', 4, 'In orario', 'In orario');

-- Route PR002: Rimini -> Forlì -> Bologna
INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, Binario, StatoArrivo, StatoPartenza) VALUES
('PR002', 'RN', CURDATE(), 1, '10:00:00', '10:00:00', '10:00:00', '10:00:00', 1, 'In orario', 'In orario'),
('PR002', 'FC', CURDATE(), 2, '10:45:00', '10:40:00', '10:40:00', '10:50:00', 3, 'In orario', 'In ritardo'),
('PR002', 'BO', CURDATE(), 3, '12:15:00', '12:15:00', '12:15:00', '12:15:00', 5, 'In orario', 'In orario');

-- Route PR003: Bologna -> Ferrara
INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, Binario, StatoArrivo, StatoPartenza) VALUES
('PR003', 'BO', CURDATE(), 1, '14:00:00', '14:00:00', '14:00:00', '14:00:00', 2, 'In orario', 'In orario'),
('PR003', 'FE', CURDATE(), 2, '14:45:00', '14:45:00', '14:45:00', '14:45:00', 1, 'In orario', 'In orario');

-- Route PR004: Piacenza -> Parma -> Reggio Emilia -> Modena -> Bologna
INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, Binario, StatoArrivo, StatoPartenza) VALUES
('PR004', 'PC', CURDATE(), 1, '16:00:00', '16:00:00', '16:00:00', '16:00:00', 1, 'In orario', 'In orario'),
('PR004', 'PR', CURDATE(), 2, '16:30:00', '16:25:00', '16:25:00', '16:35:00', 3, 'In orario', 'In ritardo'),
('PR004', 'RE', CURDATE(), 3, '17:05:00', '17:00:00', '17:00:00', '17:10:00', 2, 'In orario', 'In ritardo'),
('PR004', 'MO', CURDATE(), 4, '17:35:00', '17:30:00', '17:30:00', '17:40:00', 1, 'In orario', 'In ritardo'),
('PR004', 'BO', CURDATE(), 5, '18:00:00', '18:00:00', '18:00:00', '18:00:00', 4, 'In orario', 'In orario');

-- Route PR005: Bologna -> Ravenna
INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, Binario, StatoArrivo, StatoPartenza) VALUES
('PR005', 'BO', CURDATE(), 1, '20:00:00', '20:00:00', '20:00:00', '20:00:00', 3, 'In orario', 'In orario'),
('PR005', 'RA', CURDATE(), 2, '21:15:00', '21:15:00', '21:15:00', '21:15:00', 2, 'In orario', 'In orario');

-- 3. Add station crossings for the comprehensive regional route (all stations in order)
-- Order: Rimini -> Forlì -> Ravenna -> Bologna -> Modena -> Reggio Emilia -> Parma -> Piacenza
INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, 
                         OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, 
                         Binario, StatoArrivo, StatoPartenza)
VALUES
-- Rimini (departure)
('PR006', 'RN', CURDATE(), 1, '06:00:00', '06:00:00', '06:00:00', '06:05:00', 1, 'In orario', 'In ritardo'),
-- Forlì
('PR006', 'FC', CURDATE(), 2, '06:45:00', '06:40:00', '06:40:00', '06:50:00', 2, 'In orario', 'In ritardo'),
-- Ravenna
('PR006', 'RA', CURDATE(), 3, '07:30:00', '07:25:00', '07:25:00', '07:35:00', 1, 'In orario', 'In ritardo'),
-- Bologna
('PR006', 'BO', CURDATE(), 4, '08:30:00', '08:20:00', '08:20:00', '08:40:00', 5, 'In orario', 'In ritardo'),
-- Modena
('PR006', 'MO', CURDATE(), 6, '09:30:00', '09:20:00', '09:20:00', '09:35:00', 3, 'In orario', 'In ritardo'),
-- Reggio Emilia
('PR006', 'RE', CURDATE(), 7, '10:00:00', '09:55:00', '09:55:00', '10:10:00', 2, 'In orario', 'In ritardo'),
-- Parma
('PR006', 'PR', CURDATE(), 8, '10:40:00', '10:30:00', '10:30:00', '10:45:00', 1, 'In orario', 'In ritardo'),
-- Piacenza (terminus)
('PR006', 'PC', CURDATE(), 9, '11:30:00', '11:30:00', '11:30:00', '11:30:00', 4, 'In orario', 'In orario');

-- 4. Create reverse routes for ALL existing routes (including the new comprehensive one)

-- Reverse of PR001 (Bologna->Modena->Reggio->Parma) becomes Parma->Reggio->Modena->Bologna

INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, 
                         OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, 
                         Binario, StatoArrivo, StatoPartenza)
VALUES
('PR001R', 'PR', CURDATE(), 1, '12:00:00', '12:00:00', '12:00:00', '12:05:00', 2, 'In orario', 'In ritardo'),
('PR001R', 'RE', CURDATE(), 2, '12:35:00', '12:30:00', '12:30:00', '12:40:00', 1, 'In orario', 'In ritardo'),
('PR001R', 'MO', CURDATE(), 3, '13:05:00', '13:00:00', '13:00:00', '13:10:00', 3, 'In orario', 'In ritardo'),
('PR001R', 'BO', CURDATE(), 4, '13:30:00', '13:30:00', '13:30:00', '13:30:00', 4, 'In orario', 'In orario');

-- Reverse of PR002 (Rimini->Forlì->Bologna) becomes Bologna->Forlì->Rimini

INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, 
                         OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, 
                         Binario, StatoArrivo, StatoPartenza)
VALUES
('PR002R', 'BO', CURDATE(), 1, '14:00:00', '14:00:00', '14:00:00', '14:00:00', 5, 'In orario', 'In orario'),
('PR002R', 'FC', CURDATE(), 2, '15:15:00', '15:10:00', '15:10:00', '15:20:00', 2, 'In orario', 'In ritardo'),
('PR002R', 'RN', CURDATE(), 3, '16:15:00', '16:15:00', '16:15:00', '16:15:00', 1, 'In orario', 'In orario');

-- Reverse of PR003 (Bologna->Ferrara) becomes Ferrara->Bologna

INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, 
                         OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, 
                         Binario, StatoArrivo, StatoPartenza)
VALUES
('PR003R', 'FE', CURDATE(), 1, '16:00:00', '16:00:00', '16:00:00', '16:00:00', 1, 'In orario', 'In orario'),
('PR003R', 'BO', CURDATE(), 2, '16:45:00', '16:45:00', '16:45:00', '16:45:00', 3, 'In orario', 'In orario');

-- Reverse of PR004 (Piacenza->Parma->Reggio->Modena->Bologna) becomes Bologna->Modena->Reggio->Parma->Piacenza

INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, 
                         OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, 
                         Binario, StatoArrivo, StatoPartenza)
VALUES
('PR004R', 'BO', CURDATE(), 1, '17:00:00', '17:00:00', '17:00:00', '17:00:00', 4, 'In orario', 'In orario'),
('PR004R', 'MO', CURDATE(), 2, '17:30:00', '17:25:00', '17:25:00', '17:35:00', 1, 'In orario', 'In ritardo'),
('PR004R', 'RE', CURDATE(), 3, '18:05:00', '18:00:00', '18:00:00', '18:10:00', 2, 'In orario', 'In ritardo'),
('PR004R', 'PR', CURDATE(), 4, '18:40:00', '18:35:00', '18:35:00', '18:45:00', 3, 'In orario', 'In ritardo'),
('PR004R', 'PC', CURDATE(), 5, '19:30:00', '19:30:00', '19:30:00', '19:30:00', 1, 'In orario', 'In orario');

-- Reverse of PR005 (Bologna->Ravenna) becomes Ravenna->Bologna

INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, 
                         OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, 
                         Binario, StatoArrivo, StatoPartenza)
VALUES
('PR005R', 'RA', CURDATE(), 1, '20:00:00', '20:00:00', '20:00:00', '20:00:00', 2, 'In orario', 'In orario'),
('PR005R', 'BO', CURDATE(), 2, '21:15:00', '21:15:00', '21:15:00', '21:15:00', 3, 'In orario', 'In orario');

-- Reverse of PR006 (Rimini->Forlì->Ravenna->Bologna->BLQ->Modena->Reggio->Parma->Piacenza)
-- becomes Piacenza->Parma->Reggio->Modena->BLQ->Bologna->Ravenna->Forlì->Rimini

INSERT INTO Attraversato (CodPercorso, CodStazione, Data, Ordine, OrarioPartenzaPrevisto, 
                         OrarioArrivoPrevisto, OrarioArrivoReale, OrarioPartenzaReale, 
                         Binario, StatoArrivo, StatoPartenza)
VALUES
-- Piacenza (departure)
('PR006R', 'PC', CURDATE(), 1, '12:00:00', '12:00:00', '12:00:00', '12:05:00', 1, 'In orario', 'In ritardo'),
-- Parma
('PR006R', 'PR', CURDATE(), 2, '12:45:00', '12:40:00', '12:40:00', '12:50:00', 2, 'In orario', 'In ritardo'),
-- Reggio Emilia
('PR006R', 'RE', CURDATE(), 3, '13:20:00', '13:15:00', '13:15:00', '13:25:00', 1, 'In orario', 'In ritardo'),
-- Modena
('PR006R', 'MO', CURDATE(), 4, '13:50:00', '13:45:00', '13:45:00', '14:00:00', 3, 'In orario', 'In ritardo'),
-- Bologna
('PR006R', 'BO', CURDATE(), 6, '14:50:00', '14:45:00', '14:45:00', '15:00:00', 5, 'In orario', 'In ritardo'),
-- Ravenna
('PR006R', 'RA', CURDATE(), 7, '15:45:00', '15:40:00', '15:40:00', '15:55:00', 1, 'In orario', 'In ritardo'),
-- Forlì
('PR006R', 'FC', CURDATE(), 8, '16:30:00', '16:25:00', '16:25:00', '16:40:00', 2, 'In orario', 'In ritardo'),
-- Rimini (terminus)
('PR006R', 'RN', CURDATE(), 9, '17:30:00', '17:30:00', '17:30:00', '17:30:00', 1, 'In orario', 'In orario');


-- 7. Add all possible combinations of Servizio (without subscriptions - durata and chilometraggio are null)
-- First, let's calculate distances between stations (approximate km)
-- Bologna-Modena: 40km, Modena-Reggio: 30km, Reggio-Parma: 25km
-- Bologna-Ferrara: 50km
-- Rimini-Forlì: 30km, Forlì-Bologna: 70km
-- Piacenza-Parma: 50km
-- Bologna-Ravenna: 80km

-- Add services for route PR001 (Bologna-Parma)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES
('BO', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '08:00:00', 5.00, 'PR001', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '08:00:00', 8.00, 'PR001', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '08:00:00', 12.50, 'PR001', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '08:35:00', 4.00, 'PR001', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '08:35:00', 8.00, 'PR001', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '09:05:00', 5.00, 'PR001', 'macchinista@traintrack.com', NULL, NULL);

-- Add services for route PR002 (Rimini-Bologna)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES
('RN', 'FC', 'Passeggero', 'Generico', 'Intercity', CURDATE(), '10:00:00', 6.00, 'PR002', 'macchinista@traintrack.com', NULL, NULL),
('RN', 'BO', 'Passeggero', 'Generico', 'Intercity', CURDATE(), '10:00:00', 18.00, 'PR002', 'macchinista@traintrack.com', NULL, NULL),
('FC', 'BO', 'Passeggero', 'Generico', 'Intercity', CURDATE(), '10:45:00', 12.00, 'PR002', 'macchinista@traintrack.com', NULL, NULL);

-- Add services for route PR003 (Bologna-Ferrara)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES
('BO', 'FE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '14:00:00', 8.50, 'PR003', 'macchinista@traintrack.com', NULL, NULL);

-- Add services for route PR004 (Piacenza-Bologna)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES
('PC', 'PR', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '16:00:00', 7.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL),
('PC', 'RE', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '16:00:00', 12.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL),
('PC', 'MO', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '16:00:00', 16.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL),
('PC', 'BO', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '16:00:00', 25.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'RE', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '16:30:00', 6.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'MO', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '16:30:00', 10.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'BO', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '16:30:00', 18.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'MO', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:05:00', 5.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'BO', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:05:00', 12.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'BO', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:35:00', 8.00, 'PR004', 'macchinista@traintrack.com', NULL, NULL);

-- Add services for route PR005 (Bologna-Ravenna)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES
('BO', 'RA', 'Passeggero', 'Generico', 'Intercity', CURDATE(), '20:00:00', 15.00, 'PR005', 'macchinista@traintrack.com', NULL, NULL);

-- 1. Add services for the comprehensive regional route PR006 (Rimini->Forlì->Ravenna->Bologna->BLQ->Modena->Reggio->Parma->Piacenza)

-- Rimini to all subsequent stations
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES 
('RN', 'FC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:00:00', 6.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RN', 'RA', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:00:00', 12.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RN', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:00:00', 18.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RN', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:00:00', 22.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RN', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:00:00', 25.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RN', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:00:00', 28.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RN', 'PC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:00:00', 30.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),

-- Forlì to all subsequent stations
('FC', 'RA', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:45:00', 6.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('FC', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:45:00', 12.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('FC', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:45:00', 16.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('FC', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:45:00', 19.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('FC', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:45:00', 22.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('FC', 'PC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '06:45:00', 24.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),

-- Ravenna to all subsequent stations
('RA', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '07:30:00', 6.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RA', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '07:30:00', 10.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RA', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '07:30:00', 13.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RA', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '07:30:00', 16.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RA', 'PC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '07:30:00', 18.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),

-- Bologna to all subsequent stations
('BO', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '08:30:00', 5.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '08:30:00', 8.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '08:30:00', 12.50, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'PC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '08:30:00', 15.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
-- Modena to all subsequent stations
('MO', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '09:30:00', 4.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '09:30:00', 8.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'PC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '09:30:00', 10.50, 'PR006', 'macchinista@traintrack.com', NULL, NULL),

-- Reggio Emilia to all subsequent stations
('RE', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '10:00:00', 5.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'PC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '10:00:00', 7.50, 'PR006', 'macchinista@traintrack.com', NULL, NULL),

-- Parma to Piacenza
('PR', 'PC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '10:40:00', 5.00, 'PR006', 'macchinista@traintrack.com', NULL, NULL);


-- 3. Add services for the reverse routes of existing routes (PR001R to PR005R)
-- Using prices matching their forward counterparts

-- For PR001R (Parma->Reggio->Modena->Bologna)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES 
('PR', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 5.00, 'PR001R', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 8.00, 'PR001R', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 12.50, 'PR001R', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:35:00', 4.00, 'PR001R', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:35:00', 8.00, 'PR001R', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:05:00', 5.00, 'PR001R', 'macchinista@traintrack.com', NULL, NULL);

-- For PR002R (Bologna->Forlì->Rimini)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES 
('BO', 'FC', 'Passeggero', 'Generico', 'Intercity', CURDATE(), '14:00:00', 12.00, 'PR002R', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'RN', 'Passeggero', 'Generico', 'Intercity', CURDATE(), '14:00:00', 18.00, 'PR002R', 'macchinista@traintrack.com', NULL, NULL),
('FC', 'RN', 'Passeggero', 'Generico', 'Intercity', CURDATE(), '15:15:00', 6.00, 'PR002R', 'macchinista@traintrack.com', NULL, NULL);

-- For PR003R (Ferrara->Bologna)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES 
('FE', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '16:00:00', 8.50, 'PR003R', 'macchinista@traintrack.com', NULL, NULL);

-- For PR004R (Bologna->Modena->Reggio->Parma->Piacenza)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES 
('BO', 'MO', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:00:00', 8.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'RE', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:00:00', 12.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'PR', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:00:00', 18.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'PC', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:00:00', 25.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'RE', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:30:00', 5.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'PR', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:30:00', 10.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'PC', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '17:30:00', 17.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'PR', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '18:05:00', 6.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'PC', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '18:05:00', 13.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'PC', 'Passeggero', 'Generico', 'Frecciarossa', CURDATE(), '18:40:00', 7.00, 'PR004R', 'macchinista@traintrack.com', NULL, NULL);

-- For PR005R (Ravenna->Bologna)
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES 
('RA', 'BO', 'Passeggero', 'Generico', 'Intercity', CURDATE(), '20:00:00', 15.00, 'PR005R', 'macchinista@traintrack.com', NULL, NULL);

-- 2. Add services for the reverse comprehensive route PR006R (Piacenza->Parma->Reggio->Modena->BLQ->Bologna->Ravenna->Forlì->Rimini)
-- Piacenza to all subsequent stations
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, Durata, Chilometraggio) VALUES 
('PC', 'PR', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 7.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PC', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 12.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PC', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 16.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PC', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 20.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PC', 'RA', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 25.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PC', 'FC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 28.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PC', 'RN', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:00:00', 30.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),

-- Parma to all subsequent stations
('PR', 'RE', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:45:00', 6.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:45:00', 10.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:45:00', 14.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'RA', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:45:00', 19.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'FC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:45:00', 22.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('PR', 'RN', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '12:45:00', 24.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),

-- Reggio Emilia to all subsequent stations
('RE', 'MO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:20:00', 4.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:20:00', 8.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'RA', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:20:00', 13.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'FC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:20:00', 16.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('RE', 'RN', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:20:00', 18.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),

-- Modena to all subsequent stations
('MO', 'BO', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:50:00', 5.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'RA', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:50:00', 10.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'FC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:50:00', 13.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('MO', 'RN', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '13:50:00', 15.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),

-- Bologna to all subsequent stations
('BO', 'RA', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '14:50:00', 6.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'FC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '14:50:00', 12.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('BO', 'RN', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '14:50:00', 18.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),

-- Ravenna to all subsequent stations
('RA', 'FC', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '15:45:00', 6.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),
('RA', 'RN', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '15:45:00', 12.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL),

-- Forlì to Rimini
('FC', 'RN', 'Passeggero', 'Generico', 'Regionale', CURDATE(), '16:30:00', 6.00, 'PR006R', 'macchinista@traintrack.com', NULL, NULL);


-- Add subscription services where Durata and Chilometraggio are not null
-- For Bologna-Modena (distance ~40km) - use 50km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'BO', 'MO', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso IN ('PR001', 'PR004', 'PR001R', 'PR004R', 'PR006', 'PR006R')

UNION ALL

SELECT 
    'MO', 'RE', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 30
AND p.CodPercorso IN ('PR001', 'PR004', 'PR001R', 'PR004R', 'PR006', 'PR006R')

UNION ALL

SELECT 
    'RE', 'PR', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 30
AND p.CodPercorso IN ('PR001', 'PR004', 'PR001R', 'PR004R', 'PR006', 'PR006R')

UNION ALL

SELECT 
    'BO', 'FE', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso IN ('PR003', 'PR006', 'PR003R', 'PR006R')

UNION ALL

SELECT 
    'RN', 'FC', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 30
AND p.CodPercorso IN ('PR002', 'PR006', 'PR002R', 'PR006R')

UNION ALL

SELECT 
    'FC', 'BO', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100
AND p.CodPercorso IN ('PR002', 'PR006', 'PR002R', 'PR006R')

UNION ALL

SELECT 
    'PC', 'PR', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso IN ('PR004', 'PR006', 'PR004R', 'PR006R')

UNION ALL

SELECT 
    'BO', 'RA', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100
AND p.CodPercorso IN ('PR005', 'PR006', 'PR005R', 'PR006R') -- Route that includes BO-RA

UNION ALL

SELECT 
    'FC', 'RA', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 30
AND p.CodPercorso IN ('PR006', 'PR006R') -- Route that includes RA-FC

UNION ALL

SELECT 
    'PR', 'RA', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100
AND p.CodPercorso IN ('PR006', 'PR006R') -- Route that includes RA-PR

UNION ALL

SELECT 
    'FC', 'PR', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100
AND p.CodPercorso IN ('PR006', 'PR006R') -- Route that includes PR-FC

UNION ALL

SELECT 
    'BO', 'PR', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100
AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL

SELECT 
    'BO', 'PC', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100
AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL

SELECT 
    'BO', 'RE', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso IN ('PR006', 'PR006R')

-- Continue with all remaining combinations in the same pattern

UNION ALL

SELECT 
    'BO', 'RN', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100
AND p.CodPercorso IN ('PR006', 'PR006R')

-- FE + MO
UNION ALL
SELECT 'FE', 'MO', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50 AND p.CodPercorso IN ('PR006', 'PR006R')

-- FE + PR
UNION ALL
SELECT 'FE', 'PR', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

-- [Add all remaining combinations following the same structure...]

UNION ALL
SELECT 'FE', 'PC', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 00 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'FE', 'RA', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'FE', 'RE', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'FE', 'RN', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'FE', 'FC', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'MO', 'PR', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'MO', 'PC', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'MO', 'RA', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'MO', 'RN', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'MO', 'FC', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'PR', 'RN', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'RE', 'FC', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'PC', 'RA', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 00 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'PC', 'RE', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'PC', 'RN', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 0 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'PC', 'FC', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'RA', 'RE', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'RA', 'RN', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50 AND p.CodPercorso IN ('PR006', 'PR006R')

UNION ALL
SELECT 'RE', 'RN', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R')

-- Final combination would be RE + FC
UNION ALL
SELECT 'RE', 'FC', 'Abbonato', 'Generico', t.Tipo, CURDATE(), NULL, ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com', ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100 AND p.CodPercorso IN ('PR006', 'PR006R');


