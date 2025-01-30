<section>
    <form action="#" method="GET">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row station">

                

                    <div class="col-md-12 col-lg-2">
                        <label class="station" for="departure-station">Partenza:</label>
                        <input class="form-control" list="datalistStation" id="departure-station" name="departure-station" />
                            <datalist id="datalistStation">
                                <option value="Bologna"> <!--usare il db-->
                                <option value="Cesena">
                            </datalist>
                    </div>

                    <div class="col-md-12 col-lg-2">
                        <label class="station" for="destination-station">Arrivo:</label>
                        <input class="form-control" list="datalistStation" id="destination-station" name="destination-station" />
                            <datalist id="datalistStation">
                                <option value="Bologna"> <!-- usare il db -->
                                <option value="Cesena">
                            </datalist>
                    </div>



                    <div class="col-md-12 col-lg-8">
                        <div class="row">


                            <div class="col-md-6 col-lg-6">
                                <div class="row">
                                <input class="form-control" type="date" id="datePicker">
                                <span id="dateSelected"></span>
                                </div>
                                <div class="row">                    
                                <input class="form-control" type="time" id="timePicker">
                                <span id="timeSelected"></span>
                                </div>
                            </div>
                    

                            <div class="col-md-6 col-lg-6">
                                <div class="row adult justify-content-end">
                                    <div class="col-auto passenger">
                                        <label for="adult"><img src="./img/user.png" alt="adulto"></label>
                                    </div>
                                    <div class="col-auto passenger">
                                        <button class="passenger"><img src="./img/minus.png" alt="meno"></button>
                                    </div>
                                    <div class="col-auto passenger">
                                        <input type="text" value="1" id="adult">
                                    </div>
                                    <div class="col-auto passenger">
                                        <button class="passenger"><img src="./img/more.png" alt="più"></button>
                                    </div>
                                </div>

                                <div class="row kid justify-content-end">
                                    <div class="col-auto passenger">
                                        <label class="kid" for="kid"><img src="./img/user.png" alt="bambino"></label>
                                    </div>
                                    <div class="col-auto passenger">
                                        <button class="passenger"><img src="./img/minus.png" alt="meno"></button>                            
                                    </div>
                                    <div class="col-auto passenger">
                                        <input type="text" value="0" id="kid">                            
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
                            <input class="form-check-input" type="checkbox" id="bike">
                            <label for="bike">bici</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="pet">
                            <label for="pet">animale domestico</label>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-secondary btn-sm" type="button">CERCA</button>
                    </div>
                </div>
                </div>
                
                
            </div>
        </div>
    </form>
</section>