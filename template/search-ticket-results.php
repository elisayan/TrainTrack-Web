<section>
    <header>
        <div class="row searchheader">
            <div class="col-5">
                <div class="row">
                    <div class="col">
                        <p><?php echo $departureStation; ?></p>
                    </div>
                    <div class="col">
                        <img src="./img/next.png" alt="">
                    </div>
                    <div class="col">
                        <p><?php echo $destinationStation; ?></p>
                    </div>            
                </div>
            </div>
            <div class="col-5">
                <div class="row">
                    <div class="col">
                        <img src="./img/calendar.png" alt="">
                    </div>
                    <div class="col">
                        <p><?php echo $departureDate; ?></p>
                    </div>
                    <div class="col">
                        <p><?php echo $departureTime; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-2">
                <div class="row">
                    <div class="col">
                        <img src="./img/ticket.png" alt="">
                    </div>
                    <div class="col">
                        <p><?php echo $numberTickets; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="grid-container">
        <?php foreach($templateParams["biglietti"] as $biglietto): ?>
        <article>
            <div class="container">
                <div class="row">
                    <div class="col-4">
                        <p>Tipo</p>
                        <p>Partenza</p>
                        <p>Arrivo</p>
                        <p>Prezzo</p>
                    </div>
                    <div class="col-8">
                        <p><?php echo $biglietto["tipotreno"]; ?></p>
                        <p><?php echo $biglietto["datapartenza"]; ?> <?php echo $biglietto["orariopartenza"]; ?></p>
                        <p><?php echo $biglietto["dataarrivo"]; ?> <?php echo $biglietto["orarioarrivo"]; ?></p>
                        <p><?php echo $biglietto["prezzo"]/$biglietto["NumeroStazioni"]; ?>€</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto me-auto">
                        <p><?php echo $biglietto["postidisponibili"]; ?> posti disponibili</p>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-secondary btn-sm"><img src="./img/cart.png" alt=""></button>
                    </div>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>