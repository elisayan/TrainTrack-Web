<section>
    <form action="search-tickets-results.php" method="GET">
            <?php if(isset($templateParams["errore_ricerca_biglietto"])): ?>
            <p><?php echo $templateParams["errore_ricerca_biglietto"]; ?></p>
            <?php endif; ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="row station">

                

                    <div class="col-md-12 col-lg-2">
                        <label class="station" for="stazione_partenza">Partenza:</label>
                        <input class="form-control" list="datalistStation" id="stazione_partenza" name="stazione_partenza" />
                            <datalist id="datalistStation">
                                <?php foreach($templateParams["nome_stazioni"] as $stazione): ?>
                                <option value="<?php echo $stazione["nome_stazioni"]; ?>">
                                <?php endforeach; ?>
                            </datalist>
                    </div>

                    <div class="col-md-12 col-lg-2">
                        <label class="station" for="stazione_arrivo">Arrivo:</label>
                        <input class="form-control" list="datalistStation" id="stazione_arrivo" name="stazione_arrivo" />
                            <datalist id="datalistStation">
                                <?php foreach($templateParams["nome_stazioni"] as $stazione): ?>
                                <option value="<?php echo $stazione["nome_stazioni"]; ?>">
                                <?php endforeach; ?>
                            </datalist>
                    </div>



                    <div class="col-md-12 col-lg-8">
                        <div class="row">


                            <div class="col-md-6 col-lg-6">
                                <div class="row">
                                <input class="form-control" type="date" id="data_partenza" name="data_partenza">
                                </div>
                                <div class="row">                    
                                <input class="form-control" type="time" id="orario_partenza" name="orario_partenza">
                                </div>
                            </div>
                    

                            <div class="col-md-6 col-lg-6">
                                <div class="row adult justify-content-end">
                                    <div class="col-auto passenger">
                                        <label for="numero_biglietti_adulti"><img src="./img/user.png" alt="adulto"></label>
                                    </div>
                                    <div class="col-auto passenger">
                                        <button class="passenger"><img src="./img/minus.png" alt="meno"></button>
                                    </div>
                                    <div class="col-auto passenger">
                                        <input type="text" value="1" id="numero_biglietti_adulti" name="numero_biglietti_adulti">
                                    </div>
                                    <div class="col-auto passenger">
                                        <button class="passenger"><img src="./img/more.png" alt="più"></button>
                                    </div>
                                </div>

                                <div class="row kid justify-content-end">
                                    <div class="col-auto passenger">
                                        <label class="kid" for="numero_biglietti_bambini"><img src="./img/user.png" alt="bambino"></label>
                                    </div>
                                    <div class="col-auto passenger">
                                        <button class="passenger"><img src="./img/minus.png" alt="meno"></button>                            
                                    </div>
                                    <div class="col-auto passenger">
                                        <input type="text" value="0" id="numero_biglietti_bambini" name="numero_biglietti_bambini">                            
                                    </div>
                                    <div class="col-auto passenger">
                                        <button class="passenger"><img src="./img/more.png" alt="più"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-auto me-auto">
                        <div class="row service">
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

                <div class="row">
                    <div class="col-auto me-auto"></div>
                    <div class="col-auto">
                        <input class="btn btn-secondary btn-sm" type="submit" name="submit" value="CERCA">
                    </div>
                </div>
                </div>
                
                
            </div>
        </div>
    </form>
</section>

<script>
    function updateTickets(inputId, change) {
        const input = document.getElementById(inputId);
        let value = parseInt(input.value) + change;
        if (value < 0) value = 0; // Ensure value doesn't go below 0
        input.value = value;
    }
</script>
