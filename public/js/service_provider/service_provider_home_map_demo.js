var markers = [];
var map, infoWindow, pos, serviceMarker, current_sp_marker, user1, tempuserlat, tempuserlng,
    servicelatlng, userlatlng, source, destination, cityCircle;
var radius = 50;
var bounds, zoomLevel;

function initMap() {
    //service provider current location
    map = new google.maps.Map(document.getElementById('map'), {

            zoom: 15,
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

        current_sp_marker = new google.maps.Marker({
            map: map,
            zIndex: 1,
            //icon: icons,
            icon: {
                url: '/images/map/service_provider_job_icon_black.svg',
                scaledSize: new google.maps.Size(30, 30),
            }
            // draggable: true,
        });

    current_sp_marker.addListener('click', function() {
        map.panTo(current_sp_marker.position);
        map.setZoom(15);
    });

    if (current_lat != null) {
        map.setCenter(new google.maps.LatLng(current_lat, current_lng));
        current_sp_marker.setPosition(new google.maps.LatLng(current_lat, current_lng));
    }


}

function display_job_markers() {
    markers = [];
    setMapOnAll(null);
    for (var i = 0; i < jobs.length; i++) {
        var serviceMarker = new google.maps.Marker({
            position: new google.maps.LatLng(jobs[i]['job_lat'], jobs[i]['job_lng']),
            icon: {
                url: '/images/map/service_seeker_job_icon.svg',
                scaledSize: new google.maps.Size(30, 30),

            },
            // icon: {
            //     //url: './images/dot.svg',
            //     url: app_url + '/images/map/service_seeker_job_icon.svg',
            //     scaledSize: new google.maps.Size(30, 30),
            // },
            customMarkerJobId: jobs[i]['id']
        });
        markers.push(serviceMarker);

    }
    // var markerCluster = new MarkerClusterer(map, markers, {
    //     imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
    // });
    setMapOnAll(map);
    find_closest_marker();
}


function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i];
        infowindow = new google.maps.InfoWindow({});
        markers[i].addListener('click', function() {
            map.panTo(this.position);
            map.setZoom(15);

            populate_map_job_detail_modal_popup(this.customMarkerJobId);

        });
        markers[i].setMap(map);
    }
    //adjust the map view to include all marker and center the marker based on Service Provider location.
}

function resetLocation() {
    map.setCenter(current_sp_marker.position);
    map.panTo(current_sp_marker.position);
    map.setZoom(15);
}

//populates the text values in map job detail modal
function populate_map_job_detail_modal_popup(a) {
    console.log(a);
    var temp_object = null;
    for (var i = 0; i < jobs.length; i++) {
        if (jobs[i]['id'] === a) {
            temp_object = jobs[i];
        }
    }
    if (temp_object != null) {
        console.log(temp_object);
        $('#map_job_detail_modal_title').html(temp_object['title']);
        $('#map_job_detail_modal_description').html(temp_object['description']);
        $('#map_job_detail_modal_category').html(temp_object['description']);
        var temp_date = utcToLocalTime(temp_object['job_date_time']);
        $('#map_job_detail_modal_datetime').html(temp_date);
        $('#map_job_detail_modal_location').html(temp_object['suburb'] + ' ' + temp_object['city'] + ', ' + temp_object['postcode']);
        $('#map_job_detail_modal_title').html(temp_object['title']);
        $('#map_job_detail_modal_link').attr("href", app_url + "/guest/service_provider/jobs/job/" + temp_object['id']);
        $('#map_job_detail_modal_popup').modal('show');
    } else {
        console.log('No Job found');
        $('#map_job_detail_modal_popup').modal('hide');
    }

}

function utcToLocalTime(utcTimeString) {
    var theTime = moment.utc(utcTimeString).toDate(); // moment date object in local time
    var localTime = moment(theTime).format('DD/MM//YYYY hh:mm a'); //format the moment time object to string

    return localTime;
}

function reset_map_position() {
    map.setCenter(current_sp_marker.position);
    map.setZoom(14);
}


//user location update functions 
function update_sp_location() {
    //check if the location can be updated using navigator
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(update_location_using_navigator, update_location_without_navigator);
    } else {
        handle_automatc_loc_update_failure();
    }
}

function update_location_using_navigator(position) {
    pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };


    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {
            suburb = responses[0]['address_components'][1]['long_name'];
            state = responses[0]['address_components'][3]['short_name'];
            update_user_final_location(pos.lat, pos.lng, suburb, state);
        }
    });
}

function update_location_without_navigator(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            $("#user_current_saved_location").html('<span class="text-danger">Location Permission Denied</span>');
            console.log('NAVIGATOR: Permission Denied')
            break;
        case error.POSITION_UNAVAILABLE:
            $("#user_current_saved_location").html('<span class="text-danger">Location Position Unavailable</span>');
            break;
        case error.TIMEOUT:
            $("#user_current_saved_location").html('<span class="text-danger">Location Timeout</span>');
            break;
        case error.UNKNOWN_ERROR:
            $("#user_current_saved_location").html('<span class="text-danger">Location Unkown Error</span>');
            break;
    }
    handle_automatc_loc_update_failure();
}

function handle_automatc_loc_update_failure() {
    $('#user_location_modal_manual_popup').modal('show');
}

function update_user_final_location(lat, lng, suburb, state) {
    $("#user_current_saved_location").html('<i class="fas fa-map-marker-alt"></i> <span class="theme-color">' + suburb + ',' + state + "</span>");
    current_lat = lat;
    current_lng = lng;
    map.setCenter(new google.maps.LatLng(current_lat, current_lng));
    current_sp_marker.setPosition(new google.maps.LatLng(current_lat, current_lng));
    filter_service_provider_jobs(null, true);
    $('#user_location_modal_manual_popup').modal('hide');
}

//intit autocomplete for manual location update
var placeSearch, autocomplete;

var options = {
    types: ['geocode'],
    componentRestrictions: { country: 'au' }
};

function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
        /** @type  {!HTMLInputElement} */
        (document.getElementById('user_location_modal_manual_popup_input')),
        options);
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
    var place = autocomplete.getPlace();
    console.log(place);
    place_lat = place.geometry.location.lat();
    place_lng = place.geometry.location.lng();

    if (place.address_components.length < 4) {
        for (var i = 0; i < place.address_components.length; i++) {
            suburb = place.address_components[0]['long_name'];
            state = place.address_components[1]['short_name'];
        }
        update_user_final_location(place_lat, place_lng, suburb, state);
    }
    if (place.address_components.length > 4) {
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (addressType == "locality") {
                suburb = place.address_components[i]['long_name'];
            }
            if (addressType == "administrative_area_level_1") {
                state = place.address_components[i]['short_name'];
            }
        }
        update_user_final_location(place_lat, place_lng, suburb, state);
    }
}
//end in it autocomplete code


function find_closest_marker() {
    lat1 = current_sp_marker.getPosition().lat();
    lon1 = current_sp_marker.getPosition().lng();
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
    if (markers[closest] != null) {
        //set the nice zoom between current sp provider marker and closest marker to service provider location.
        bounds = new google.maps.LatLngBounds();
        bounds.extend(current_sp_marker.position);
        bounds.extend(markers[closest].position);
        map.fitBounds(bounds);
        zoomLevel = map.getZoom();
        map.setCenter(current_sp_marker.position);
        zoomLevel = zoomLevel - 1;
        map.setZoom(zoomLevel);
    }
}

function set_display_bounds() {
    bounds = new google.maps.LatLngBounds();
    bounds.extend(current_sp_marker.position);
    for (i = 0; i < markers.length; i++) {
        bounds.extend(markers[i].position)
    }
    map.fitBounds(bounds);
    zoomLevel = map.getZoom();
    map.setCenter(current_sp_marker.position);
    zoomLevel = zoomLevel - 1;
    map.setZoom(zoomLevel);
    console.log('Map zoom updated to: ' + zoomLevel);
}