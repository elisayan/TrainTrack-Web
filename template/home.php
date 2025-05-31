<div class="container-fluid text-center">
    <div class="col-12 mb-5 text-center">
        <p class="lead hero-subtitle">Prenota biglietti in un click, gestisci abbonamenti e monitora i tuoi percorsi</p>
        <div class="decorative-line mx-auto mt-4"></div>
    </div>

    <div class="row">
        <div class="col-6 col-md-3 mb-5">
            <a href="search-ticket.php" class="card-link">
                <div class="card h-100 shadow hover-effect">
                    <img src="./img/ticket.png" class="card-img-top p-3 img-card-custom" alt="Biglietti">
                    <div class="card-body">
                        <h5 class="card-title">Biglietti</h5>
                        <p class="text-muted small">Acquista i tuoi biglietti</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3 mb-5">
            <a href="search-subscription.php" class="card-link">
                <div class="card h-100 shadow hover-effect">
                    <img src="./img/subscription.png" class="card-img-top p-3 img-card-custom" alt="Abbonamenti">
                    <div class="card-body">
                        <h5 class="card-title">Abbonamenti</h5>
                        <p class="text-muted small">Scopri le nostre offerte</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3 mb-5">
            <a href="login.php" class="card-link">
                <div class="card h-100 shadow hover-effect">
                    <img src="./img/profile.png" class="card-img-top p-3 img-card-custom" alt="Profilo">
                    <div class="card-body">
                        <h5 class="card-title">Profilo</h5>
                        <p class="text-muted small">Gestisci il tuo account</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-3 mb-5">
            <a href="ordini.php" class="card-link">
                <div class="card h-100 shadow hover-effect">
                    <img src="./img/<?= htmlspecialchars($templateParams['cardImage']) ?>"
                        class="card-img-top p-3 img-card-custom"  alt="Percorsi">
                    <div class="card-body">
                        <h5 class="card-title">Percorsi</h5>
                        <p class="text-muted small">Visualizza i tuoi percorsi</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-12 mb-3">
        <div class="alert alert-info">
            <h4>Promozioni Attive</h4>
            <p>Scopri le nostre offerte speciali per viaggi frequenti!</p>
        </div>
    </div>
</div>
