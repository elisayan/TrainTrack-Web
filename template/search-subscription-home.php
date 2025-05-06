<section class="search-subscription-section">
    <div class="row">
        <div class="col-12 col-md-6">
<?php if(isset($templateParams["errore_ricerca_abbonamento"])):?>
            <p class="error"><?php echo $templateParams["errore_ricerca_abbonamento"]; ?></p>
            <?php endif; ?>
    <form class="card shadow p-4 mt-5 mb-5" action="search-subscriptions-results.php" method="GET">
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
    </div>
    <div class="col-12 col-md-6">
            <div id="carouselExampleIndicators" class="carousel slide mb-5" data-bs-ride="carousel">

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="./img/blue.png" class="d-block w-100 img-carousel" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./img/red.png" class="d-block w-100 img-carousel" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="./img/green.png" class="d-block w-100 img-carousel" alt="...">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
            </div>
        </div>

    </div>
</section>