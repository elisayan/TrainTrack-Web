<form action="#" method="POST">
    <div class="card mb-5 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Nuovo Percorso</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cod_percorso" class="form-label">Codice Percorso</label>
                    <input type="text" class="form-control" id="cod_percorso" name="cod_percorso"
                           pattern="[A-Z0-9]{4}" required>
                    <div class="invalid-feedback">
                        Inserire un codice valido (4 caratteri alfanumerici maiuscoli)
                    </div>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="cod_treno" class="form-label">Codice Treno</label>
                    <select class="form-select" id="cod_treno" name="cod_treno" required>
                        <option value="" selected disabled>Seleziona un treno</option>
                        <?php foreach ($treni as $treno): ?>
                            <option value="<?= htmlspecialchars($treno['CodTreno']) ?>">
                                <?= htmlspecialchars($treno['CodTreno']) ?> – <?= htmlspecialchars($treno['Tipo']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Selezionare un treno valido</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="email_macchinista" class="form-label">Email Macchinista</label>
                    <select class="form-select" id="email_macchinista" name="email_macchinista" required>
                        <option value="" selected disabled>Seleziona un macchinista</option>
                        <?php foreach($templateParams['macchinisti'] as $email): ?>
                            <option value="<?= htmlspecialchars($email) ?>">
                                <?= htmlspecialchars($email) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Selezionare un macchinista valido</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="tempo_percorrenza" class="form-label">Durata (minuti)</label>
                    <input type="number" class="form-control" id="tempo_percorrenza" name="tempo_percorrenza"
                           min="10" max="600" required>
                    <div class="invalid-feedback">Inserire un valore tra 10 e 600 minuti</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="prezzo" class="form-label">Prezzo (€)</label>
                    <input type="number" step="0.01" class="form-control" id="prezzo" name="prezzo"
                           min="1" max="200" required>
                    <div class="invalid-feedback">Inserire un prezzo valido (1–200 €)</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-5 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Stazioni Attraversate</h4>
        </div>
        <div class="card-body">
            <div id="stazioni-container">
                <div class="station-entry row mb-4">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Codice Stazione</label>
                        <select class="form-select" name="cod_stazione[]" required>
                            <option value="" selected disabled>Seleziona una stazione</option>
                            <?php foreach ($stazioni as $st): ?>
                                <option value="<?= htmlspecialchars($st['CodStazione']) ?>">
                                    <?= htmlspecialchars($st['CodStazione']) ?> – <?= htmlspecialchars($st['Nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Ordine</label>
                        <input type="number" class="form-control" name="ordine[]" min="1" max="20" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Binario</label>
                        <input type="number" class="form-control" name="binario[]" min="1" max="50" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Arrivo</label>
                        <input type="time" class="form-control" name="orario_arrivo_previsto[]" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Partenza</label>
                        <input type="time" class="form-control" name="orario_partenza_previsto[]" required>
                    </div>
                </div>
            </div>

            <template id="station-template">
                <div class="station-entry row mb-4">
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Codice Stazione</label>
                        <select class="form-select" name="cod_stazione[]" required>
                            <option value="" selected disabled>Seleziona una stazione</option>
                            <?php foreach ($stazioni as $st): ?>
                                <option value="<?= htmlspecialchars($st['CodStazione']) ?>">
                                    <?= htmlspecialchars($st['CodStazione']) ?> – <?= htmlspecialchars($st['Nome']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Ordine</label>
                        <input type="number" class="form-control" name="ordine[]" min="1" max="20" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Binario</label>
                        <input type="number" class="form-control" name="binario[]" min="1" max="50" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Arrivo</label>
                        <input type="time" class="form-control" name="orario_arrivo_previsto[]" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Partenza</label>
                        <input type="time" class="form-control" name="orario_partenza_previsto[]" required>
                    </div>
                </div>
            </template>

            <button type="button" class="btn btn-outline-primary mb-3" onclick="cloneStation()">
                Aggiungi Altra Stazione
            </button>
        </div>
    </div>

    <button type="submit" class="btn btn-success px-4">Salva Percorso e Stazioni</button>
</form>
