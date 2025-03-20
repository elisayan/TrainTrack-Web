<section>
    <?php if (isset($templateParams["errore_carello"])): ?>
        <p class="error"><?php echo $templateParams["errore_carello"]; ?></p>
    <?php endif; ?>
    <div class="grid-container">
        <?php foreach($templateParams["biglietti-selezionati"] as $biglietto_selezionato): ?>
        <article>
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-4 text">
                        <p>Tipo</p>
                        <p>Partenza</p>
                        <p>Arrivo</p>
                        <p>Prezzo</p>
                    </div>
                    <div class="col-8 data">
                        <p><?php echo $biglietto_selezionato["tipotreno"]; ?></p>
                        <p><?php echo $biglietto_selezionato["datapartenza"]; ?> <?php echo $biglietto_selezionato["orariopartenza"]; ?></p>
                        <p><?php echo $biglietto_selezionato["dataarrivo"]; ?> <?php echo $biglietto_selezionato["orarioarrivo"]; ?></p>
                        <p><?php echo $biglietto_selezionato["prezzo"]/$biglietto_selezionato["NumeroStazioni"]; ?>€</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto me-auto available">
                        <p><?php echo $biglietto_selezionato["postidisponibili"]; ?> posti disponibili</p>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary btn-sm"><img src="./img/cart.png" alt=""></button>
                    </div>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>

    <div class="grid-container">
        <?php foreach($templateParams["abbonamenti-selezionati"] as $abbonamento_selezionato): ?>
        <article>
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-5 type">
                        <p>Stazione Partenza</p>
                        <p>Stazione Arrivo</p>
                        <p>Tipo</p>
                        <p>Partenza</p>
                        <p>Durata</p>
                        <p>Prezzo</p>
                    </div>
                    <div class="col-7 data">
                        <p><?php echo $abbonamento_selezionato["stazione-partenza-sub"]?></p>
                        <p><?php echo $abbonamento_selezionato["stazione-arrivo-sub"]?></p>
                        <p><?php echo $abbonamento_selezionato["tipo-treno"]; ?></p>
                        <p><?php echo $abbonamento_selezionato["data-partenza"]; ?></p>
                        <p><?php echo $abbonamento_selezionato["durata"]; ?></p>
                        <p><?php echo $abbonamento_selezionato["prezzo"]; ?>€</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto me-auto">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary btn-sm cart-remove"><img src="./img/removecart.png" alt="" class="minus-cart"></button>
                    </div>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>