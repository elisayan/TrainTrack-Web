<div class="container mt-5">
    <p class="text-center mb-4 fs-5">Ciao, <?php echo $user[0]["Nome"];?>!</p>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-4 fs-5">Informazioni Personali</h3>
                    <div class="mb-3">
                        <label class="form-label fs-6"><strong>Nome:</strong></label>
                        <div class="form-control-static fs-6">
                            <?php echo htmlspecialchars($user[0]["Nome"] ?? "N/A"); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fs-6"><strong>Cognome:</strong></label>
                        <div class="form-control-static fs-6">
                            <?php echo htmlspecialchars($user[0]["Cognome"] ?? "N/A"); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fs-6"><strong>Email:</strong></label>
                        <div class="form-control-static fs-6">
                            <?php echo htmlspecialchars($user[0]["Email"] ?? "N/A"); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fs-6"><strong>Indirizzo:</strong></label>
                        <div class="form-control-static fs-6">
                            <?php echo htmlspecialchars($user[0]["Indirizzo"] ?? "N/A"); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fs-6"><strong>Telefono:</strong></label>
                        <div class="form-control-static fs-6">
                            <?php echo htmlspecialchars($user[0]["Telefono"] ?? "N/A"); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fs-6"><strong>Codice Fiscale:</strong></label>
                        <div class="form-control-static fs-6">
                            <?php echo htmlspecialchars($user[0]["CF"] ?? "N/A"); ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fs-6"><strong>Spesa Totale:</strong></label>
                        <div class="form-control-static fs-6">
                            €<?php echo number_format($user[0]["SpesaTotale"] ?? 0, 2); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-5 text-start">
            <div class="d-grid gap-3">
                <a href="ordini.php" class="btn shadow-sm fs-6 custom-hover">
                    <img src="img/order.png" alt="" class="me-2">I Miei Percorsi
                </a>
                <a href="notifica.php" class="btn shadow-sm fs-6 custom-hover">
                    <img src="img/notification.png" alt="" class="me-2">Notifiche
                </a>
                <a href="buoni-sconto.php" class="btn shadow-sm fs-6 custom-hover">
                    <img src="img/voucher.png" alt="" class="me-2">Buoni Sconto
                </a>
            </div>
        </div>
    </div>
</div>