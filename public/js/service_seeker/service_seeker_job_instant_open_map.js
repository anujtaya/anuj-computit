var markers = [];
var map, infoWindow, pos, current_job_marker;
var radius = 50;

function initMap() {
    // Try HTML5 geolocation.
    var icons = {
        url: '/images/map/l2l_ss_job_map_icon.svg',
        scaledSize: new google.maps.Size(25, 25), // scaled size
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

        current_job_marker = new google.maps.Marker({
            position: new google.maps.LatLng(job_lat, job_lng), //client's co-ordinates
            map: map,
            zIndex: 1,
            icon: icons,
        });
    current_job_marker.addListener('click', function() {
        map.panTo(current_job_marker.position);
        map.setZoom(14);
    });
    map.setCenter(new google.maps.LatLng(job_lat, job_lng));
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

function resetLocation() {
    map.setCenter(current_job_marker.position);
    map.panTo(current_job_marker.position);
    map.setZoom(11);
}

function find_nearby(pos) {
    viewAll(pos.lat(), pos.lng(), radius);
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


var bounds, zoomLevel;

function set_display_bounds() {
    bounds = new google.maps.LatLngBounds();
    bounds.extend(current_job_marker.position);
    for (i = 0; i < markers.length; i++) {
        bounds.extend(markers[i].position)
    }
    map.fitBounds(bounds);
    zoomLevel = map.getZoom();
    console.log(zoomLevel);
    map.setCenter(current_job_marker.position);
    zoomLevel = zoomLevel - 1;
    map.setZoom(zoomLevel);
    console.log('Map zoom updated to: ' + zoomLevel);
}



function reset_map_position() {
    map.setCenter(current_job_marker.position);
    map.setZoom(14);
}


function find_closest_marker() {
    lat1 = current_job_marker.getPosition().lat();
    lon1 = current_job_marker.getPosition().lng();
    var pi = Math.PI;
    var R = 6371; //equatorial radius
    var distances = [];
    var closest = -1;
    for (i = 0; i < markers.length; i++) {
        var lat2 = markers[i].position.lat();
        var lon2 = markers[i].position.lng();
        var chLat = lat2 - lat1;
        var chLon = lon2 - lon1;
        var dLat = chLat * (pi / 180);
        var dLon = chLon * (pi / 180);
        var rLat1 = lat1 * (pi / 180);
        var rLat2 = lat2 * (pi / 180);
        var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.sin(dLon / 2) * Math.sin(dLon / 2) * Math.cos(rLat1) * Math.cos(rLat2);
        var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        var d = R * c;

        distances[i] = d;
        if (closest == -1 || d < distances[closest]) {
            closest = i;
        }
    }
    // (debug) The closest marker is:
    map.panTo(markers[closest].position);
    map.setZoom(17)
    console.log(markers[closest]);
}


function show_service_provider_info_modal(user_id) {
    $('#service_provider_info_container').html('Please wait while we do some maths.');
    $.ajax({
        type: "POST",
        url: service_seeker_job_instant_proider_info_url,
        data: {
            "_token": csrf_token,
            "user_id": user_id,
            "job_id": job_id
        },
        success: function(results) {
            if (results == false) {
                $('#service_provider_info_container').html('An error occured. Please try again after some time.');
            } else {
                //populate modal with information and display if data is valid
                $('#service_provider_info_container').html(results);
                $('#service_provider_account_information_modal').modal('show');
            }
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
}

var first_load = true;

function first_load_initialize() {
    if (first_load) {
        set_display_bounds();
        first_load = false;
    }
}

function fetch_service_providers() {
    $.ajax({
        type: "POST",
        url: service_seeker_job_instant_proider_list_url,
        data: {
            "_token": csrf_token,
            "job_id": job_id,
        },
        success: function(results) {
            $("#map_msg").html(results.length + ' Service Provider found nearby your job location.');
            populate_markers(results);
            first_load_initialize();

        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
}