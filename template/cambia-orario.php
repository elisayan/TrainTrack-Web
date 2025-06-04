<div class="card mb-5 shadow-sm">
    <div class="card-header bg-primary text-white">
        <h2 class="mb-0">Modifica Orario Percorso</h2>
    </div>

    <div class="card-body">
        <?php if (isset($templateParams["errore"])): ?>
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <?php echo htmlspecialchars($templateParams["errore"]); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($templateParams["errore"]); endif; ?>

        <?php if (isset($templateParams["successo"])): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <?php echo htmlspecialchars($templateParams["successo"]); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            </div>
            <?php unset($templateParams["successo"]); endif; ?>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="h-100 border p-3 rounded">
                    <h5 class="text-muted mb-3">1. Seleziona Percorso</h5>
                    <form action="#" method="POST">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="cod_percorso" name="cod_percorso" required>
                                <option value="" disabled <?= !isset($_POST['cod_percorso']) ? 'selected' : '' ?>>
                                    Seleziona un percorso</option>
                                <?php foreach ($percorsi as $percorso): ?>
                                    <option value="<?= htmlspecialchars($percorso['CodPercorso']) ?>"
                                        <?= (isset($_POST['cod_percorso']) && $_POST['cod_percorso'] === $percorso['CodPercorso']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($percorso['CodPercorso']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="cod_percorso">Percorso Ferroviario</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <span class="bi bi-arrow-right me-2" aria-hidden="true"></span>Conferma Percorso
                        </button>
                    </form>
                </div>
            </div>

            <?php if (isset($_POST['cod_percorso']) && !empty($stazioni)): ?>
                <div class="col-12 col-md-6">
                    <div class="h-100 border p-3 rounded">
                        <h5 class="text-muted mb-3">2. Modifica Orario</h5>
                        <form action="#" method="POST">
                            <input type="hidden" name="cod_percorso"
                                value="<?= htmlspecialchars($_POST['cod_percorso']) ?>">

                            <div class="form-floating mb-3">
                                <select class="form-select" id="cod_stazione" name="cod_stazione" required>
                                    <option value="" disabled selected>Seleziona una stazione</option>
                                    <?php foreach ($stazioni as $stazione): ?>
                                        <option value="<?= htmlspecialchars($stazione['CodStazione']) ?>">
                                            <?= htmlspecialchars($stazione['Nome']) ?> -
                                            <?= htmlspecialchars($stazione['CodStazione']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="cod_stazione">Stazione</label>
                            </div>

                            <div class="row g-2 mb-3">
                                <div class="col">
                                    <label for="orario_arrivo_previsto" class="form-label">Arrivo</label>
                                    <input type="time" class="form-control" id="orario_arrivo_previsto"
                                        name="orario_arrivo_previsto"
                                        value="<?= htmlspecialchars($_POST['orario_arrivo_previsto'] ?? '') ?>" required>
                                </div>

                                <div class="col">
                                    <label for="orario_partenza_previsto" class="form-label">Partenza</label>
                                    <input type="time" class="form-control" id="orario_partenza_previsto"
                                        name="orario_partenza_previsto"
                                        value="<?= htmlspecialchars($_POST['orario_partenza_previsto'] ?? '') ?>" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success w-100">
                                <span class="bi bi-save me-2" aria-hidden="true"></span>Salva
                            </button>
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>