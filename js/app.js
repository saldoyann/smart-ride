var kms = []; 
function displayText(text){
    if($("#comparer").html() == text){
      $("#comparer").html("");
    }else{
      $("#comparer").html(text);
    }
  }

  $(document).ready(function () {
    $("#inputs span").removeClass("mapbox-directions-icon");
    $("#inputs label").remove();
    $("#mapbox-directions-origin-input").removeAttr("placeholder");
    $("#mapbox-directions-destination-input").removeAttr("placeholder");

    $("#inputs>form").css({"width" : "600px"});
    $("#inputs>form>div").addClass("col s6");
    $('#routes').hide();



    let target = $('#routes')[0];
    let observerOptions = {
        childList: true,
        attributes: true,
        subtree: true 
      }
      
      function callback(mutationList, observer) {
        var miles = [];
                 
        mutationList.forEach((mutation) => {
            var Mutation = [];
            var mile = [];
            
            for (var i = 0; i < mutation.addedNodes.length; i++) {
                if (mutation.type == "childList")
                {
                    Mutation.push(mutation.addedNodes[i].textContent);
                } 
            }
            for (var i = 0; i < Mutation.length; i++){
                if(!isNaN(parseInt(Mutation[i].substr(0,1))) ){            
                    mile.push(Mutation[i]);
                }
            }

            if(mile.length != 0) {

                tmp = 0;

                $(miles).each(function(){
                    if($(this)[0] == $(mile)[0]){
                        tmp = 1;
                    }
                })

                if(tmp == 0){
                    miles.push(mile);
                }
            }                    
        });

        for(var i = 0; i <miles.length; i++)
        {
            var CO2moyen = 134.431579;
            justMiles = miles[i]+''.split(' ');
            var M = justMiles[0]+justMiles[1]+justMiles[2]+justMiles[3] 
            console.log(justMiles[0]);
            var hk = parseFloat(M * 1.609).toFixed(1);
            var CO2parKM = hk * CO2moyen;
            kms.push(hk);
            kms.push(CO2parKM);
        }
        
        console.log(kms);

        // kms.forEach(function(element){
        //     $("#km").html(element+" kilometres <br />");
        // })
        
        //kms[0] est le chemin qui est actif et du coup affiché sur la map 
        $("#km").html(kms[0]+" kilometres <br />");    
    }

      let observer = new MutationObserver(callback);
      observer.observe(target, observerOptions);
    
  });

  $("#car").click(function () {
      displayText("<img src='../images/smoke.png' alt='CO2' height='42' width='42'>              <strong>"+kms[1]+"</strong> g / km");
  });

  $("#tram").click(function () {
    displayText("<h1>Tram</h1>");
  });

  $("#velo").click(function () {
    displayText("<h1>Velo</h1>");
  });

  $("#trot").click(function () {
    displayText("<h1>Trottinette</h1>");
  });

  $("#marcheur").click(function () {
    displayText("<h1>A pied</h1>");
  });

  L.mapbox.accessToken = 'pk.eyJ1Ijoic2FsZG95YW5uLWRldjA2IiwiYSI6ImNqcHdlMTRpZTBha2o0M3BxanE0M3ozNzkifQ.gTiuAp5lXZOGQ2Ef8Lc9fA';
  var map = L.mapbox.map('map', 'mapbox.streets', {
      zoomControl: false
  }).setView([43.700000, 7.250000], 12);

  map.attributionControl.setPosition('bottomleft');

  var directions = L.mapbox.directions();

  var directionsLayer = L.mapbox.directions.layer(directions)
      .addTo(map);

  var directionsInputControl = L.mapbox.directions.inputControl('inputs', directions)
      .addTo(map);

  var directionsErrorsControl = L.mapbox.directions.errorsControl('errors', directions)
      .addTo(map);

  var directionsRoutesControl = L.mapbox.directions.routesControl('routes', directions)
      .addTo(map);

  var directionsInstructionsControl = L.mapbox.directions.instructionsControl('instructions', directions)
      .addTo(map);

      
    
