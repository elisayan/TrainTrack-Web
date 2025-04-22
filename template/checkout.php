<section class="checkout">
        <h1>Checkout</h1>
        <div class="row">
    
            <div class="col-12 col-md-6">
                <div class="card shadow p-4 mt-0 cart-summary">
                    <h3>Dati Passeggero</h3>
                    <form method="post" action="process_checkout.php">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Cognome</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Telefono</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <button type="submit" class="btn btn-primary">Completa Ordine</button>
                    </form>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card shadow p-4 mt-0 cart-summary">
                    <h3>Riepilogo Ordine</h3>
                    <div class="summary-row">
                        <span>Totale provvisorio:</span>
                        <span class="price"><?php echo number_format($templateParams["total_price"], 2); ?>€</span>
                    </div>
                    
                    <a href="payment.php" class="checkout-btn">
                        <?php echo $templateParams["user_logged_in"] ? 'Procedi all\'ordine' : 'Continua come ospite'; ?>
                    </a>
                </div>
            </div>
        </div>

</section>