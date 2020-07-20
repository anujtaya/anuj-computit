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
        markers[i];
        infowindow = new google.maps.InfoWindow({});
        markers[i].addListener('click', function() {
            populate_map_con_detail_modal_popup(this.custom_data);
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

function populate_conversation_map_data(data) {
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
            custom_data: data[i],
        });
        markers.push(service_provider_conversation_marker);
        setMapOnAll(map);
        set_display_bounds();

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


function set_closest_marker_display_bounds(service_provider_marker) {
    bounds = new google.maps.LatLngBounds();
    bounds.extend(current_job_marker.position);
    bounds.extend(service_provider_marker.position);
    map.fitBounds(bounds);
    zoomLevel = map.getZoom();
    map.setCenter(current_job_marker.position);
    zoomLevel = zoomLevel - 1;
    map.setZoom(zoomLevel);
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
    //map.panTo(markers[closest].position);
    map.setZoom(16)
    set_closest_marker_display_bounds(markers[closest]);
    //console.log(markers[closest]);
}





function populate_map_con_detail_modal_popup(a) {
    $.ajax({
        type: "POST",
        url: service_seeker_job_request_provider_info_url,
        data: {
            "_token": csrf_token,
            "user_id": a.service_provider_id,
            "job_id": a.job_id,
        },
        success: function(results) {
            if (results == false) {
                $('#map_sp_info_container').html('An error occured. Please try again after some time.');
            } else {
                //populate modal with information and display if data is valid
                $('#map_sp_info_container').html(results);
                $('#map_con_modal_popup').modal('show');
            }
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });

}

var placeSearch, autocomplete
var current_address_string = {
    street_number: '',
    street_name: '',
    state: '',
    postcode: '',
    city: '',
    suburb: '',
    lng: '',
    lat: ''
}
//new location update functions
function initAutocomplete() {

    autocomplete = new google.maps.places.Autocomplete(document.getElementById('location_input'), {
        types: ['geocode'],
        componentRestrictions: { country: 'au' }
    });
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        // Get the place details from the autocomplete object.
        place = autocomplete.getPlace();
        console.log(place);
        prepare_user_address_object(place['address_components'],place.geometry.location.lat(),place.geometry.location.lng());
    });
}

//prepare user current address string for job booking object
function prepare_user_address_object(address_object, new_lat, new_lng) {
    //make default values null
    current_address_string = {
        street_number: '',
        street_name: '',
        state: '',
        postcode: '',
        city: '',
        suburb: '',
        lng: '',
        lat: ''
    }
    for (var i = 0; i < address_object.length; i++) {
        var address_type = address_object[i].types[0];

        var val = address_object[i]['long_name']
        if (address_type == "street_number") {
            current_address_string.street_number = val;
        } else if (address_type == "route") {
            current_address_string.street_name = val;
        } else if (address_type == "administrative_area_level_2") {
            current_address_string.city = val;
        } else if (address_type == "administrative_area_level_1") {
            current_address_string.state = val;
        } else if (address_type == "postal_code") {
            current_address_string.postcode = val;
        } else if (address_type == "postal_code") {
            current_address_string.postcode = val;
        } else if (address_type == "locality") {
            current_address_string.suburb = val;
        }
        current_address_string.lat = new_lat;
        current_address_string.lng = new_lng;

        document.getElementById('json_location_object').value = JSON.stringify(current_address_string);
    }
}