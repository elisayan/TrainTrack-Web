<section class="search-subscription-section">
    <div class="row">
        <div class="col-12 col-md-6">
<?php if(isset($templateParams["errore_ricerca_abbonamento"])):?>
            <p class="error"><?php echo $templateParams["errore_ricerca_abbonamento"]; ?></p>
            <?php endif; ?>
    <form class="card shadow subscription p-4 mt-0 mb-5" action="search-subscriptions-results.php" method="GET">
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
                            <datalist>
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
    <!-- Carousel Section -->
        <div class="col-12 col-md-6">
            <div id="popularSubsCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
                <div class="carousel-inner">
            <!-- Popular Route 1 -->
                    <div class="carousel-item active">
                        <div class="card sub-card shadow" onclick="searchSub('Bologna Centrale', 'Forlì', 'Intercity', 'Settimanale')" role="button">
                            <div class="card-body">
                                <h3 class="route-title">Bologna Centrale → Forlì</h3>
                                <p class="route-description">Treno Intercity durata settimanale</p>
                            </div>
                        </div>
                    </div>
            
            <!-- Popular Route 2 -->
                    <div class="carousel-item">
                        <div class="card sub-card shadow" onclick="searchSub('Piacenza', 'Parma', 'Frecciarossa', 'Mensile')" role="button">
                            <div class="card-body">
                                <h3 class="route-title">Piacenza → Parma</h3>
                                <p class="route-description">Treno Frecciarossa durata mensile</p>
                            </div>
                        </div>
                    </div>
            
            <!-- Popular Route 3 -->
                    <div class="carousel-item">
                        <div class="card sub-card shadow" onclick="searchSub('Bologna Centrale', 'Ravenna', 'Regionale', 'Annuale')" role="button">
                            <div class="card-body">
                                <h3 class="route-title">Bologna Centrale → Ravenna</h3>
                                <p class="route-description">Treno Regionale durata annuale</p>
                            </div>
                        </div>
                    </div>
                </div><!-- 
                <a class="carousel-control-prev" href="#popularSubsCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#popularSubsCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a> -->
            </div>
        </div>
</section>