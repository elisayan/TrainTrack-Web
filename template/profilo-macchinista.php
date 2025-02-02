<div class="container">
    <div class="sidebar">
        <h4><a href="profilo-macchinista.php">Azioni</a></h4>
        <a href="aggiungi-percorso.php">Aggiungi Percorso</a>
        <a href="cambia-orario.php">Cambia Orario</a>
    </div>

    <div class="content">
    <?php if(isset($templateParams["azione"])): ?>
            <?php require($templateParams["azione"]); ?>
        <?php else: ?>
            <div class="welcome-message">
                <h3>Benvenuto, <?php echo $user[0]["Nome"]; ?>!</h3>
                <p>Da questa dashboard puoi:</p>
                <ul class="welcome-list">
                    <li><a href="aggiungi-percorso.php">Creare percorsi ferroviari</a></li>
                    <li><a href="cambia-orario.php">Gestire gli orari dei treni</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</div>
