<div class="container-fluid text-center">
    <div class="col-12 mb-4">
        <h1>I tuoi buoni sconto</h1>
        <p class="lead">Scegli e utilizza i coupon disponibili per i tuoi prossimi acquisti</p>
    </div>

    <?php if (isset($_GET["msg"]) && $_GET["msg"] === "success"): ?>
        <div class="alert alert-success">Buono sconto eliminato con successo!</div>
    <?php elseif (isset($_GET["msg"]) && $_GET["msg"] === "error"): ?>
        <div class="alert alert-danger">Errore durante l'eliminazione del buono sconto</div>
    <?php endif; ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-4">
        <?php 
        $soglia = 100;
        $spesaMancante = $soglia - ($persona[0]['SpesaTotale'] - $persona[0]['UltimaSpesaCoupon']);
        $spesaMancante = max(0, $spesaMancante);
        
        $buonoInAttesa = [
            'CodBuonoSconto' => 'PROSSIMO',
            'Importo' => 10,
        ];
        
        $tuttiBuoni = array_merge([$buonoInAttesa], $buoni);
        
        foreach ($tuttiBuoni as $buono): 
            $now = new DateTime();
            
            if ($buono['CodBuonoSconto'] === 'PROSSIMO') {
                $stato = 'in_attesa';
            } else {
                $attivo = new DateTime($buono['DataInizioValidita']);
                $scadenza = new DateTime($buono['DataScadenza']);
                
                if ($now < $scadenza && $now >= $attivo) {
                    $stato = 'attivo';
                } elseif ($now > $scadenza) {
                    $stato = 'scaduto';
                } else {
                    $stato = 'in_attesa';
                }
            }
        ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-<?php echo getBorderColor($stato) ?>">
                    <div class="card-header bg-<?php echo getHeaderColor($stato) ?> text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-<?php echo getBadgeColor($stato) ?>">
                                <?php echo getStatoText($stato) ?>
                            </span>
                            <?php if ($stato !== 'in_attesa' && isset($scadenza)): ?>
                                <small>Scade il <?php echo $scadenza->format('d/m/Y') ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">
                            <span class="display-4 text-<?php echo getBorderColor($stato) ?>">
                                <?php echo ($buono['CodBuonoSconto'] === 'PROSSIMO' ? '€10' : ($buono['Importo'] > 1 ? '€' : '') . $buono['Importo'] . ($buono['Importo'] <= 1 ? '%' : '')) ?>
                            </span><br>
                            <small>DI SCONTO</small>
                        </h3>
                        
                        <?php if($stato === 'attivo'): ?>
                            <div class="text-center mb-4">
                                <code class="fs-3 text-dark" id="couponCode<?php echo $buono['CodBuonoSconto'] ?>">
                                    <?php echo "CODICE: " . htmlspecialchars($buono['CodBuonoSconto']); ?>
                                </code>
                            </div>
                        <?php elseif($stato === 'scaduto'): ?>
                            <div class="text-center">
                                <p class="text-muted mb-3">Buono scaduto</p>
                                <form method="post" action="elimina-buono.php">
                                    <input type="hidden" name="codice" value="<?php echo $buono['CodBuonoSconto'] ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash me-2"></i>Elimina
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="text-center">
                                <?php if($buono['CodBuonoSconto'] === 'PROSSIMO'): ?>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-warning" 
                                             role="progressbar" 
                                             style="width: <?php echo (($soglia - $spesaMancante)/$soglia)*100 ?>%" 
                                             aria-valuenow="<?php echo $soglia - $spesaMancante ?>" 
                                             aria-valuemin="0" 
                                             aria-valuemax="<?php echo $soglia ?>">
                                        </div>
                                    </div>
                                    <p class="text-muted">
                                        Mancano<br>
                                        <span class="h4">€<?php echo number_format($spesaMancante, 2) ?></span><br>
                                        al prossimo coupon
                                    </p>
                                <?php else: ?>
                                    <p class="text-muted mb-3">
                                        Disponibile dal <?php echo $attivo->format('d/m/Y') ?>
                                    </p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="mt-4 mb-4 text-center">
        <a href="profilo-cliente.php" class="btn btn-primary">Torna al Profilo</a>
    </div>

    <div class="pt-4 mb-4">
        <h4 class="mb-3">Termini e condizioni</h4>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">• Ottieni un buono sconto da €10 ogni €100 di spesa</li>
            <li class="list-group-item">• I buoni sconto hanno validità 30 giorni dall'emissione</li>
        </ul>
    </div>
</div>