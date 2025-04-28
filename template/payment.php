<section class="payment-section">
    <form method="post" action="order.php">
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="card shadow p-4 card-info">
                    <h3>Dati Carta</h3>

                        <div class="row">
                            <div class="col-12 col-md-6 form-group">
                                <label for="name">Nome Titolare</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-12 col-md-6 form-group">
                                <label for="surname">Cognome Titolare</label>
                                <input type="text" class="form-control" id="surname" name="surname" required>       
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-12">
                                <label for="card-number">Numero Carta</label>
                                <input type="text" class="form-control" id="card-number" name="card-number" required>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-8">
                                <div class="row">
                                    <label for="expiry-date">Data di Scadenza</label>
                                    <div class="col-4 form-group">
                                        <input type="text" class="form-control" id="expiry-month" name="expiry-date" placeholder="MM" required>
                                    </div>
                                    <div class="col-8 form-group">
                                        <input type="text" class="form-control" id="expiry-year" name="expiry-date" placeholder="YYYY" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-4 form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" required>
                            </div>
                        </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card shadow p-4 cart-summary">
                    <h3>Totale da pagare</h3>
                    <div class="summary-row">
                        <span>Importo: </span>
                        <span class="price"><?php echo number_format($templateParams["total_price"], 2); ?>€</span>
                    </div>
                    <button type="submit" class="checkout-btn" onclick="window.location.href='order.php'">Procedi al pagamento</button>
                </div>
            </div>

        </div>
    </form>
</section>