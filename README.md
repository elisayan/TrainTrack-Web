# 🚆 TrainTrack-Web

TrainTrack è un sistema gestionale per percorsi ferroviari, utenti e ordini, sviluppato in PHP, MySQL, JavaScript, CSS e Bootstrap.
Progetto universitario pensato per integrare funzionalità come notifiche, abbonamenti, pagamenti e storico ordini.

## Requisiti

- [XAMPP](https://www.apachefriends.org/) installato (Apache + MySQL)
- Browser web (Chrome o Firefox)
- Editor di testo (Visual Studio Code, Sublime, ecc.)

## Istruzioni per l’avvio

1. **Clona o copia il progetto nella directory di XAMPP:**

   Copia la cartella `TrainTrack-Web` dentro:

   2. **Avvia i servizi Apache e MySQL** da **XAMPP Control Panel**.

3. **Importa il database:**

- Importa il file, creando un nuovo database chiamato traintrack:

  ```
  db/traintrack.sql
  ```

- Poi importa (sullo stesso database) il file per popolare il database:

  ```
  db/populatedb.sql
  ```

4. **Accedi al sito:**

Vai su [http://localhost/TrainTrack-Web/](http://localhost/TrainTrack-Web/) nel browser.

---

## Struttura delle cartelle

```bash
TrainTrack-Web/
│
├── api/                   # Endpoint PHP (es. login, registrazione)
├── css/                   # File CSS personalizzati
├── js/                    # File JavaScript (es. login.js)
├── template/              # Template HTML riutilizzabili
├── db/
│   ├── database.php       # Database Helper 
│   ├── traintrack.sql     # Struttura del database
│   └── populatedb.sql     # Query di popolamento dati
├── login-controller.php   # Login backend
├── register.php           # Pagina di registrazione
├── home.php               # Homepage
├── index.php              # Pagina iniziale
└── ...
```
---

## Anteprima

### Homepage
![Homepage](assets/screenshots/home.png)

### Pagina per ricerca biglietti
![Ticket](assets/screenshots/ticket.png)

### Pagina per ricerca abbonamenti
![Subscrition](assets/screenshots/subscrition.png)

### Pagina di carrello
![Carrello](assets/screenshots/cart.png)

### Pagina di acquisto
![Acquisto](assets/screenshots/purchase.png)

### Pagina di Login
![Login](assets/screenshots/login.png)

### Profilo Utente
![Profile](assets/screenshots/profile.png)

### Pagina di riepilogo ordini di un utente
![Ordini](assets/screenshots/orders.png)

### Pagina di notifiche
![Notifiche](assets/screenshots/notification.png)

### Pagina di buoni sconto
![Buoni](assets/screenshots/coupon.png)

### Autori
- [@elisayan](https://github.com/elisayan)
- [@amielajunio](https://github.com/amielajunio)
