<h1 class="mb-4">I miei ordini</h1>

<section class="mb-5">
    <h3 class="mb-3">Biglietti acquistati</h3>
    <?php if (!empty($ticketOrders)): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Codice</th>
                        <th>Passeggero</th>
                        <th>Percorso</th>
                        <th>Partenza</th>
                        <th>Arrivo</th>
                        <th>Treno</th>
                        <th>Data/Ora</th>
                        <th>Prezzo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ticketOrders as $order): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($order['codice']) ?></td>
                        <td><?= htmlspecialchars($order['nome_passeggero'] . ' ' . $order['cognome_passeggero']) ?></td>
                        <td><?= htmlspecialchars($order['codice_percorso']) ?></td>
                        <td><?= htmlspecialchars($order['stazione_partenza']) ?></td>
                        <td><?= htmlspecialchars($order['stazione_arrivo']) ?></td>
                        <td><?= htmlspecialchars($order['tipo_treno']) ?></td>
                        <td>
                            <div class="d-flex flex-column">
                                <span><?= date('d/m/Y', strtotime($order['data_partenza'])) ?></span>
                                <small class="text-muted"><?= date('H:i', strtotime($order['orario_partenza'])) ?></small>
                            </div>
                        </td>
                        <td class="text-success fw-bold">€ <?= number_format($order['prezzo'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Nessun biglietto acquistato</div>
    <?php endif; ?>
</section>

<section class="mb-5">
    <h3 class="mb-3">Abbonamenti attivi</h3>
    <?php if (!empty($subscriptionOrders)): ?>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Codice</th>
                        <th>Passeggero</th>
                        <th>Partenza</th>
                        <th>Arrivo</th>
                        <th>Treno</th>
                        <th>Inizio validità</th>
                        <th>Tipo abbonamento</th>
                        <th>Chilometraggio</th>
                        <th>Prezzo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($subscriptionOrders as $sub): ?>
                    <tr>
                        <td class="fw-bold"><?= htmlspecialchars($sub['codice']) ?></td>
                        <td><?= htmlspecialchars($sub['nome_passeggero'] . ' ' . $sub['cognome_passeggero']) ?></td>
                        <td><?= htmlspecialchars($sub['stazione_partenza']) ?></td>
                        <td><?= htmlspecialchars($sub['stazione_arrivo']) ?></td>
                        <td><?= htmlspecialchars($sub['tipo_treno']) ?></td>
                        <td><?= date('d/m/Y', strtotime($sub['data_inizio'])) ?></td>
                        <td>
                            <?= htmlspecialchars($sub['tipo_abbonamento']) ?>
                            <small class="text-muted d-block">(<?= $sub['durata_giorni'] ?> giorni)</small>
                        </td>
                        <td><?= number_format($sub['chilometraggio'], 0) ?> km</td>
                        <td class="text-success fw-bold">€ <?= number_format($sub['prezzo'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Nessun abbonamento attivo</div>
    <?php endif; ?>
</section>

<div class="mt-4 text-center">
    <a href="profilo-cliente.php" class="btn btn-primary">
        <i class="bi bi-arrow-left me-2"></i>Torna al Profilo
    </a>
</div>