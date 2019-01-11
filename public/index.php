<!DOCTYPE html>
<html>
  <head>
    <meta charset=utf-8 />
    <title>Comparer son trajet</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script src='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.js'></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.js'></script>
    <script src="../js/jquery.js"></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.css' type='text/css' />
    <link href='https://api.mapbox.com/mapbox.js/v3.1.1/mapbox.css' rel='stylesheet' />
    <link rel="stylesheet" href='../css/materialize.css' type='text/css' />
    <link rel="stylesheet" href='../css/style.css' type='text/css' />
  </head>
  <body>
  <div class="container">
    <div class="input-field row" id='inputs'></div>
    <div class='row'>
        <div class="col s7">
          <div class="container-fluid">
            <div class="row">
              <div class="col s12" id='map'></div>
              <div class="col s12" id='img'>
                <a id="car" href="#" class="waves-effect waves-teal btn-flat"><img src="../images/car.png" alt="voiture" height="100%" width="100%"></a>
                <a id="tram" href="#" class="waves-effect waves-teal btn-flat"><img src="../images/tram.png" alt="tramway" height="100%" width="100%"></a>
                <a id="velo" href="#" class="waves-effect waves-teal btn-flat"><img src="../images/bicycle.png" alt="velo" height="100%" width="100%"></a>
                <a id="trot" href="#" class="waves-effect waves-teal btn-flat"><img src="../images/kick.png" alt="trottinette" height="100%" width="100%"></a>
                <a id="marcheur" href="#" class="waves-effect waves-teal btn-flat"><img src="../images/walk.png" alt="marcheur" height="100%" width="100%"></a>
              </div>
            </div>
          </div>
        </div>
       <div class="col s4" id='comparer'></div>
    </div>
  </div>
  <div id='errors'></div>
  <div id='directions'>
    <div id='routes'></div>
    <div id='instructions'></div>
</div>
  <script src='../js/app.js'></script>
  </body>
</html>
