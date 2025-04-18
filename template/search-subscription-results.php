<section>
    <header>
        <div class="row justify-content-center searchheader">
            <div class="col-md-7 col-lg-5">
                <div class="row">
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext station" name="stazione-partenza-sub" value="<?php echo $departureStationSub; ?>" >
                    </div>
                    <div class="col-auto arrow">
                        <img src="./img/next.png" alt="">
                    </div>
                    <div class="col-auto">
                        <input type="text" readonly class="form-control-plaintext station" name="stazione-arrivo-sub" value="<?php echo $destinationStationSub; ?>" > 
                    </div>            
                </div>
            </div>
            <div class="col-md-5 col-lg-2">
                <div class="row">
                    <div class="col">
                        <img src="./img/orders.png" alt="">
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
        <article class="card shadow service p-2. mt-5">
        <form method="POST" action="cart.php" class="add-subscription-form">
                <input type="hidden" name="subscription_id" value="<?php echo $abbonamento['CodServizio']; ?>">
                <input type="hidden" name="stazione-partenza-sub" value="<?php echo $departureStationSub; ?>">
                <input type="hidden" name="stazione-arrivo-sub" value="<?php echo $destinationStationSub; ?>">
                <input type="hidden" name="tipo-treno-sub" value="<?php echo $trainType; ?>">
                <input type="hidden" name="durata" value="<?php echo $abbonamento['durata']; ?>">
                <input type="hidden" name="prezzo-sub" value="<?php echo $abbonamento['prezzo']; ?>">
            <div class="card-body col-12">
                <div class="row justify-content-center">
                    <div class="col-5 type">
                        <p>Tipo</p>
                        <p>Partenza</p>
                        <p>Durata</p>
                        <p>Prezzo</p>
                    </div>
                    <div class="col-7 data">
                        <input type="text" readonly class="form-control-plaintext" name="tipo-treno" value="<?php echo $abbonamento["tipotreno"]; ?>" >
                        <input type="text" readonly class="form-control-plaintext" name="data-partenza" value="<?php echo $startDate; ?>">
                        <input type="text" readonly class="form-control-plaintext" name="durata" value="<?php echo $abbonamento["durata"]; ?>">
                        <input type="text" readonly class="form-control-plaintext" name="prezzo" value="<?php echo $abbonamento["prezzo"]; ?>€">
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
        </form>
        </article>
        <?php endforeach; ?>
    </div>
</section>