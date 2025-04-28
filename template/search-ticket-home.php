<section class="search-ticket-section">
    <div class="row">
        <div class="col-12 col-md-6">
            <form class="card shadow p-3 mb-5" action="search-tickets-results.php" method="GET">
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
                            <datalist id="datalistStation">
                            <?php foreach ($templateParams["nome_stazioni"] as $stazione): ?>
                                <option value="<?php echo $stazione["nome_stazioni"]; ?>">
                            <?php endforeach; ?>
                            </datalist>
                        </div>
                    
                    
                        <div class="col-md-12">
                            <div class="row justify-content-center">
                                <div class="col-md-6 col-lg-6">
                                    <div class="row">
                                    <input class="form-control" type="date" id="data_partenza" name="data_partenza" required>
                                    </div>
                                    <div class="row">
                                        <input class="form-control" type="time" id="orario_partenza" name="orario_partenza" required>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6">
                                
                                    <div class="row adult justify-content-end">
                                        <div class="col-auto passenger">
                                            <label for="numero_biglietti_adulti"><img src="./img/user.png" alt="Adult Icon"></label>
                                        </div>
                                        <div class="col-auto passenger">
                                            <button type="button" class="passenger" onclick="updateTickets('numero_biglietti_adulti', -1)"><img src="./img/minus.png" alt="Decrease"></button>
                                        </div>
                                        <div class="col-auto passenger">
                                            <input type="text" value="1" id="numero_biglietti_adulti" name="numero_biglietti_adulti" readonly>
                                        </div>
                                        <div class="col-auto passenger">
                                            <button type="button" class="passenger" onclick="updateTickets('numero_biglietti_adulti', 1)"><img src="./img/more.png" alt="Increase"></button>
                                        </div>
                                    </div>

                                
                                    <div class="row kid justify-content-end">
                                        <div class="col-auto passenger">
                                            <label class="kid" for="numero_biglietti_bambini"><img src="./img/user.png" alt="Child Icon"></label>
                                        </div>
                                        <div class="col-auto passenger">
                                            <button type="button" class="passenger" onclick="updateTickets('numero_biglietti_bambini', -1)"><img src="./img/minus.png" alt="Decrease"></button>
                                        </div>
                                        <div class="col-auto passenger">
                                            <input type="text" value="0" id="numero_biglietti_bambini" name="numero_biglietti_bambini" readonly>
                                        </div>
                                        <div class="col-auto passenger">
                                            <button type="button" class="passenger" onclick="updateTickets('numero_biglietti_bambini', 1)"><img src="./img/more.png" alt="Increase"></button>
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

<script>
    
    function updateTickets(inputId, change) {
        const input = document.getElementById(inputId);
        let value = parseInt(input.value) + change;
        if (value < 0) value = 0; 
        input.value = value;
    }

    
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const hours = String(today.getHours()).padStart(2, '0');
    const minutes = String(today.getMinutes()).padStart(2, '0');

    document.getElementById('data_partenza').value = `${year}-${month}-${day}`;
    document.getElementById('orario_partenza').value = `${hours}:${minutes}`;
</script>