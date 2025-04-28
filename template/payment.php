<section class="payment-section">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card shadow p-4 card-info">
                    <h3>Dati Carta</h3>
                    <form method="post" action="order.php">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Cognome</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>       
                        </div>
                        <div class="form-group">
                            <label for="card-number">Numero Carta</label>
                            <input type="text" class="form-control" id="card-number" name="card-number" required>
                        </div>
                        <div class="form-group">
                            <label for="expiry-date">Data di Scadenza</label>
                            <input type="date" class="form-control" id="expiry-date" name="expiry-date" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required>
                        </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card shadow p-4 cart-summary">
                    <h3>Totale da pagare</h3>
                    <div class="summary-row">
                        <span class="price"><?php echo number_format($templateParams["total_price"], 2); ?>€</span>
                    </div>
                    <button type="submit" class="checkout-btn" onclick="window.location.href='order.php'">Procedi al pagamento</button>
                    </form>
                </div>
            </div>
        </div>
</section>