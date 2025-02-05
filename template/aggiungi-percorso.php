<form action="#" method="POST">
    <div class="card mb-5 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Nuovo Percorso</h4>
        </div>

        <div class="card-body">
            <div class="row">

                <?php if (isset($templateParams["errore"])): ?>
                    <div class="alert alert-danger">
                        <strong>Errore:</strong> <?php echo htmlspecialchars($templateParams["errore"]); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($templateParams["successo"])): ?>
                    <div class="alert alert-success">
                        <?php echo $templateParams["successo"]; ?>
                    </div>
                <?php endif; ?>

                <div class="col-md-6 mb-3">
                    <label for="cod_percorso" class="form-label">Codice Percorso</label>
                    <input type="text" class="form-control" id="cod_percorso" name="cod_percorso" 
                            pattern="[A-Z0-9]{4}" required>
                    <div class="invalid-feedback">Inserire un codice valido (6 caratteri alfanumerici maiuscoli)</div>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="cod_treno" class="form-label">Codice Treno</label>
                    <select class="form-select" id="cod_treno" name="cod_treno" required>
                        <option value="" selected disabled>Seleziona un treno...</option>
                        <?php foreach ($treni as $treno): ?>
                            <option value="<?= $treno['CodTreno'] ?>">
                                <?= $treno['CodTreno'] ?> - <?= $treno["Tipo"]?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">Selezionare un treno valido</div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="email_macchinista" class="form-label">Email Macchinista</label>
                    <input type="text" class="form-control" id="email_macchinista" name="email_macchinista" required>
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
                    <div class="invalid-feedback">Inserire un prezzo valido (1-200€)</div>
                </div>
            </div>

            <button type="submit" class="btn btn-success px-4">Salva Percorso</button>
        </div>
    </div>
</form>

<form action="#" method="POST">
    <div id="station-container" class="card mb-5 shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">Stazioni Attraversate</h4>
        </div>
        <template id="station-template">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cod_stazione" class="form-label">Codice Stazione</label>
                    <input type="text" class="form-control" name="cod_stazione[]" 
                            pattern="[A-Z]{3}" required>
                    <div class="invalid-feedback">Codice stazione non valido (3 lettere maiuscole)</div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="ordine" class="form-label">Ordine</label>
                    <input type="number" class="form-control" name="ordine[]" 
                            min="1" max="20" required>
                    <div class="invalid-feedback">Inserire un ordine valido (1-20)</div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="binario" class="form-label">Binario</label>
                    <input type="number" class="form-control" name="binario[]" 
                            min="1" max="50" required>
                    <div class="invalid-feedback">Binario non valido</div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="orario_partenza_previsto" class="form-label">Partenza</label>
                    <input type="time" class="form-control" name="orario_partenza_previsto[]" required>
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="orario_arrivo_previsto" class="form-label">Arrivo</label>
                    <input type="time" class="form-control" name="orario_arrivo_previsto[]" required>
                </div>
            </div>
        </template>
            <button type="button" class="btn btn-outline-primary" onclick="cloneStation()">Aggiungi Altra Stazione</button>
        </div>
    </div>
</form>