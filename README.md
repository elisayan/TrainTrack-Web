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

- Accedi a [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
- Crea un nuovo database chiamato `traintrack`
- Importa il file:

  ```
  db/traintrack.sql
  ```

- Poi importa (sullo stesso database) il file:

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



### Autori
- [@elisayan](https://github.com/elisayan)
- [@amielajunio](https://github.com/amielajunio)
