<form action="login-controller.php" method="POST">
    <h2>Login</h2>

    <?php if(isset($templateParams["errorelogin"])): ?>
    <p><?php echo $templateParams["errorelogin"]; ?></p>
    <?php endif; ?>

    <ul>
        <li>
            <label for="email">Email:</label><input type="text" id="email" name="email" required/>
        </li>
        <li>
            <label for="password">Password:</label><input type="password" id="password" name="password" required/>
        </li>
        <li>
            <input type="submit" name="submit" value="Accedi"/>
        </li>
        <li>
            <p>Oppure</p>
        </li>
        <li>
            <p>Non hai ancora un account? <a href="register.php">Registrati</a> subito!</p>
        </li>
    </ul>
</form>