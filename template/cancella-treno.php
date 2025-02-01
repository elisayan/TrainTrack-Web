<div class="card mb-5 shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Cancella Treno</h4>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="cod_treno" class="form-label">Codice Treno</label>
                <input type="text" class="form-control" id="cod_treno" name="cod_treno" 
                        pattern="[A-Z0-9]{8}" required>
                <div class="invalid-feedback">Inserire un codice treno valido (8 caratteri alfanumerici maiuscoli)</div>
            </div>
        </div>

        <div class="alert alert-warning">
            <strong>Attenzione!</strong> Questa azione è irreversibile. Il treno verrà rimosso dal sistema.
        </div>

        <button type="submit" class="btn btn-danger px-4">Cancella Treno</button>
    </div>
</div>