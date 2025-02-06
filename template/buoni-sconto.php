<div class="container-fluid text-center">
    <div class="col-12 mb-4">
        <h1>I tuoi buoni sconto</h1>
        <p class="lead">Scegli e utilizza i coupon disponibili per i tuoi prossimi acquisti</p>
    </div>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($buoni as $buono): 
            $now = new DateTime();
            $scadenza = new DateTime($buono['DataScadenza']);

            $soglia = 100; 
            $spesaMancante = $soglia - ($persona[0]['SpesaTotale'] - $persona[0]['UltimaSpesaCoupon']);
            $spesaMancante = max(0, $spesaMancante);

            if ($now > $scadenza) {
                $stato = 'scaduto';
            } elseif ($spesaMancante > 0) {
                $stato = 'in_attesa';
            } else {
                $stato = 'attivo';
            }
        ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-<?php echo getBorderColor($stato) ?>">
                    <div class="card-header bg-<?php echo getHeaderColor($stato) ?> text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-<?php echo getBadgeColor($stato) ?>">
                                <?php echo getStatoText($stato) ?>
                            </span>
                            <small>
                                <?php if (!empty($buono['DataScadenza'])): ?>
                                    Scade il <?php echo $scadenza->format('d/m/Y') ?>
                                <?php endif; ?>
                            </small>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">
                            <span class="display-4 text-<?php echo getBorderColor($stato) ?>">
                                <?php echo ($buono['Importo'] > 1 ? '€' : '') ?><?php echo $buono['Importo'] ?><?php echo ($buono['Importo'] <= 1 ? '%' : '') ?>
                            </span><br>
                            <small>DI SCONTO</small>
                        </h3>
                        
                        <?php if($stato === 'attivo'): ?>
                            <div class="text-center mb-4">
                                <code class="fs-3 text-dark" id="couponCode<?php echo $buono['CodBuonoSconto'] ?>">
                                    <?php echo htmlspecialchars($buono['CodBuonoSconto']) ?>
                                </code>
                                <button class="btn btn-outline-secondary btn-sm ms-2" 
                                        onclick="copyCoupon('couponCode<?php echo $buono['CodBuonoSconto'] ?>')">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                        <?php elseif($stato === 'scaduto'): ?>
                            <p class="text-center text-muted">Buono scaduto</p>
                        <?php else: ?>
                            <div class="text-center">
                                <p class="text-muted mb-3">
                                    Mancano €<?php echo number_format($spesaMancante, 2) ?> per ottenere questo coupon.
                                </p>
                                <button class="btn btn-outline-dark" disabled>
                                    <i class="bi bi-clock-history me-2"></i>Disponibile a breve
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="border-top pt-4 mb-4">
        <h4 class="mb-3">Termini e condizioni</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">• Ogni buono sconto è valido per una sola transazione.</li>
            <li class="list-group-item">• I buoni sconto non sono rimborsabili né convertibili in denaro.</li>
            <li class="list-group-item">• È possibile ottenere un nuovo buono sconto ogni €100 di spesa accumulata.</li>
            <li class="list-group-item">• Per maggiori dettagli, consulta il <a href="#" class="text-decoration-none">regolamento completo</a>.</li>
        </ul>
    </div>

</div>
