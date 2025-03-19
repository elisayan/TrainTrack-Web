<section>
<form action="cart.php" method="GET">
    <header>
        <div class="row justify-content-center searchheader">
            <div class="col-md-7 col-lg-5">
                <div class="row">
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext" id="stazione-partenza-sub" value="<?php echo $departureStationSub; ?>" >
                    </div>
                    <div class="col-auto">
                        <img src="./img/next.png" alt="">
                    </div>
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext" id="stazione-arrivo-sub" value="<?php echo $destinationStationSub; ?>" > 
                    </div>            
                </div>
            </div>
            <div class="col-md-5 col-lg-2">
                <div class="row">
                    <div class="col">
                        <img src="./img/ticket.png" alt="">
                    </div>
                    <div class="col">
                        <p><?php echo $trainType; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-5">
                <div class="row">
                    <div class="col-auto">
                        <img src="./img/calendar.png" alt="">
                    </div>
                    <div class="col-auto">
                        <p><?php echo $startDate; ?></p>
                    </div>
                    <div class="col-auto">
                        <p><?php echo $duration; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="grid-container">
        <?php foreach($templateParams["abbonamenti"] as $abbonamento): ?>
        <article>
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-5 type">
                        <p>Tipo</p>
                        <p>Partenza</p>
                        <p>Durata</p>
                        <p>Prezzo</p>
                    </div>
                    <div class="col-7 data">
                        <input type="text" readonly class="form-control-plaintext" id="tipo-treno" value="<?php echo $abbonamento["tipotreno"]; ?>" >
                        <input type="text" readonly class="form-control-plaintext" id="data-partenza" value="<?php echo $startDate; ?>">
                        <input type="text" readonly class="form-control-plaintext" id="durata" value="<?php echo $abbonamento["durata"]; ?>">
                        <input type="text" readonly class="form-control-plaintext" id="prezzo" value="<?php echo $abbonamento["prezzo"]; ?>€">
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto me-auto">
                    </div>
                    <div class="col-auto">
                        <input class="btn btn-primary btn-sm cart" type="submit" value="">
                    </div>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
    </form>
</section>