<div class="container-fluid text-center">
        <div class="col-12 mb-4">
            <h1>I tuoi buoni sconto</h1>
            <p class="lead">Scegli e utilizza i coupon disponibili per i tuoi prossimi acquisti</p>
        </div>

        <!-- Grid buoni -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <!-- Buono 1 -->
            <div class="col">
                <div class="card h-100 shadow-sm border-success">
                    <div class="card-header bg-success text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-success">ATTIVO</span>
                            <small>Scade il 30/11/2024</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">
                            <span class="display-4 text-success">10%</span><br>
                            <small>DI SCONTO</small>
                        </h3>
                        <div class="text-center mb-4">
                            <code class="fs-3 text-dark" id="couponCode1">TRAIN10</code>
                            <button class="btn btn-outline-secondary btn-sm ms-2" onclick="copyCoupon('couponCode1')">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </div>
                        <ul class="list-unstyled">
                            <li><i class="bi bi-check2-circle text-success me-2"></i>Valido su tutti i treni</li>
                            <li><i class="bi bi-x-circle text-danger me-2"></i>Non cumulabile</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Buono 2 -->
            <div class="col">
                <div class="card h-100 shadow-sm border-secondary">
                    <div class="card-header bg-secondary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-danger">SCADUTO</span>
                            <small>Scade il 15/05/2024</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">
                            <span class="display-4 text-secondary">20€</span><br>
                            <small>DI SCONTO</small>
                        </h3>
                        <p class="text-center text-muted">Buono scaduto</p>
                    </div>
                </div>
            </div>

            <!-- Buono 3 -->
            <div class="col">
                <div class="card h-100 shadow-sm border-warning">
                    <div class="card-header bg-warning text-dark">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge bg-light text-warning">IN ATTESA</span>
                            <small>Valido dal 01/12/2024</small>
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">
                            <span class="display-4 text-warning">15%</span><br>
                            <small>DI SCONTO</small>
                        </h3>
                        <div class="text-center">
                            <button class="btn btn-outline-dark" disabled>
                                <i class="bi bi-clock-history me-2"></i>Disponibile a breve
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Termini e condizioni -->
        <div class="col-12 mt-5 mb-4">
            <div class="border-top pt-4">
                <h4 class="mb-3">Condizioni d'uso</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">• Ogni buono è valido per una sola transazione</li>
                    <li class="list-group-item">• I coupon non sono rimborsabili</li>
                    <li class="list-group-item">• Leggi il <a href="#" class="text-decoration-none">regolamento completo</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-3" 
     role="alert" aria-live="assertive" aria-atomic="true" id="copyToast">
    <div class="d-flex">
        <div class="toast-body">
            <i class="bi bi-check2-circle me-2"></i>Codice copiato!
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>