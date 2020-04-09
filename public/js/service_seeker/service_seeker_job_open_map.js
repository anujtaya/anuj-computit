var markers = [];
var map, infoWindow, pos, current_job_marker;
var radius = 50;

function initMap() {
    // Try HTML5 geolocation.
    var  icons = {
        url: '/images/map/l2l_ss_job_map_icon.svg',
        scaledSize: new google.maps.Size(25, 25), // scaled size
    // origin: new google.maps.Point(0,0), // origin
    // anchor: new google.maps.Point(0, 0) // anchor
    };
    map = new google.maps.Map(document.getElementById('map'), {  
            zoom: 12,
            clickableIcons: false,
            gestureHandling: 'greedy',
            disableDefaultUI: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                },
            styles:[
                {
                    "featureType": "all",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "weight": "2.00"
                        }
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#9c9c9c"
                        }
                    ]
                },
                {
                    "featureType": "all",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 45
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#eeeeee"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#7b7b7b"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "color": "#46bcec"
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#b5dae1"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "color": "#070707"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        }
                    ]
                }
            ],
        }),

    current_job_marker = new google.maps.Marker({
        position: new google.maps.LatLng(job_lat,job_lng), //client's co-ordinates
        map: map,
        zIndex: 1,
        icon: icons,
    });
    current_job_marker.addListener('click', function() {
        map.panTo(current_job_marker.position);
        map.setZoom(14);
    });
    //set new current location on marker drag
    // google.maps.event.addListener(current_job_marker, 'dragend', function(evt) {
    //     find_nearby(current_job_marker.getPosition());
    // });
    map.setCenter(new google.maps.LatLng(job_lat,job_lng));
}
          
   
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i];
        infowindow = new google.maps.InfoWindow({});
        markers[i].addListener('click', function() {
            map.panTo(this.position);
            map.setZoom(14);
        });
        markers[i].setMap(map);
    }
}

function resetLocation() {
    map.setCenter(current_job_marker.position);
    map.panTo(current_job_marker.position);
    map.setZoom(11);
}

function find_nearby(pos) {
    viewAll(pos.lat(), pos.lng(), radius);
}

function populate_conversation_map_data(data){
    setMapOnAll(null);
    markers = [];
    for (var i = 0; i < data.length; i++) {
        service_provider_conversation_marker = new google.maps.Marker({
            position: new google.maps.LatLng(data[i]['user_lat'], data[i]['user_lng']),
            icon: {
                //url: './images/dot.svg',
                url: app_url + '/images/map/service_seeker_job_icon.svg',
                scaledSize: new google.maps.Size(30, 30),
            },
        });
        markers.push(service_provider_conversation_marker);
        setMapOnAll(map);
        set_display_bounds();

    }


    
}

function set_display_bounds(){
    var bounds = new google.maps.LatLngBounds();
    for (i = 0; i < markers.length; i++) {
        position = new google.maps.LatLng(markers[i].getPosition().lat(), markers[i].getPosition().lat());

        // marker = new google.maps.Marker({
        //     position: position,
        //     map: map
        // });

        bounds.extend(position)
    }

    map.fitBounds(bounds);
    map.setCenter(current_job_marker.getPosition());
}


function reset_map_position(){
    map.setCenter(current_job_marker.position);
    map.setZoom(14);
}