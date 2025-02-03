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
                        <td class="fw-bold"><?= htmlspecialchars($order['CodServizio']) ?></td>
                        <td><?= htmlspecialchars($order['NomePasseggero'] . ' ' . $order['CognomePasseggero']) ?></td>
                        <td><?= htmlspecialchars($order['CodPercorso']) ?></td>
                        <td><?= htmlspecialchars($order['StazionePartenza']) ?></td>
                        <td><?= htmlspecialchars($order['StazioneArrivo']) ?></td>
                        <td><?= htmlspecialchars($order['TipoTreno']) ?></td>
                        <td>
                            <div class="d-flex flex-column">
                                <span><?= date('d/m/Y', strtotime($order['DataPartenza'])) ?></span>
                                <small class="text-muted"><?= date('H:i', strtotime($order['OrarioPartenza'])) ?></small>
                            </div>
                        </td>
                        <td class="text-success fw-bold">€ <?= number_format($order['Prezzo'], 2) ?></td>
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
                        <td class="fw-bold"><?= htmlspecialchars($sub['CodServizio']) ?></td>
                        <td><?= htmlspecialchars($sub['NomePasseggero'] . ' ' . $sub['CognomePasseggero']) ?></td>
                        <td><?= htmlspecialchars($sub['StazionePartenza']) ?></td>
                        <td><?= htmlspecialchars($sub['StazioneArrivo']) ?></td>
                        <td><?= htmlspecialchars($sub['TipoTreno']) ?></td>
                        <td><?= date('d/m/Y', strtotime($sub['DataInizio'])) ?></td>
                        <td>
                            <?= htmlspecialchars($sub['Durata']) ?>
                        </td>
                        <td><?= number_format($sub['Chilometraggio'], 0) ?> km</td>
                        <td class="text-success fw-bold">€ <?= number_format($sub['Prezzo'], 2) ?></td>
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