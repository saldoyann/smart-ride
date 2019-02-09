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
                            <a id="car" href="#" class="waves-effect waves-teal btn-flat active"><img src="./assets/img/car.png" alt="voiture"></a>
                            <a id="tram" href="#" class="waves-effect waves-teal btn-flat"><img src="./assets/img/tram.png" alt="tramway"></a>
                            <a id="bike" href="#" class="waves-effect waves-teal btn-flat"><img src="./assets/img/bike.png" alt="vélo"></a>
                            <a id="scooter" href="#" class="waves-effect waves-teal btn-flat"><img src="./assets/img/scooter.png" alt="trottinette"></a>
                            <a id="walk" href="#" class="waves-effect waves-teal btn-flat"><img src="./assets/img/walk.png" alt="à pied"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s5">
                <div id="result"></div>
            </div>
        </div>
    </div>
</main>