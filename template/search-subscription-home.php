<section>
<?php if(isset($templateParams["errore_ricerca_abbonamento"])):?>
            <p class="error"><?php echo $templateParams["errore_ricerca_abbonamento"]; ?></p>
            <?php endif; ?>
    <form class="card shadow p-4 mt-5" action="search-subscriptions-results.php" method="GET">
        <div class="container justify-content-center">
            <div class="row justify-content-center">
                <div class="row station">

                

                    <div class="col-md-12 col-lg-6">
                        <label class="station sub" for="departure-station">Partenza:</label>
                        <input class="form-control" list="datalistStation" id="departure-station" name="departure-station" required />
                            <datalist id="datalistStation">
                                <?php foreach($templateParams["nome_stazioni"] as $stazione): ?>
                                <option value="<?php echo $stazione["nome_stazioni"]; ?>">
                                <?php endforeach; ?>
                            </datalist>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <label class="station sub" for="destination-station">Arrivo:</label>
                        <input class="form-control" list="datalistStation" id="destination-station" name="destination-station" required />
                            <datalist id="datalistStation">
                                <?php foreach($templateParams["nome_stazioni"] as $stazione): ?>
                                <option value="<?php echo $stazione["nome_stazioni"]; ?>">
                                <?php endforeach; ?>
                            </datalist>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <select class="form-select" aria-label="duration" name="duration">
                            <option selected>Durata</option>
                            <?php foreach($templateParams["durate"] as $durate): ?>
                            <option value="<?php echo $durate["durate"]; ?>"><?php echo $durate["durate"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <select class="form-select" aria-label="train-type" name="train-type">
                            <option selected>Tipo treno</option>
                            <?php foreach($templateParams["tipo_treni"] as $tipo_treni): ?>
                            <option value="<?php echo $tipo_treni["tipo_treni"]; ?>"><?php echo $tipo_treni["tipo_treni"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
                
            <div class="row">
                    <div class="col-auto me-auto"></div>
                    <div class="col-auto">
                    <input class="btn btn-primary btn-sm" type="submit" value="CERCA">
                    </div>
                </div>
                </div>
                
                
        </div>
    </form>
</section>