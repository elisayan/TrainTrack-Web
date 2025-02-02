<form action="#" method="post">
    <h2>Registrazione</h2>

    <?php if (isset($templateParams["errore_registrazione"])): ?>
        <div class="alert alert-danger">
            <strong>Errore:</strong> <?php echo htmlspecialchars($templateParams["errore_registrazione"]); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($templateParams["successo_registrazione"])): ?>
        <div class="alert alert-success">
            <?php echo $templateParams["successo_registrazione"]; ?>
        </div>
    <?php endif; ?>

    <ul>
        <li>
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </li>

        <li>
            <label for="cognome">Cognome:</label>
            <input type="text" id="cognome" name="cognome" required>
        </li>

        <li>
            <label for="cf">Codice Fiscale:</label>
            <input type="text" id="cf" name="cf" required>
        </li>

        <li>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
        </li>

        <li>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" minlength="8" required>
        </li>

        <li>
            <label for="confirm_password">Conferma Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
        </li>

        <li>
            <label for="telefono">Numero Telefono:</label>
            <input type="text" id="telefono" name="telefono">
        </li>

        <li>
            <label for="indirizzo">Indirizzo:</label>
            <input type="text" id="indirizzo" name="indirizzo" required>
        </li>

        <li>
            <input type="submit" value="Registrati">
        </li>

        <li>
            <p>Oppure</p>
        </li>
        <li>
            <p>Hai già un account? <a href="login.php">Accedi</a> subito!</p>
        </li>
    </ul>
</form>