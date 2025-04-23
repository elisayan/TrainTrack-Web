<section class="payment-section">
        <div class="row">
            <div class="col-12">
                <div class="card shadow p-4 cart-summary">
                    <h3>Pagamento</h3>
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
                            <input type="text" class="form-control" id="expiry-date" name="expiry-date" required>
                        </div>
                        <div class="form-group">
                            <label for="cvv">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required>
                        </div>
                        <button type="submit" class="btn">Paga</button>
                    </form>
                </div>
            </div>
        </div>
</section>