<div class="container mt-5">
    <h2 class="mb-4">I miei Percorsi</h2>

    <?php if (empty($templateParams['percorsi'])): ?>
        <div class="alert alert-info">
            Non ci sono percorsi assegnati al momento.
        </div>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Codice Percorso</th>
                    <th>Codice Treno</th>
                    <th>Durata (min)</th>
                    <th>Prezzo (€)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($templateParams['percorsi'] as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['CodPercorso']) ?></td>
                        <td><?= htmlspecialchars($p['CodTreno']) ?></td>
                        <td><?= htmlspecialchars($p['TempoPercorrenza']) ?></td>
                        <td><?= number_format($p['Prezzo'], 2, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="d-flex justify-content-center mt-4 mb-5">
        <a href="profilo-macchinista.php" class="btn btn-secondary">
             Torna al Profilo
        </a>
    </div>
</div>
