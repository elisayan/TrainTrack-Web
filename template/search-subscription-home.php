<section>
    <form action="#" method="GET">
        <div class="container">
            <div class="row justify-content-center">
                <div class="row station">

                

                    <div class="col-md-12 col-lg-6">
                        <label class="station" for="departure-station">Partenza:</label>
                        <input class="form-control" list="datalistStation" id="departure-station" name="departure-station" />
                            <datalist id="datalistStation">
                                <option value="Bologna"> <!--usare il db-->
                                <option value="Cesena">
                            </datalist>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <label class="station" for="destination-station">Arrivo:</label>
                        <input class="form-control" list="datalistStation" id="destination-station" name="destination-station" />
                            <datalist id="datalistStation">
                                <option value="Bologna"> <!-- usare il db -->
                                <option value="Cesena">
                            </datalist>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <select class="form-select" aria-label="duration">
                            <option selected>Durata</option>
                            <option value="Settimanale">Settimanale</option>
                            <option value="Mensile">Mensile</option>
                            <option value="Annuale">Annuale</option>
                            <!--usare il db-->
                        </select>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <select class="form-select" aria-label="train-type">
                            <option selected>Tipo treno</option>
                            <option value="Regionale">Regionale</option>
                            <option value="Intercity">Intercity</option>
                            <option value="Frecciarossa">Frecciarossa</option>
                            <!--usare il db-->
                        </select>
                    </div>
            </div>
                
            <div class="row">
                    <div class="col-auto me-auto"></div>
                    <div class="col-auto">
                    <button class="btn btn-secondary btn-sm" type="button">CERCA</button>
                    </div>
                </div>
                </div>
                
                
        </div>
    </form>
</section>