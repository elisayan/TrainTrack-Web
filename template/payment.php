<section class="payment-section">
    <form method="post" action="payment.php">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card shadow p-4 card-info">
                    <h2>Dati Carta</h2>

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
                                    <div class="col-4 form-group">
                                    <label for="expiry-month">Mese</label>
                                        <input type="text" class="form-control" id="expiry-month" name="expiry-month" placeholder="MM" required>
                                    </div>
                                    <div class="col-8 form-group">
                                        <label for="expiry-year">Anno</label>
                                        <input type="text" class="form-control" id="expiry-year" name="expiry-year" placeholder="YYYY" required>
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
                    <h2>Totale da pagare</h2>
                    <div class="summary-row">
                        <span>Importo: </span>
                        <span class="price"><?php echo number_format($templateParams["total_price"], 2); ?>€</span>
                    </div>
                    <button type="submit" class="checkout-btn" name="confirm_actual_payment">Procedi al pagamento</button>
                </div>
            </div>

        </div>
    </form>
</section>