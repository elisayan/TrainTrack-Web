<section class="checkout-section">
        <div class="row">
    
            <div class="col-12 col-md-6">
                <div class="card shadow p-4 cart-summary">
                    <h3>Dati Passeggero</h3>
                    <form method="post" action="payment.php">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="<?php $templateParams["user_logged_in"]? $user[0]["Nome"] : "" ; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="surname">Cognome</label>
                            <input type="text" class="form-control" id="surname" name="surname"
                            value="<?php $templateParams["user_logged_in"]? $user[0]["Cognome"] : "" ; ?>" required>
                            
                        </div>
                        <?php if(!$templateParams["user_logged_in"]): ?>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>

                        </div>
                        <div class="form-group">
                            <label for="phone">Telefono</label>
                            <input type="text" class="form-control" id="phone" name="phone" >
                        
                        </div>
                        <div class="form-group">
                            <label for="cf">Codice Fiscale</label>
                            <input type="text" class="form-control" id="cf" name="cf" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Indirizzo</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <?php endif; ?>
                        <button type="reset" class="btn btn-secondary">Cancella dati</button> 
                        <!--change button function to delete values even if they are logged in-->
                    
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card shadow p-4 cart-summary">
                    <h3>Riepilogo Ordine</h3>
                    <div class="summary-row">
                        <span>Totale:</span>
                        <span class="price"><?php echo number_format($templateParams["total_price"], 2); ?>€</span>
                    </div>
                    
                    <button type="submit" class="checkout-btn" name="proceed_to_payment_details">
                        <?php echo $templateParams["user_logged_in"] ? 'Procedi al pagamento' : 'Paga come ospite'; ?>
                    </button>
                </form>
                </div>
            </div>
        </div>

</section>