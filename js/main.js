var map;
var geocoder;


function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: -34.397, lng: 150.644},
    zoom: 15,
    zoomControl: false,
    mapTypeControl: false,
    //scaleControl: false,
    streetViewControl: false,
    //rotateControl: boolean,
    fullscreenControl: false
  
    });    

    var styledMapType = new google.maps.StyledMapType(
        [
            {
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#f5f5f5"
                }
            ]
            },
            {
            "elementType": "labels.icon",
            "stylers": [
                {
                "visibility": "off"
                }
            ]
            },
            {
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#616161"
                }
            ]
            },
            {
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                "color": "#f5f5f5"
                }
            ]
            },
            {
            "featureType": "administrative.land_parcel",
            "stylers": [
                {
                "visibility": "on"
                }
            ]
            },
            {
            "featureType": "administrative.land_parcel",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#bdbdbd"
                }
            ]
            },
            {
            "featureType": "landscape.natural.landcover",
            "stylers": [
                {
                "visibility": "on"
                }
            ]
            },
            {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#eeeeee"
                }
            ]
            },
            {
            "featureType": "poi",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#757575"
                }
            ]
            },
            {
            "featureType": "road",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#ffffff"
                }
            ]
            },
            {
            "featureType": "road.arterial",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#757575"
                }
            ]
            },
            {
            "featureType": "road.highway",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#bdc5e8"
                }
            ]
            },
            {
            "featureType": "road.highway",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#616161"
                }
            ]
            },
            {
            "featureType": "road.local",
            "elementType": "geometry.fill",
            "stylers": [
                {
                "color": "#dadde5"
                }
            ]
            },
            {
            "featureType": "road.local",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#9e9e9e"
                }
            ]
            },
            {
            "featureType": "transit.line",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#eeeeee"
                }
            ]
            },
            {
            "featureType": "transit.station",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#eeeeee"
                }
            ]
            },
            {
            "featureType": "transit.station.rail",
            "elementType": "labels.icon",
            "stylers": [
                {
                "visibility": "on"
                }
            ]
            },
            {
            "featureType": "transit.station.rail",
            "elementType": "labels.text",
            "stylers": [
                {
                "visibility": "off"
                }
            ]
            },
            {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                "color": "#c9c9c9"
                }
            ]
            },
            {
            "featureType": "water",
            "elementType": "labels.text.fill",
            "stylers": [
                {
                "color": "#9e9e9e"
                }
            ]
            }
        ]
    );
    //Associate the styled map with the MapTypeId and set it to display.
    map.mapTypes.set('styled_map', styledMapType);
    map.setMapTypeId('styled_map');

    geocoder = new google.maps.Geocoder();

    if ( stack_adress.length ) {
        for(var i=0; i < stack_adress.length; i++) {
            codeAddress( stack_adress[i] );

        }
    }
    

}

function codeAddress(address) {
    geocoder.geocode( { 'address': address}, function(results, status) {
    if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
        
    } else {
        alert('Geocode was not successful for the following reason: ' + status);
    }
    });
}


  



$(function() {
    
   
    

});