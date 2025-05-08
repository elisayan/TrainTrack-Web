<section>
    <header>
        <div class="row justify-content-center searchheader">
            <div class="col-md-7 col-lg-5">
                <div class="row">
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext station" id="stazione-partenza-tic" value="<?php echo $departureStation; ?>" >
                    </div>
                    <div class="col-auto">
                        <img src="./img/next.png" alt="">
                    </div>
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext station" id="stazione-arrivo-tic" value="<?php echo $destinationStation; ?>" >
                    </div>            
                </div>
            </div>
    
            <div class="col-md-5 col-lg-2">
                <div class="row">
                    <div class="col">
                        <img src="./img/order.png" alt="">
                    </div>
                    <div class="col">
                        <p><?php echo $numberTickets; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-5">
                <div class="row">
                    <div class="col-auto">
                        <img src="./img/calendar.png" alt="">
                    </div>
                    <div class="col-auto">
                        <p><?php echo $departureDate; ?></p>
                    </div>
                    <div class="col-auto">
                        <p><?php echo $departureTime; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="card-deck">
        <?php foreach($templateParams["biglietti"] as $biglietto): ?>
        <article class="card shadow service p-2. mt-5">
        <form action="cart.php" method="POST">
        <input type="hidden" name="ticket_id" value="<?php echo $biglietto['CodServizio']; ?>">
        <input type="hidden" name="stazione_partenza" value="<?php echo $departureStation; ?>">
        <input type="hidden" name="stazione_arrivo" value="<?php echo $destinationStation; ?>">
        <input type="hidden" name="tipo_treno" value="<?php echo $biglietto['tipotreno']; ?>">
        <input type="hidden" name="data_partenza" value="<?php echo $biglietto['datapartenza']; ?>">
                    <div class="card-body col-12">
                <div class="row justify-content-center">
                    <div class="col-4 text">
                        <p>Tipo</p>
                        <p>Partenza</p>
                        <p>Arrivo</p>
                        <p>Prezzo</p>
                    </div>
                    <div class="col-8 data">
                        <input type="text" readonly class="form-control-plaintext" id="tipo-treno" value="<?php echo $biglietto["tipotreno"]; ?>" >
                        <div class="row">
                            <div class="col-7">
                                <input type="text" readonly class="form-control-plaintext" id="data-partenza" value="<?php echo $biglietto["datapartenza"]; ?>" >                    
                            </div>
                            <div class="col-5">
                                <input type="text" readonly class="form-control-plaintext" id="orario-partenza" value="<?php echo $biglietto["orariopartenza"]; ?>" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <input type="text" readonly class="form-control-plaintext" id="data-arrivo" value="<?php echo $biglietto["dataarrivo"]; ?>" >
                            </div>
                            <div class="col-5">
                                <input type="text" readonly class="form-control-plaintext" id="orario-arrivo" value="<?php echo $biglietto["orarioarrivo"]; ?>" >
                            </div>
                        </div>
                        <input type="text" readonly class="form-control-plaintext" id="prezzo" value="<?php echo number_format($biglietto["prezzo"], 2); ?>€" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto me-auto available">
                        <p><?php echo $biglietto["postidisponibili"]; ?> posti disponibili</p>
                    </div>
                    <div class="col-auto">
                        <input class="btn btn-primary btn-sm cart" type="submit" value="">
                    </div>
                </div>
            </div>
            </form>
        </article>
        <?php endforeach; ?>
    </div>
</section>