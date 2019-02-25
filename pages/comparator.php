<main id="comparator">
    <?php include_once('./includes/components/search-form.php'); ?>
    <div class="container-fluid" id="comparator_chooser">
        <div class="row">
            <div class="col s7">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col s12">
                            <div id="map"></div>
                        </div>
                        <div class="col s12" id="transports" >
                            <a id="car" href="#" class="waves-effect waves-teal btn-flat"><img src="./assets/img/car.png" alt="voiture"></a>
                            <a id="tram" href="#" class="waves-effect waves-teal btn-flat"><img src="./assets/img/tram.png" alt="tramway"></a>
                            <a id="bike" href="#" class="waves-effect waves-teal btn-flat"><img src="./assets/img/bike.png" alt="vélo"></a>
                            <a id="scooter" href="#" class="waves-effect waves-teal btn-flat"><img src="./assets/img/scooter.png" alt="trottinette"></a>
                            <a id="walk" href="#" class="waves-effect waves-teal btn-flat"><img src="./assets/img/walk.png" alt="à pied"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s5">
                <div id="result">
                    <div class="content">
                        <div id="car">
                            <h5>Voiture</h5>
                            <div class="data">
                                <p>
                                    <img src="./assets/img/route.png">
                                    <span>Distance : <span id="distance"></span></span>
                                </p>
                                <p>
                                    <img src="./assets/img/stopwatch.png">
                                    <span>Durée : <span id="duration"></span></span>
                                </p>
                                <p>
                                    <img src="./assets/img/co2.png">
                                    <span>Pollution : <span id="pollution"></span></span>
                                </p>
                            </div>
                            <div class="pc-wrapper">
                                <div class="pc-title-wrapper">
                                    <span class="pc-title">Ce qu'il faut retenir :</span>
                                </div>
                                <div class="pc-senters">
                                    <p>
                                        <img src="./assets/img/wrong.png">
                                        <span>134 g/km d’émission en CO2</span>
                                    </p>
                                    <p>
                                        <img src="./assets/img/good.png">
                                        <span>Un confort optimal</span>
                                    </p>
                                    <p>
                                        <img src="./assets/img/wrong.png">
                                        <span>Polluant. Dame Nature n’approuve pas</span>
                                    </p>
                                    <p>
                                        <img src="./assets/img/wrong.png">
                                        <span>Bon courage dans les bouchons et pour se garer</span>
                                    </p>
                                    <p>
                                        <img src="./assets/img/wrong.png">
                                        <span>Sortez vos économies pour les frais de transport et d’entretien</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div id="tram">
                            <p>Distance : <span id="distance"></span></p>
                            <p>Durée : <span id="duration"></span></p>
                            <p>Pollution : <span id="pollution"></span></p>
                        </div>
                        <div id="bike">
                            <p>Distance : <span id="distance"></span></p>
                            <p>Durée : <span id="duration"></span></p>
                            <p>Pollution : <span id="pollution"></span></p>
                        </div>
                        <div id="scooter">
                            <p>Distance : <span id="distance"></span></p>
                            <p>Durée : <span id="duration"></span></p>
                            <p>Pollution : <span id="pollution"></span></p>
                        </div>
                        <div id="walk">
                            <p>Distance : <span id="distance"></span></p>
                            <p>Durée : <span id="duration"></span></p>
                            <p>Pollution : <span id="pollution"></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>