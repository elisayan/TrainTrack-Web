<section class="cart-section">
    <?php if (empty($templateParams["cart_items"]["tickets"]) && empty($templateParams["cart_items"]["subscriptions"])): ?>
        <div class="empty-cart">
            <h3><?php echo $templateParams["errorecarrello"]; ?></h3>
            <p>Sfoglia il nostro sito e aggiungi i tuoi biglietti o abbonamenti</p>
            <a href="home.php" class="btn btn-outline-primary">Torna alla homepage</a>
        </div>
    <?php else: ?>

        <div class="row">
            <div class="col-12 col-md-6">
                <?php if (!empty($templateParams["cart_items"]["tickets"])): ?>
                    <h2>Biglietti</h2>
                    <?php foreach ($templateParams["cart_items"]["tickets"] as $ticket): ?>
                        <?php
                            $ticket_form_id_suffix = htmlspecialchars($ticket['CodDettaglioCarrello']);
                            $ticket_description = "biglietto da " . htmlspecialchars($ticket["NomePartenza"]) . " a " . htmlspecialchars($ticket["NomeArrivo"]) . " del " . htmlspecialchars($ticket["DataPartenza"]);
                        ?>
                        <div class="card shadow p-4 cart-item">
                            <div class="cart-item-header">
                                <h3><span class="cart-item-type">Biglietto</span></h3>
                                <span class="cart-item-price"><?php echo number_format($ticket["Prezzo"], 2); ?>€</span>
                            </div>
                            <div class="card-body cart-item-details">
                                <div>
                                    <h4>Partenza</h4>
                                    <p><?php echo htmlspecialchars($ticket["NomePartenza"]); ?></p>
                                    <p><?php echo htmlspecialchars($ticket["DataPartenza"]); ?>             <?php echo htmlspecialchars($ticket["OrarioPartenza"]); ?></p>
                                </div>
                                <div>
                                    <h4>Arrivo</h4>
                                    <p><?php echo htmlspecialchars($ticket["NomeArrivo"]); ?></p>
                                    <p><?php echo htmlspecialchars($ticket["DataArrivo"]); ?>             <?php echo htmlspecialchars($ticket["OrarioArrivo"]); ?></p>
                                </div>
                                <div>
                                    <h4>Dettagli</h4>
                                    <p>Treno: <?php echo htmlspecialchars($ticket["TipoTreno"]); ?></p>
                                    <p>Posti disponibili: <?php echo htmlspecialchars($ticket["postidisponibili"]); ?></p>
                                </div>
                            </div>
                            <div class="cart-item-actions">
                                <form method="post" class="quantity-form" aria-label="Modifica quantità per <?php echo $ticket_description; ?>">
                                    <input type="hidden" name="item_id" value="<?php echo $ticket['CodDettaglioCarrello']; ?>">
                                    <label for="quantity_ticket_<?php echo $ticket_form_id_suffix; ?>">Quantità:</label>
                                    <input type="number" name="quantity" id="quantity_ticket_<?php echo $ticket_form_id_suffix; ?>" value="<?php echo $ticket['Quantità']; ?>" min="1" max="10">
                                    <button type="submit" name="update_quantity" class="btn btn-sm btn-outline-secondary">Aggiorna</button>
                                </form>
                                <form method="post" aria-label="Rimuovi <?php echo $ticket_description; ?>">
                                    <input type="hidden" name="item_id" value="<?php echo $ticket['CodDettaglioCarrello']; ?>">
                                    <button type="submit" name="remove_item" class="btn-remove">
                                        Rimuovi
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

                <?php if (!empty($templateParams["cart_items"]["subscriptions"])): ?>
                    <h2>Abbonamenti</h2>
                    <?php foreach ($templateParams["cart_items"]["subscriptions"] as $subscription): ?>
                        <?php
                            $subscription_form_id_suffix = htmlspecialchars($subscription['CodDettaglioCarrello']);
                            $subscription_description = "abbonamento da " . htmlspecialchars($subscription["NomePartenza"]) . " a " . htmlspecialchars($subscription["NomeArrivo"]) . " (" . htmlspecialchars($subscription["Durata"]) . ")";
                        ?>
                        <div class="card shadow p-4 cart-item">
                            <div class="cart-item-header">
                                <h3><span class="cart-item-type">Abbonamento</span></h3>
                                <span class="cart-item-price"><?php echo number_format($subscription["Prezzo"], 2); ?>€</span>
                            </div>
                            <div class="card-body cart-item-details">
                                <div>
                                    <h4>Partenza</h4>
                                    <p><?php echo htmlspecialchars($subscription["NomePartenza"]); ?></p>
                                </div>
                                <div>
                                    <h4>Arrivo</h4>
                                    <p><?php echo htmlspecialchars($subscription["NomeArrivo"]); ?></p>
                                </div>
                                <div>
                                    <h4>Dettagli</h4>
                                    <p>Treno: <?php echo htmlspecialchars($subscription["TipoTreno"]); ?></p>
                                    <p>Durata: <?php echo htmlspecialchars($subscription["Durata"]); ?></p>
                                    <p>Valido dal: <?php echo htmlspecialchars($subscription["DataPartenza"]); ?></p>
                                </div>
                            </div>
                            <div class="cart-item-actions">
                                <form method="post" class="quantity-form" aria-label="Modifica quantità per <?php echo $subscription_description; ?>">
                                    <input type="hidden" name="item_id" value="<?php echo $subscription['CodDettaglioCarrello']; ?>">
                                    <label for="quantity_subscription_<?php echo $subscription_form_id_suffix; ?>">Quantità:</label>
                                    <input type="number" name="quantity" id="quantity_subscription_<?php echo $subscription_form_id_suffix; ?>" value="<?php echo $subscription['Quantità']; ?>" min="1" max="10">
                                    <button type="submit" name="update_quantity" class="btn btn-sm btn-outline-secondary">Aggiorna</button>
                                </form>
                                <form method="post" aria-label="Rimuovi <?php echo $subscription_description; ?>">
                                    <input type="hidden" name="item_id" value="<?php echo $subscription['CodDettaglioCarrello']; ?>">
                                    <button type="submit" name="remove_item" class="btn-remove">
                                        Rimuovi
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="col-12 col-md-6 mt-5">
                <div class="card shadow p-4 mt-0 cart-summary sticky-top">
                    <h3>Riepilogo Ordine</h3>
                    <div class="summary-row">
                        <span>Totale provvisorio:</span>
                        <span class="price"><?php echo number_format($templateParams["total_price"], 2); ?>€</span>
                    </div>

                    <?php if (isset($templateParams["messaggioBuono"])): ?>
                        <div class="alert alert-<?php echo $templateParams["discount_success"] ? 'success' : 'danger'; ?> alert-dismissible fade show mb-4"
                            role="alert">
                            <?php echo $templateParams["messaggioBuono"]; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="discount-section mt-3 mb-3">
                        <form method="post" class="discount-form" aria-label="Applica codice sconto">
                            <div class="input-group" style="height: 38px;">
                                <label for="discount_code" class="form-label visually-hidden">Inserisci codice sconto</label>
                                <input type="text" name="discount_code" id="discount_code" class="form-control h-100 border-end-0"
                                    placeholder="Inserisci codice sconto" aria-label="Codice sconto">
                                <button type="submit" name="apply_discount"
                                    class="btn btn-primary h-100 px-3 d-flex align-items-center">
                                    Applica
                                </button>
                            </div>
                        </form>

                        <?php if (isset($templateParams["discount_message"])): ?>
                            <div
                                class="alert alert-<?php echo $templateParams["discount_success"] ? 'success' : 'danger'; ?> mt-2 mb-2 py-2">
                                <?php echo $templateParams["discount_message"]; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if (isset($templateParams["discount_amount"])): ?>
                        <div class="summary-row text-success mt-2">
                            <span>Sconto applicato:</span>
                            <span class="price">-<?php echo number_format($templateParams["discount_amount"], 2); ?>€</span>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($templateParams["discounted_total"])): ?>
                        <div class="summary-row fw-bold border-top pt-2 mt-2">
                            <span>Totale scontato:</span>
                            <span class="price"><?php echo number_format($templateParams["discounted_total"], 2); ?>€</span>
                        </div>
                    <?php endif; ?>

                    <a href="checkout.php" class="checkout-btn">
                        <?php echo $templateParams["user_logged_in"] ? 'Procedi all\'ordine' : 'Continua come ospite'; ?>
                    </a>

                    <?php if (!$templateParams["user_logged_in"]): ?>
                        <p class="login-suggestion">
                            Hai un account? <a href="login.php">Accedi</a> per un checkout più veloce
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>