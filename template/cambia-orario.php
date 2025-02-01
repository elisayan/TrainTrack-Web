<div class="card mb-5 shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Cambia Orario</h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="cod_percorso" class="form-label">Codice Percorso</label>
                <input type="text" class="form-control" id="cod_percorso" name="cod_percorso" 
                        pattern="[A-Z0-9]{6}" required>
                <div class="invalid-feedback">Inserire un codice valido (6 caratteri alfanumerici maiuscoli)</div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="cod_stazione" class="form-label">Stazione</label>
                <select class="form-control" id="cod_stazione" name="cod_stazione" required>
                    <option value="">Seleziona una stazione</option>
                    <!-- todo con stazioni valide per quel percorso -->
                    <option value="ST001">Stazione A</option>
                    <option value="ST002">Stazione B</option>
                    <option value="ST003">Stazione C</option>
                </select>
                <div class="invalid-feedback">Selezionare una stazione valida</div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="orario_partenza_previsto" class="form-label">Orario Partenza Previsto</label>
                <input type="time" class="form-control" id="orario_partenza_previsto" name="orario_partenza_previsto" required>
                <div class="invalid-feedback">Inserire un orario di partenza valido</div>
            </div>

            <div class="col-md-6 mb-3">
                <label for="orario_arrivo_previsto" class="form-label">Orario Arrivo Previsto</label>
                <input type="time" class="form-control" id="orario_arrivo_previsto" name="orario_arrivo_previsto" required>
                <div class="invalid-feedback">Inserire un orario di arrivo valido</div>
            </div>
        </div>

        <button type="submit" class="btn btn-success px-4">Salva Orario</button>
    </div>
</div>