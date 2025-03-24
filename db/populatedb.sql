-- Start with a clean slate (optional)
DELETE FROM DettaglioCarello;
DELETE FROM Carello;
DELETE FROM DettaglioOrdine;
DELETE FROM Ordine;
DELETE FROM StatoNotifica;
DELETE FROM Attivazione;
DELETE FROM Utilizzo;
DELETE FROM CheckIn;
DELETE FROM BuonoSconto;
DELETE FROM Servizio;
DELETE FROM Attraversato;
DELETE FROM Percorso;
DELETE FROM Notifica;
DELETE FROM Treno;
DELETE FROM Stazione;
DELETE FROM TipoAbbonamento;
DELETE FROM Persona;

-- 1. Add a macchinista (train driver) as a Persona
INSERT INTO Persona (Email, Nome, Cognome, Indirizzo, Telefono, CF, Password, SpesaTotale, TipoPersona, TipoCliente, UltimaSpesaCoupon)
VALUES ('macchinista@traintrack.com', 'Mario', 'Rossi', 'Via Roma 1, Bologna', '051123456', 'RSSMRA80A01H501R', 'train123', 0, 'macchinista', NULL, NULL);

-- 2. Add 5 trains
INSERT INTO Treno (CodTreno, PostiTotali, Tipo) VALUES
('TR001', 300, 'Regionale'),
('TR002', 450, 'Intercity'),
('TR003', 200, 'Regionale'),
('TR004', 500, 'Frecciarossa'),
('TR005', 350, 'Intercity');

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
('FC', 'Forlì'),
('BLQ', 'Bologna Aeroporto');

-- 4. Add 5 routes (percorso)
INSERT INTO Percorso (CodPercorso, CodTreno, Email, TempoPercorrenza, Prezzo) VALUES
('PR001', 'TR001', 'macchinista@traintrack.com', '01:30', 12.50),
('PR002', 'TR002', 'macchinista@traintrack.com', '02:15', 18.00),
('PR003', 'TR003', 'macchinista@traintrack.com', '00:45', 8.50),
('PR004', 'TR004', 'macchinista@traintrack.com', '03:00', 25.00),
('PR005', 'TR005', 'macchinista@traintrack.com', '01:15', 15.00);

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

-- 6. Add all possible combinations of TipoAbbonamento
INSERT INTO TipoAbbonamento (Durata, Chilometraggio, Prezzo) VALUES
('giornaliero', 50, 15.00),
('giornaliero', 100, 20.00),
('giornaliero', 200, 25.00),
('settimanale', 50, 50.00),
('settimanale', 100, 65.00),
('settimanale', 200, 80.00),
('mensile', 50, 120.00),
('mensile', 100, 150.00),
('mensile', 200, 180.00),
('annuale', 50, 500.00),
('annuale', 100, 600.00),
('annuale', 200, 700.00);

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

-- Add some notifications
INSERT INTO Notifica (CodNotifica, Descrizione, CodPercorso) VALUES
('NOT001', 'Benvenuto su TrainTrack!', 'PR001');

-- Add subscription services where Durata and Chilometraggio are not null
-- For Bologna-Modena (distance ~40km) - use 50km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'BO', 'MO', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), '08:00:00', ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso IN ('PR001', 'PR004'); -- Routes that include BO-MO

-- For Modena-Reggio Emilia (distance ~30km) - use 50km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'MO', 'RE', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), '09:00:00', ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso IN ('PR001', 'PR004'); -- Routes that include MO-RE

-- For Reggio Emilia-Parma (distance ~25km) - use 50km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'RE', 'PR', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), '10:00:00', ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso IN ('PR001', 'PR004'); -- Routes that include RE-PR

-- For Bologna-Ferrara (distance ~50km) - use 50km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'BO', 'FE', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), '11:00:00', ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso = 'PR003'; -- Route that includes BO-FE

-- For Rimini-Forlì (distance ~30km) - use 50km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'RN', 'FC', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), '12:00:00', ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso = 'PR002'; -- Route that includes RN-FC

-- For Forlì-Bologna (distance ~70km) - use 100km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'FC', 'BO', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), '13:00:00', ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100
AND p.CodPercorso = 'PR002'; -- Route that includes FC-BO

-- For Piacenza-Parma (distance ~50km) - use 50km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'PC', 'PR', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), '14:00:00', ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso = 'PR004'; -- Route that includes PC-PR

-- For Bologna-Ravenna (distance ~80km) - use 100km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'BO', 'RA', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), '15:00:00', ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 100
AND p.CodPercorso = 'PR005'; -- Route that includes BO-RA

-- For Bologna Airport-Bologna Centrale (distance ~10km) - use 50km subscriptions
INSERT INTO Servizio (StazionePartenza, StazioneArrivo, NomePasseggero, CognomePasseggero, 
                     TipoTreno, DataPartenza, OrarioPartenza, Prezzo, CodPercorso, Email, 
                     Durata, Chilometraggio)
SELECT 
    'BLQ', 'BO', 'Abbonato', 'Generico', t.Tipo, 
    CURDATE(), '16:00:00', ta.Prezzo, p.CodPercorso, 'macchinista@traintrack.com',
    ta.Durata, ta.Chilometraggio
FROM TipoAbbonamento ta
JOIN Percorso p ON p.Email = 'macchinista@traintrack.com'
JOIN Treno t ON p.CodTreno = t.CodTreno
WHERE ta.Chilometraggio = 50
AND p.CodPercorso IN ('PR001', 'PR002', 'PR003', 'PR004', 'PR005'); -- All routes go through BO