var coordinates = document.getElementById("inp-gps");
var locations;
var locations2;
var mylat;
var mylong;
var marker;
var map;
$(document).ready(function(){
    
        //showPosition("0");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        //coordinates.value = "33.8833,35.5000";
        //showPosition("0");
    }
   
});


function showPosition(position) {
    var gps = coordinates.value;

    if (position == "0") {
        var latlon = gps ? gps : "33.8833,35.5000";
        coordinates.value = latlon;
        mylat = "33.8833";
        mylong = "35.5000";

    } else {
           var latlon = position.coords.latitude + "," + position.coords.longitude;
           locations2   = latlon;
         if(!gps){ 
           coordinates.value = latlon;
       }else{
       
           var latlon =  gps;
           
           
           console.log("locations" , locations);
           
        }
        mylat = position.coords.latitude;
        mylong = position.coords.longitude;
        

    }
    latlong = latlon.split(',');
    locations = [
        ['My location', parseFloat(latlong[0]), parseFloat(latlong[1]), 1]
    ];
    $('#map').show();
    loadScript();
    
}

function initialize() {

   //  var map = new google.maps.Map(document.getElementById('map'), {
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 13,
       //  center: new google.maps.LatLng(mylat, mylong),
        center: new google.maps.LatLng(latlong[0], latlong[1]),
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        streetViewControl: false,
        panControl: false,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.BOTTOM_CENTER
        },
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
            position: google.maps.ControlPosition.LEFT_CENTER
        }
    });

    var infowindow = new google.maps.InfoWindow();

   //  var marker,
   var i;

    for (i = 0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            animation: google.maps.Animation.DROP,
            draggable: true,
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][0]);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }



    geocoder = new google.maps.Geocoder();

    //Update postal address when the marker is dragged
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({
            latLng: marker.getPosition()
        }, function(responses) {
            //console.log(responses);
            if (responses && responses.length > 0) {

                coordinates.value = marker.getPosition().lat() + "," + marker.getPosition().lng();


            } else {
                alert('Error: Google Maps could not determine the address of this location.');
            }
        });
        map.panTo(marker.getPosition());
    });




}

function loadScript() {
    var script = document.createElement('script');
    script.type = 'text/javascript';
    script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAaUGqflV5RYdD2UbnVF9DKP4eMek92Mek&v=3.exp&sensor=true&' + 'callback=initialize';
    //document.body.appendChild(script);
    $('#mapscript').html(script);
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            coordinates.value = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            coordinates.value = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            coordinates.value = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            coordinates.value = "An unknown error occurred."
            break;
    }
}


function set_marker_on_map(loc){
   var newlocation = loc.split(',');
   console.log("newlocation0 =>" ,  newlocation[0]);
   console.log("newlocation1 =>" ,  newlocation[1]);
   console.log("loc =>" +  loc);
   // var i = 0;
   if(typeof(google) === "undefined"){
       return 0 ;
   }
   // return 0;
    marker.setMap(null); 
    const myLatLng = { lat:  parseFloat(newlocation[0]) , lng: parseFloat(newlocation[1])  };
   map.setCenter(myLatLng);
    marker = new google.maps.Marker({
        position: myLatLng,
        animation: google.maps.Animation.DROP,
        draggable: true,
        map: map
    });

    google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
            infowindow.setContent(newlocation[0]);
            infowindow.open(map, marker);
        }
    })(marker, 0));
    
    
    

    geocoder = new google.maps.Geocoder();

    //Update postal address when the marker is dragged
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({
            latLng: marker.getPosition()
        }, function(responses) {
            //console.log(responses);
            if (responses && responses.length > 0) {

                coordinates.value = marker.getPosition().lat() + "," + marker.getPosition().lng();


            } else {
                alert('Error: Google Maps could not determine the address of this location.');
            }
        });
        map.panTo(marker.getPosition());
    });

    
    
    
} 