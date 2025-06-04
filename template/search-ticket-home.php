<section class="search-ticket-section">
    <div class="row">
        <div class="col-12 col-md-6">
            <form class="card shadow p-3 mb-5" action="search-tickets-results.php" method="GET" aria-label="ricerca biglietto">
            <?php if (isset($templateParams["errore_ricerca_biglietto"])): ?>
                <p class="error"><?php echo $templateParams["errore_ricerca_biglietto"]; ?></p>
            <?php endif; ?>
                <div class="row justify-content-center">
                    <div class="row station">
                        <div class="col-md-12">
                            <label class="station ticket" for="stazione_partenza">Partenza:</label>
                            <input class="form-control" list="datalistStation" id="stazione_partenza" name="stazione_partenza" required />
                            <datalist id="datalistStation">
                            <?php foreach ($templateParams["nome_stazioni"] as $stazione): ?>
                                <option value="<?php echo $stazione["nome_stazioni"]; ?>">
                            <?php endforeach; ?>
                            </datalist>
                        </div>

                        <div class="col-md-12">
                            <label class="station ticket" for="stazione_arrivo">Arrivo:</label>
                            <input class="form-control" list="datalistStation" id="stazione_arrivo" name="stazione_arrivo" required />
                        </div>

                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-lg-6">
                                    <div class="row">
                                        <label for="data_partenza" class="visually-hidden">Data di partenza</label>
                                    <input class="form-control" type="date" id="data_partenza" name="data_partenza" required>
                                    </div>
                                    <div class="row">
                                        <label for="orario_partenza" class="visually-hidden">orario di partenza</label>
                                        <input class="form-control" type="time" id="orario_partenza" name="orario_partenza" required>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                    <div class="row adult justify-content-end">
                                        <div class="col-auto passenger">
                                            <label for="numero_biglietti_adulti"><img src="./img/user.png" alt="Biglietti per adulti"></label>
                                        </div>
                                        <div class="col-auto passenger">
                                            <button type="button" class="passenger" onclick="updateTickets('numero_biglietti_adulti', -1)"><img src="./img/minus.png" alt="Togli un biglietto per adulto"></button>
                                        </div>
                                        <div class="col-auto passenger">
                                            <input type="text" value="1" id="numero_biglietti_adulti" name="numero_biglietti_adulti" aria-label="numero biglietti per adulti aggiunti" readonly>
                                        </div>
                                        <div class="col-auto passenger">
                                            <button type="button" class="passenger" onclick="updateTickets('numero_biglietti_adulti', 1)"><img src="./img/more.png" alt="Aggiungi un biglietto per adulto"></button>
                                        </div>
                                    </div>

                                    <div class="row kid justify-content-end">
                                        <div class="col-auto passenger">
                                            <label class="kid" for="numero_biglietti_bambini"><img src="./img/user.png" alt="Biglietti per bambini"></label>
                                        </div>
                                        <div class="col-auto passenger">
                                            <button type="button" class="passenger" onclick="updateTickets('numero_biglietti_bambini', -1)"><img src="./img/minus.png" alt="Togli un biglietto per un bambino"></button>
                                        </div>
                                        <div class="col-auto passenger">
                                            <input type="text" value="0" id="numero_biglietti_bambini" name="numero_biglietti_bambini" aria-label="numero di biglietti per bambini aggiunti" readonly>
                                        </div>
                                        <div class="col-auto passenger">
                                            <button type="button" class="passenger" onclick="updateTickets('numero_biglietti_bambini', 1)"><img src="./img/more.png" alt="Aggiungi un biglietto per un bambino"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="row service">
                        <div class="col-auto me-auto">
                            <div class="row row-service">
                                <p>Servizi Complementari:</p>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="bike" name="bike">
                                <label for="bike">bici</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="pet" name="pet">
                                <label for="pet">animale domestico</label>
                            </div>
                        </div>
                        <div class="col-auto"></div>
                    </div>

                    <div class="row button-search">
                        <div class="col-auto me-auto"></div>
                            <div class="col-auto">
                                <input class="btn btn-primary btn-sm btn-search" type="submit" name="submit" value="CERCA">
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    
        <!-- Carousel Section -->
        <div class="col-12 col-md-6">
            <div id="popularRoutesCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
                <div class="carousel-inner">
            <!-- Popular Route 1 -->
                    <div class="carousel-item active">
                        <div class="card route-card shadow" onclick="searchRoute('Bologna Centrale', 'Forlì')" role="button">
                            <div class="card-body">
                                <h2 class="route-title">Bologna Centrale → Forlì</h2>
                                <p class="route-description">Treno Intercity e Regionale</p>
                            </div>
                        </div>
                    </div>
            
            <!-- Popular Route 2 -->
                    <div class="carousel-item">
                        <div class="card route-card shadow" onclick="searchRoute('Piacenza', 'Parma')" role="button">
                            <div class="card-body">
                                <h2 class="route-title">Piacenza → Parma</h2>
                                <p class="route-description">Treno Frecciarossa e Regionale</p>
                            </div>
                        </div>
                    </div>
            
            <!-- Popular Route 3 -->
                    <div class="carousel-item">
                        <div class="card route-card shadow" onclick="searchRoute('Bologna Centrale', 'Ravenna')" role="button">
                            <div class="card-body">
                                <h2 class="route-title">Bologna Centrale → Ravenna</h2>
                                <p class="route-description">Treno Intercity e Regionale</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <a class="carousel-control-prev" href="#popularRoutesCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#popularRoutesCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a> -->
            </div>
        </div>
    </div>
</section>
