<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <form class="card shadow p-4 mt-5" action="#" method="post">
                <h2 class="text-center mb-4">Registrazione</h2>

                <?php if (isset($templateParams["errore_registrazione"])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Errore:</strong> <?php echo htmlspecialchars($templateParams["errore_registrazione"]); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($templateParams["successo_registrazione"])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo $templateParams["successo_registrazione"]; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" 
                           class="form-control" 
                           id="nome" 
                           name="nome" 
                           placeholder="Inserisci il tuo nome"
                           required>
                </div>

                <div class="mb-3">
                    <label for="cognome" class="form-label">Cognome</label>
                    <input type="text" 
                           class="form-control" 
                           id="cognome" 
                           name="cognome" 
                           placeholder="Inserisci il tuo cognome"
                           required>
                </div>

                <div class="mb-3">
                    <label for="cf" class="form-label">Codice Fiscale</label>
                    <input type="text" 
                           class="form-control" 
                           id="cf" 
                           name="cf" 
                           placeholder="Inserisci il tuo CF"
                           required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           class="form-control" 
                           id="email" 
                           name="email" 
                           placeholder="nome@esempio.com"
                           required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           placeholder="Inserisci una password (min. 8 caratteri)"
                           minlength="8"
                           required>
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Conferma Password</label>
                    <input type="password" 
                           class="form-control" 
                           id="confirm_password" 
                           name="confirm_password" 
                           placeholder="Conferma la tua password"
                           required>
                </div>

                <div class="mb-3">
                    <label for="telefono" class="form-label">Numero Telefono</label>
                    <input type="text" 
                           class="form-control" 
                           id="telefono" 
                           name="telefono" 
                           placeholder="Inserisci il tuo numero di telefono">
                </div>

                <div class="mb-4">
                    <label for="indirizzo" class="form-label">Indirizzo</label>
                    <input type="text" 
                           class="form-control" 
                           id="indirizzo" 
                           name="indirizzo" 
                           placeholder="Inserisci il tuo indirizzo"
                           required>
                </div>

                <button type="submit" 
                        class="btn btn-primary w-100 mb-3 py-2"
                        name="submit">
                    Registrati
                </button>

                <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-muted">Oppure</span>
                    <hr class="flex-grow-1">
                </div>

                <div class="text-center">
                    <p class="text-muted mb-0">Hai già un account? <a href="login.php">Accedi</a> subito!</p>
                </div>
            </form>
        </div>
    </div>
</div>