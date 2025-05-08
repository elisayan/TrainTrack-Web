<section class="order-section">
    <div class="order text-center">
    <h3>Grazie!</h3>
    <p>Il tuo ordine è stato ricevuto con successo.</p>
    <p>Se hai domande, non esitare a contattarci.</p>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <h2>Biglietti</h2>
                <div class="card shadow p-4 mb-4 order-service">
                    <div class="order-service-header">
                        <span class="order-service-type">Biglietto</span>
                        <span class="order-service-price"><?php echo number_format($templateParams["ticket_price"], 2); ?>€</span>
                    </div>
                    <div class="card-body order-service-details">
                        <div>
                            <h4>Partenza</h4>
                            <p><?php echo $templateParams["departure_station"]; ?></p>
                            <p><?php echo $templateParams["departure_date"]; ?> <?php echo $templateParams["departure_time"]; ?></p>
                        </div>
                        <div>
                            <h4>Arrivo</h4>
                            <p><?php echo $templateParams["arrival_station"]; ?></p>
                            <p><?php echo $templateParams["arrival_date"]; ?> <?php echo $templateParams["arrival_time"]; ?></p>
                        </div>
                        <div>
                            <h4>Dettagli</h4>
                            <p>Treno: <?php echo $templateParams["train_type"]; ?></p>
                            <p>Posti disponibili: <?php echo $templateParams["available_seats"]; ?></p>
                        </div>
                        <div>
                            <h4>Passeggero</h4>
                            <p>Nome: <?php echo $templateParams["passenger_first_name"]; ?></p>
                            <p>Cognome: <?php echo $templateParams["passenger_last_name"]; ?></p>
                        </div>
                    </div>
                </div>
            <h2>Abbonamenti</h2>
                <div class="card shadow p-4 mb-4 order-service">
                    <div class="order-service-header">
                        <span class="order-service-type">Abbonamento</span>
                        <span class="order-service-price"><?php echo number_format($templateParams["subscription_price"], 2); ?>€</span>
                    </div>
                    <div class="card-body order-service-details">
                        <div>
                            <h4>Partenza</h4>
                            <p><?php echo $templateParams["subscription_departure_station"]; ?></p>
                        </div>
                        <div>
                            <h4>Arrivo</h4>
                            <p><?php echo $templateParams["subscription_arrival_station"]; ?></p>
                        </div>
                        <div>
                            <h4>Dettagli</h4>
                            <p>Treno: <?php echo $templateParams["TipoTreno"]; ?></p>
                            <p>Durata: <?php echo $templateParams["Durata"]; ?></p>
                            <p>Valido dal: <?php echo $templateParams["DataPartenza"]; ?></p>
                        </div>
                        <div>
                            <h4>Passeggero</h4>
                            <p>Nome: <?php echo $templateParams["subscription_passenger_first_name"]; ?></p>
                            <p>Cognome: <?php echo $templateParams["subscription_passenger_last_name"]; ?></p>
                        </div>
                    </div>
                </div>
        </div>
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