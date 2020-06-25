var markers = [];
var map, infoWindow, pos, current_job_marker, service_provider_marker;
var radius = 50;
var distance_matrix_service;

function initMap() {
    // Try HTML5 geolocation.
    var icons = {
        url: '/images/map/l2l_ss_job_map_icon_round.svg',
        scaledSize: new google.maps.Size(30, 30), // scaled size
        // origin: new google.maps.Point(0,0), // origin
        // anchor: new google.maps.Point(0, 0) // anchor
    };
    var service_provider_icon = {
        url: '/images/map/l2l_sp_job_map_icon_car.svg',
        scaledSize: new google.maps.Size(30, 30), // scaled size
        // origin: new google.maps.Point(0,0), // origin
        // anchor: new google.maps.Point(0, 0) // anchor
    };
    map = new google.maps.Map(document.getElementById('map'), {
            zoom: 14,
            clickableIcons: false,
            gestureHandling: 'greedy',
            disableDefaultUI: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
            },
            styles: [{
                    "featureType": "all",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "weight": "2.00"
                    }]
                },
                {
                    "featureType": "all",
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "color": "#9c9c9c"
                    }]
                },
                {
                    "featureType": "all",
                    "elementType": "labels.text",
                    "stylers": [{
                        "visibility": "on"
                    }]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [{
                        "color": "#f2f2f2"
                    }]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ffffff"
                    }]
                },
                {
                    "featureType": "landscape.man_made",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#ffffff"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [{
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
                    "stylers": [{
                        "color": "#eeeeee"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#7b7b7b"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#ffffff"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "simplified"
                    }]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [{
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
                    "stylers": [{
                        "color": "#b5dae1"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#070707"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#ffffff"
                    }]
                }
            ],
        }),

        //current job marker
        current_job_marker = new google.maps.Marker({
            position: new google.maps.LatLng(job_lat, job_lng), //service seeker job co-ordinates
            map: map,
            zIndex: 1,
            icon: icons,
        });

    current_job_marker.addListener('click', function() {
        map.panTo(current_job_marker.position);
        map.setZoom(16);
    });

    //service provider infowindow
    var service_provider_marker_info_window = new google.maps.InfoWindow({
        content: '<p id="map_info_window" >Service Provider <br> Location</p>'
    });

    //service provider marker
    service_provider_marker = new google.maps.Marker({
        position: new google.maps.LatLng(service_provider_lat, service_provider_lng), //service seeker job co-ordinates
        map: map,
        icon: service_provider_icon,
        title: 'Service Provider Location',
        zIndex: 100,
    });

    //service provider marker event listener
    service_provider_marker.addListener('click', function() {
        map.panTo(service_provider_marker.position);
        map.setZoom(16);
        service_provider_marker_info_window.open(map, service_provider_marker);
    });

    map.setCenter(new google.maps.LatLng(job_lat, job_lng));

    distance_matrix_service = new google.maps.DistanceMatrixService();
}

//set nice zooom
var bounds, zoomLevel;

function set_display_bounds() {
    bounds = new google.maps.LatLngBounds();
    bounds.extend(current_job_marker.position);
    bounds.extend(service_provider_marker.position);
    map.fitBounds(bounds);
    zoomLevel = map.getZoom();
    //console.log(zoomLevel);
    map.setCenter(current_job_marker.position);
    zoomLevel = zoomLevel - 1;
    map.setZoom(zoomLevel);
    //console.log('Map zoom updated to: ' + zoomLevel);
}

//updates service provider coordinates on the map
function update_service_provider_location(data) {
    service_provider_marker.setPosition(new google.maps.LatLng(data.lat, data.lng));
    set_display_bounds();
    if (enable_eta) {
        find_eta();
    } else {
        document.getElementById("service_provider_eta").innerHTML = '<span class="text-danger">ETA: NA</span>';
    }
}


var distance_matrix_service_limit = 4;
var date = new Date();
date.setDate(date.getDate() + 1);
var DrivingOptions = {
    departureTime: date,
    trafficModel: 'pessimistic'
};

//calculates the estimated time of arrival
function find_eta() {
    if (distance_matrix_service_limit > 0 && enable_eta) {
        distance_matrix_service_limit = distance_matrix_service_limit - 1;
        console.log('Current distance matrix service limit updated to ' + distance_matrix_service_limit);
        distance_matrix_service.getDistanceMatrix({
            origins: [current_job_marker.position],
            destinations: [service_provider_marker.position],
            travelMode: 'DRIVING',
            avoidTolls: true,
            durationInTraffic: true,
            drivingOptions: DrivingOptions,

        }, callback);

        function callback(response, status) {

            if (status == 'OK') {
                var origins = response.originAddresses;
                var destinations = response.destinationAddresses;

                for (var i = 0; i < origins.length; i++) {
                    var results = response.rows[i].elements;
                    for (var j = 0; j < results.length; j++) {
                        var element = results[j];
                        var numeric_distance = element.duration_in_traffic.value / 60;
                        var distance = element.distance.text;
                        var duration = element.duration_in_traffic.text;
                        //console.log(element.duration_in_traffic.value);
                        if (numeric_distance < 1) {
                            document.getElementById("service_provider_eta").innerHTML = '<span class="text-success">Arrived</span>';
                            send_proximity_alert_to_seeker();
                            distance_matrix_service_limit = 0;
                        } else {
                            document.getElementById("service_provider_eta").innerHTML = 'ETA: ' + distance + " " + duration;
                        }
                    }
                }
            }
        }
    } else {
        console.log('Current distance matrix service limit reached.');
    }
}


//function reset map data
function reset_map_data() {
    console.log('Map data reset completed.');
}

function send_proximity_alert_to_seeker() {
    //delivers push notification to service seeker if the provider is close to the job location.
    console.log('Proximity push notification triggered!');
}