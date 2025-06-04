<div class="container-fluid my-4">
    <div class="row align-items-start">
        <div class="col-12 d-md-none py-2">
            <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas">
                ☰ Menu
            </button>
        </div>

        <div class="col-md-3">
            <div class="collapse d-md-block" id="sidebarCollapse">
                <div class="bg-light rounded p-3 sidebar">
                    <h4 class="mb-3"><a href="profilo-macchinista.php">Azioni</a></h4>
                    <nav class="nav flex-column">
                        <a class="nav-link" href="aggiungi-percorso.php">Aggiungi Percorso</a>
                        <a class="nav-link" href="cambia-orario.php">Cambia Orario</a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-start d-md-none" tabindex="-1" id="sidebarOffcanvas"
            aria-labelledby="sidebarOffcanvasLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarOffcanvasLabel">Azioni</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Chiudi"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link" href="aggiungi-percorso.php">Aggiungi Percorso</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cambia-orario.php">Cambia Orario</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-12 col-md-9">
            <?php if (isset($templateParams["azione"])): ?>
                <?php require($templateParams["azione"]); ?>
            <?php else: ?>
                <div class="welcome-message p-3 ms-md-3">
                    <h3>Benvenuto, <?= htmlspecialchars($user[0]["Nome"]) ?>!</h3>
                    <p>Da questa dashboard puoi:</p>
                    <ul class="welcome-list">
                        <li><a href="aggiungi-percorso.php">Creare percorsi ferroviari</a></li>
                        <li><a href="cambia-orario.php">Gestire gli orari dei treni</a></li>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>