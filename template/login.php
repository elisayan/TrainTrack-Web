<div class="container-fluid mb-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6 col-xl-4">
            <form class="card shadow p-4 mt-5" action="#" method="POST">
                <h2 class="text-center mb-4">Login</h2>

                <?php if (isset($templateParams["errorelogin"])): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Errore:</strong> <?php echo htmlspecialchars($templateParams["errorelogin"]); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           class="form-control" 
                           id="email" 
                           name="email" 
                           placeholder="nome@esempio.com"
                           required>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           class="form-control" 
                           id="password" 
                           name="password" 
                           placeholder="Inserisci password"
                           required>
                </div>

                <button type="submit" 
                        class="btn btn-primary w-100 mb-3 py-2"
                        name="submit">
                    Accedi
                </button>

                <div class="d-flex align-items-center my-4">
                    <hr class="flex-grow-1">
                    <span class="mx-3 text-muted">Oppure</span>
                    <hr class="flex-grow-1">
                </div>

                <div class="text-center">
                    <p class="text-muted mb-0">Non hai ancora un account? <a href="register.php">Registrati</a> subito!</p>
                    
                </div>
            </form>
        </div>
    </div>
</div>