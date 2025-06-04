<section>
    <header>
        <div class="row justify-content-center searchheader">
            <div class="col-md-7 col-lg-5">
                <div class="row">
                    <div class="col-auto">
                        <label for="stazione-partenza-tic-header" class="form-label visually-hidden">Stazione di partenza</label>
                        <input type="text" readonly class="form-control-plaintext station" aria-label="Stazione di partenza" id="stazione-partenza-tic-header"
                            value="<?php echo htmlspecialchars($departureStation); ?>">
                    </div>
                    <div class="col-auto">
                        <img src="./img/next.png" alt="">
                    </div>
                    <div class="col-auto">
                        <label for="stazione-arrivo-tic-header" class="form-label visually-hidden">Stazione di arrivo</label>
                        <input type="text" readonly class="form-control-plaintext station" aria-label="Stazione di arrivo" id="stazione-arrivo-tic-header"
                            value="<?php echo htmlspecialchars($destinationStation); ?>">
                    </div>
                </div>
            </div>

            <div class="col-md-5 col-lg-2">
                <div class="row">
                    <div class="col-auto">
                        <img src="./img/order.png" alt="Numero biglietti:">
                    </div>
                    <div class="col">
                        <p><?php echo htmlspecialchars($numberTickets); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-5">
                <div class="row">
                    <div class="col-auto">
                        <img src="./img/calendar.png" alt="Data e ora di partenza:">
                    </div>
                    <div class="col-auto">
                        <p><?php echo htmlspecialchars($departureDate); ?></p>
                    </div>
                    <div class="col-auto">
                        <p><?php echo htmlspecialchars($departureTime); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="ticket-grid">
        <?php foreach ($templateParams["biglietti"] as $biglietto): ?>
            <?php
                $unique_suffix = htmlspecialchars($biglietto['CodServizio']);
                $form_aria_label = "Aggiungi al carrello: biglietto " . htmlspecialchars($biglietto['tipotreno']) . " da " . htmlspecialchars($departureStation) . " a " . htmlspecialchars($destinationStation) . " del " . htmlspecialchars($biglietto['datapartenza']) . " alle " . htmlspecialchars($biglietto['orariopartenza']);
            ?>
            <article class="card shadow service p-2 mt-5">
                <form action="cart.php" method="POST" aria-label="<?php echo $form_aria_label; ?>">
                    <input type="hidden" name="ticket_id" value="<?php echo $biglietto['CodServizio']; ?>">
                    <input type="hidden" name="stazione_partenza" value="<?php echo htmlspecialchars($departureStation); ?>">
                    <input type="hidden" name="stazione_arrivo" value="<?php echo htmlspecialchars($destinationStation); ?>">
                    <input type="hidden" name="tipo_treno" value="<?php echo htmlspecialchars($biglietto['tipotreno']); ?>">
                    <input type="hidden" name="data_partenza" value="<?php echo htmlspecialchars($biglietto['datapartenza']); ?>">
                    <div class="card-body col-12">
                        <div class="row justify-content-center">
                            <div class="col-4 text">
                                <div class="row"><label for="tipo-treno_<?php echo $unique_suffix; ?>" class="form-control-plaintext">Tipo</label></div>
                                <div class="row"><span class="form-control-plaintext">Partenza</span></div> 
                                <div class="row"><span class="form-control-plaintext">Arrivo</span></div>  
                                <div class="row"><label for="prezzo_<?php echo $unique_suffix; ?>" class="form-control-plaintext">Prezzo</label></div>
                            </div>
                            <div class="col-8 data">
                                <input type="text" readonly class="form-control-plaintext" id="tipo-treno_<?php echo $unique_suffix; ?>"
                                    value="<?php echo htmlspecialchars($biglietto["tipotreno"]); ?>">
                                <div class="row">
                                    <div class="col-7">
                                        <label for="data-di-partenza_<?php echo $unique_suffix; ?>" class="form-label visually-hidden">Data di partenza</label>
                                        <input type="text" id="data-di-partenza_<?php echo $unique_suffix; ?>" readonly class="form-control-plaintext" aria-label="Data di partenza"
                                            value="<?php echo htmlspecialchars($biglietto["datapartenza"]); ?>">
                                    </div>
                                    <div class="col-5">
                                        <label for="orario-di-partenza_<?php echo $unique_suffix; ?>" class="form-label visually-hidden">Orario di partenza</label>
                                        <input type="text" id="orario-di-partenza_<?php echo $unique_suffix; ?>" readonly class="form-control-plaintext" aria-label="Orario di partenza"
                                            value="<?php echo htmlspecialchars($biglietto["orariopartenza"]); ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <label for="data-di-arrivo_<?php echo $unique_suffix; ?>" class="form-label visually-hidden">Data di arrivo</label>
                                        <input type="text" id="data-di-arrivo_<?php echo $unique_suffix; ?>" readonly class="form-control-plaintext" aria-label="Data di arrivo"
                                            value="<?php echo htmlspecialchars($biglietto["dataarrivo"]); ?>">
                                    </div>
                                    <div class="col-5">
                                        <label for="orario-di-arrivo_<?php echo $unique_suffix; ?>" class="form-label visually-hidden">Orario di arrivo</label>
                                        <input type="text" id="orario-di-arrivo_<?php echo $unique_suffix; ?>" readonly class="form-control-plaintext" aria-label="Orario di arrivo"
                                            value="<?php echo htmlspecialchars($biglietto["orarioarrivo"]); ?>">
                                    </div>
                                </div>
                                <input type="text" readonly class="form-control-plaintext" id="prezzo_<?php echo $unique_suffix; ?>"
                                    value="<?php echo number_format($biglietto["prezzo"], 2); ?>€">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto me-auto available">
                                <p><?php echo htmlspecialchars($biglietto["postidisponibili"]); ?> posti disponibili</p>
                            </div>
                            <div class="col-auto">
                                <input class="btn btn-primary btn-sm cart" type="submit" value="" aria-label="Aggiungi al carrello">
                            </div>
                        </div>
                    </div>
                </form>
            </article>
        <?php endforeach; ?>
    </div>
</section>