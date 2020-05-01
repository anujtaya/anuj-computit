var markers = [];
var map, infowindow, pos, current_job_marker;
var radius = 50;
var bounds, zoomLevel;


function initMap() {
    //service provider current location
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById('map'), {

            zoom: 12,
            clickableIcons: false,
            // disableDefaultUI: true,
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

        current_job_marker = new google.maps.Marker({
            map: map,
            zIndex: 1,
            //icon: icons,
            icon: {
                url: '/images/map/marker.svg',
                scaledSize: new google.maps.Size(40, 40), // scaled size
            },
        });

    current_job_marker.addListener('click', function() {
        map.panTo(current_job_marker.position);
        map.setZoom(15);
    });


    if (current_job_lat != null) {
        map.setCenter(new google.maps.LatLng(current_job_lat, current_job_lng));
        current_job_marker.setPosition(new google.maps.LatLng(current_job_lat, current_job_lng));
    }
}



function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        infowindow = new google.maps.InfoWindow({});
        markers[i].addListener('click', function() {
            map.panTo(this.position);
            //map.setZoom(15);
            show_service_provider_info_modal(this.marker_service_provider_id);
        });
        markers[i].setMap(map);
    }
}



function populate_markers(data) {
    setMapOnAll(null);
    markers = [];
    for (var i = 0; i < data.length; i++) {
        var service_provider_conversation_marker = new google.maps.Marker({
            position: new google.maps.LatLng(data[i]['user_lat'], data[i]['user_lng']),
            icon: {
                url: app_url + '/images/map/service_seeker_job_icon.svg',
                scaledSize: new google.maps.Size(30, 30),
            },
            marker_service_provider_id: data[i]['user_id'],
            marker_service_provider_distance: data[i]['distance'],
        });
        markers.push(service_provider_conversation_marker);
        setMapOnAll(map);
    }
}

function fetch_service_providers() {
    $.ajax({
        type: "POST",
        url: guest_service_seeker_draft_job_proider_list_url,
        data: {
            "_token": csrf_token,
        },
        success: function(results) {
            $("#map_msg").html(results.length + ' Service Provider found nearby your job location.');
            if (results.length != 0) {
                console.log(results);
                populate_markers(results);
            }
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
}

function reset_map_position() {
    map.panTo(new google.maps.LatLng(current_job_lat, current_job_lng));
    map.setZoom(12);
}

function show_service_provider_info_modal(user_id) {
    console.log('Showig information for user with id: ' + user_id);
}