https://github.com/mapbox/mapbox-gl-directions/issues/170
// réuperer value et l'afficher sur la partie de droite
// mapbox/driving, mapbox/walking, mapbox/cycling


var page = window.location.pathname.split("/").pop();

var key = 'pk.eyJ1Ijoic2FsZG95YW5uLWRldjA2IiwiYSI6ImNqcHdlMTRpZTBha2o0M3BxanE0M3ozNzkifQ.gTiuAp5lXZOGQ2Ef8Lc9fA';

L.mapbox.accessToken = key;

var geocoder = L.mapbox.geocoder('mapbox.places');

var lui = null;

var transport = 'driving';

var vehicle = 'car';

var origin = [];

var destination = [];

var direction = null;

var init = 0;

$(function(){

    setActiveNavbarItem();

    $('input.autocomplete').autocomplete({
        data: {},
    });

    if(page == ''){

        $('#home #searchForm').submit(function(e){
            e.preventDefault();
            window.location.replace('./comparateur?from=' + URLserializer($('#from').val()) + '&to=' + URLserializer($('#to').val()));
        });
        
    }else if(page == 'comparateur'){
        
        mapboxgl.accessToken = key;

        map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v9',
            center: [7.2500, 43.7000],
            zoom: 12
        });

        dataChanger();

        let searchParams = new URLSearchParams(window.location.search)

        if(searchParams.has('from') && searchParams.has('to')){
            $('#from').val(searchParams.get('from')).addClass('valid');
            $("label[for='from']").addClass('active');
    
            $('#to').val(searchParams.get('to')).addClass('valid');
            $("label[for='to']").addClass('active');
    
            function onSourceData (e) {
                if (e.isSourceLoaded) {
                    map.off('sourcedata', onSourceData);
                    loadRoute();
                }
            }
    
            map.on('sourcedata', onSourceData);
        }

        $('#comparator #searchForm').submit(function(e){
            e.preventDefault();
            loadRoute();
        });

        $('#transports #car').click(function(e){
            e.preventDefault();
            vehicle = 'car';
            dataChanger();
        });

        $('#transports #tram').click(function(e){
            e.preventDefault();
            vehicle = 'tram';
            dataChanger();
        });

        $('#transports #bike').click(function(e){
            e.preventDefault();
            vehicle = 'bike';
            dataChanger();
        });

        $('#transports #scooter').click(function(e){
            e.preventDefault();
            vehicle = 'scooter';
            dataChanger();
        });

        $('#transports #walk').click(function(e){
            e.preventDefault();
            vehicle = 'walk';
            dataChanger();
        });

    }

    $('#from').keyup(function(){
        searchPlaces($(this));
        $(this).addClass('changed');
    });

    $('#to').keyup(function(){
        searchPlaces($(this));
        $(this).addClass('changed');
    });

    $('#searchForm input').on('change', function() {
        if($(this).hasClass('changed')){
            $(this).val('');
        }
        $(this).removeClass('changed');
    });

});

function URLserializer(str){
    return str.replace(/ /g, '+');
}
function URLdeserializer(str){
    return str.replace( '+' ,/ /g);;
}

function setActiveNavbarItem() {
    $('#nav-mobile a[href="./'+page+'"]').parent().addClass('active');
}

function searchPlaces(thisOne){
    if(thisOne.val() != ""){
        lui = thisOne;
        geocoder.query({ query: thisOne.val(), proximity: [43.675819, 7.289429] }, showPlaces);
    }
}

function showPlaces(err, data) {
    if(!err){
        var places = {};
        data.results.features.forEach(function(element) {
            places[element.place_name] = element.place_name;
        });
        if(lui){
            lui.autocomplete('updateData', places);
        }
    }
    lui = null;
}

function dataChanger(){

    if(vehicle == 'car'){
        transport = 'driving';
    } else if (vehicle == 'tram'){
        transport = 'driving';
    } else if (vehicle == 'bike'){
        transport = 'cycling';
    } else if (vehicle == 'scooter'){
        transport = 'cycling';
    } else if (vehicle == 'walk'){
        transport = 'walking';
    } 

    $('#transports .active').removeClass('active');
    $('#transports #'+vehicle).addClass('active');

    direction = new MapboxDirections({
        accessToken: mapboxgl.accessToken,
        unit: 'metric',
        interactive: false,
        profile: 'mapbox/'+transport,
        controls: {
            inputs: false,
            instructions: false,
            profileSwitcher: false
        }
    }); 

    if (init != 0){
        loadRoute();
    }else{
        map.addControl(direction);
        init = 1;
    }
}

function meterToKm(meter){
    if(meter > 1000){
        kms = meter/1000;

        return kms.toFixed(1)+" km"
    }else {
        return meter+" m";
    }
}

function secondeToTime(secondes){
    reste_secondes = secondes % 60;
    minutes = (secondes-reste_secondes)/60;

    if(minutes >= 60){
        reste_minutes = minutes % 60;
        heures = (minutes-reste_minutes)/60;

        return heures+" h "+reste_minutes+" min";
    }else{
        if(minutes == 0){
            minutes = 1;
        }
        return minutes+" min"
    }
}

function meterToCO2(meter){

    if(vehicle == 'car'){
        gParKm = 134.431579;
    } else if (vehicle == 'tram'){
        gParKm = 87.371;
    } else {
        gParKm = 0;
    }

    g = ((meter/1000)*gParKm);

    console.log(g);

    if(g >= 1000){
        return (g/1000).toFixed(1) + " kg de CO2";
    }else{
        return  g.toFixed(0)+ " g de CO2";
    }

}

function loadRoute(){
    geocoder.query({ query: $('#from').val(), proximity: [43.675819, 7.289429] }, function(err, data){
        if(!err){
            origin = data.results.features[0].center;
            direction.setOrigin(origin);
        }
    });
    
    geocoder.query({ query: $('#to').val(), proximity: [43.675819, 7.289429] }, function(err, data){
        if(!err){
            destination = data.results.features[0].center;
            direction.setDestination(destination);
        }
    });

    setTimeout(function() {
        url = 'https://api.mapbox.com/directions/v5';
        url += '/mapbox/'+transport;
        url += '/'+origin[0]+','+origin[1]+';'+destination[0]+','+destination[1]+'.json?';
        url += 'access_token='+key;
    
        $.getJSON( url, function( data ) {
            showData(data.routes[0].distance, data.routes[0].duration);
        });
    }, 200);

}

function showData(brutDistance, brutDuration){
    pollution = meterToCO2(brutDistance);
    distance = meterToKm(brutDistance);
    duration = secondeToTime(brutDuration);

    $('#result .active').removeClass('active');
    $('#result #'+vehicle).addClass('active');
    $('#result #'+vehicle+' #distance').html(distance);
    $('#result #'+vehicle+' #duration').html(duration);
    $('#result #'+vehicle+' #pollution').html(pollution);
}