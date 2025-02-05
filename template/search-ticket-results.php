<section>
    <header>
        <div class="row justify-content-center">
            <p><?php echo $departureStation; ?></p>
            <img src="" alt="">
            <p><?php echo $destinationStation; ?></p>
            <img src="" alt="">
            <p><?php echo $departureDate; ?></p>
            <img src="" alt="">
            <p><?php echo $departureTime; ?></p>
        </div>
    </header>
    <div class="grid-container">
        <?php foreach($templateParams["biglietti"] as $biglietto): ?>
        <article>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <p>tipo</p>
                        <p>partenza</p>
                        <p>arrivo</p>
                        <p>prezzo</p>
                    </div>
                    <div class="col">
                        <p><?php echo $biglietto["tipotreno"]; ?></p>
                        <p><?php echo $biglietto["datapartenza"]; ?> <?php echo $biglietto["orariopartenza"]; ?></p>
                        <p><?php echo $biglietto["dataarrivo"]; ?> <?php echo $biglietto["orarioarrivo"]; ?></p>
                        <p><?php echo $biglietto["prezzo"]; ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto me-auto">
                        <p><?php echo $biglietto["postidisponibili"]; ?> posti disponibili</p>
                    </div>
                    <div class="col-auto">
                        <a href=""><img src="" alt=""></a>
                    </div>
                </div>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>