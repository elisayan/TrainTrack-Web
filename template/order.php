<section class="order-section">
    <div class="order text-center">
    <h3>Grazie!</h3>
    <p>Il tuo ordine è stato ricevuto con successo.</p>
    <p>Se hai domande, non esitare a contattarci.</p>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
        <?php if(!empty($templateParams["cart_items"]["tickets"])): ?>
            <h2>Biglietti</h2>
            <?php foreach($templateParams["cart_items"]["tickets"] as $ticket): ?>
                <div class="card shadow p-4 mb-4 order-service">
                    <div class="order-service-header">
                        <span class="order-service-type">Biglietto</span>
                        <span class="order-service-price"><?php echo number_format($ticket["Prezzo"], 2); ?>€</span>
                    </div>
                    <div class="card-body order-service-details">
                        <div>
                            <h4>Partenza</h4>
                            <p><?php echo $ticket["NomePartenza"]; ?></p>
                            <p><?php echo $ticket["DataPartenza"]; ?> <?php echo $ticket["OrarioPartenza"]; ?></p>
                        </div>
                        <div>
                            <h4>Arrivo</h4>
                            <p><?php echo $ticket["NomeArrivo"]; ?></p>
                            <p><?php echo $ticket["DataArrivo"]; ?> <?php echo $ticket["OrarioArrivo"]; ?></p>
                        </div>
                        <div>
                            <h4>Dettagli</h4>
                            <p>Treno: <?php echo $ticket["TipoTreno"]; ?></p>
                            <p>Posti disponibili: <?php echo $ticket["postidisponibili"]; ?></p>
                        </div>
                        <div>
                            <h4>Passeggero</h4>
                            <p>Nome: <?php echo $ticket["passenger_first_name"]; ?></p>
                            <p>Cognome: <?php echo $ticket["passenger_last_name"]; ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>

        <?php if(!empty($templateParams["cart_items"]["subscriptions"])): ?>
            <h2>Abbonamenti</h2>
        <?php foreach($templateParams["cart_items"]["subscriptions"] as $subscription): ?>
            <div class="card shadow p-4 mb-4 order-service">
                    <div class="order-service-header">
                        <span class="order-service-type">Abbonamento</span>
                        <span class="order-service-price"><?php echo number_format($subscription["Prezzo"], 2); ?>€</span>
                    </div>
                    <div class="card-body order-service-details">
                        <div>
                            <h4>Partenza</h4>
                            <p><?php echo $subscription["NomePartenza"]; ?></p>
                        </div>
                        <div>
                            <h4>Arrivo</h4>
                            <p><?php echo $subscription["NomeArrivo"]; ?></p>
                        </div>
                        <div>
                            <h4>Dettagli</h4>
                            <p>Treno: <?php echo $subscription["TipoTreno"]; ?></p>
                            <p>Durata: <?php echo $subscription["Durata"]; ?></p>
                            <p>Valido dal: <?php echo $subscription["DataPartenza"]; ?></p>
                        </div>
                        <div>
                            <h4>Passeggero</h4>
                            <p>Nome: <?php echo $subscription["subscription_passenger_first_name"]; ?></p>
                            <p>Cognome: <?php echo $subscription["subscription_passenger_last_name"]; ?></p>
                        </div>
                    </div>
                </div>
        </div>
            <?php endforeach; ?>
            <?php endif; ?>
        <div class="col-12 col-md-6">
            <div class="card shadow p-4 mb-4 order-summary">
                <h2>Riepilogo Ordine</h2>
                <div class="order-summary-details">
                    <p><strong>Totale Biglietti:</strong> <?php echo number_format($templateParams["ticket_price"], 2); ?>€</p>
                    <p><strong>Totale Abbonamenti:</strong> <?php echo number_format($templateParams["subscription_price"], 2); ?>€</p>
                    <p><strong>Totale Ordine:</strong> <?php echo number_format($templateParams["total_price"], 2); ?>€</p>
                </div>
                <div class="order-summary-actions">
                    <a href="index.php" class="btn btn-primary">Torna alla Home</a>
                    <a href="orders.php" class="btn btn-secondary">Visualizza Ordini</a>

            </div>

        </div>

    </div>

</section>