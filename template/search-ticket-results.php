<section>
    <header>
        <div class="row justify-content-center searchheader">
            <div class="col-md-7 col-lg-5">
                <div class="row">
                    <div class="col-auto">
                        <p><?php echo $departureStation; ?></p>
                    </div>
                    <div class="col-auto">
                        <img src="./img/next.png" alt="">
                    </div>
                    <div class="col-auto">
                        <p><?php echo $destinationStation; ?></p>
                    </div>            
                </div>
            </div>
    
            <div class="col-md-5 col-lg-2">
                <div class="row">
                    <div class="col">
                        <img src="./img/ticket.png" alt="">
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
    <div class="grid-container">
        <?php foreach($templateParams["biglietti"] as $biglietto): ?>
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
                        <input type="text" readonly class="form-control-plaintext" id="tipo-treno" value="<?php echo $biglietto["tipotreno"]; ?>" >
                        <div class="row">
                            <div class="col-6">
                                <input type="text" readonly class="form-control-plaintext" id="data-partenza" value="<?php echo $biglietto["datapartenza"]; ?>" >                    
                            </div>
                            <div class="col-6">
                                <input type="text" readonly class="form-control-plaintext" id="orario-partenza" value="<?php echo $biglietto["orariopartenza"]; ?>" >
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" readonly class="form-control-plaintext" id="data-arrivo" value="<?php echo $biglietto["dataarrivo"]; ?>" >
                            </div>
                            <div class="col-6">
                                <input type="text" readonly class="form-control-plaintext" id="orario-arrivo" value="<?php echo $biglietto["orarioarrivo"]; ?>" >
                            </div>
                        </div>
                        <input type="text" readonly class="form-control-plaintext" id="prezzo" value="<?php echo $biglietto["prezzo"]/$biglietto["NumeroStazioni"]; ?>€" >
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
        </article>
        <?php endforeach; ?>
    </div>
</section>