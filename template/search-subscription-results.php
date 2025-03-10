<section>
    <header>
        <div class="row justify-content-center searchheader">
            <div class="col-md-7 col-lg-5">
                <div class="row">
                    <div class="col-auto">
                        <p><?php echo $departureStationSub; ?></p>
                    </div>
                    <div class="col-auto">
                        <img src="./img/next.png" alt="">
                    </div>
                    <div class="col-auto">
                        <p><?php echo $destinationStationSub; ?></p>
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
                        <p><?php echo $abbonamento["tipotreno"]; ?></p>
                        <p><?php echo $startDate; ?></p>
                        <p><?php echo $abbonamento["durata"]; ?></p>
                        <p><?php echo $abbonamento["prezzo"]; ?>€</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto me-auto">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-primary btn-sm"><img src="./img/cart.png" alt=""></button>
                    </div>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>