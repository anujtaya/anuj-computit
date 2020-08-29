var markers = [];
var map, infowindow, pos, current_user_marker, geocoder;
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

        current_user_marker = new google.maps.Marker({
            map: map,
            zIndex: 1,
            //icon: icons,
            icon: {
                url: '/images/map/marker.svg',
                scaledSize: new google.maps.Size(40, 40), // scaled size
            },
            draggable: true,
        });

    current_user_marker.addListener('click', function() {
        map.panTo(current_user_marker.position);
        //map.setZoom(18);
    });

    //set new current location on marker drag
    google.maps.event.addListener(current_user_marker, 'dragend', function(evt) {
        geocodePosition(current_user_marker.getPosition());
    });

    if (current_lat != null) {
        map.setCenter(new google.maps.LatLng(current_lat, current_lng));
        current_user_marker.setPosition(new google.maps.LatLng(current_lat, current_lng));
    }
}


//user location update functions 
function update_user_location() {
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
            full_address = responses[0].formatted_address;
            update_user_final_location(pos.lat, pos.lng, suburb, state, full_address);
        }
    });

}


function update_location_without_navigator(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            console.log('NAVIGATOR: Permission Denied')
            break;
        case error.POSITION_UNAVAILABLE:
            console.log('NAVIGATOR: Position Unavailable')
            break;
        case error.TIMEOUT:
            console.log('NAVIGATOR: Timeout')

            break;
        case error.UNKNOWN_ERROR:
            console.log('NAVIGATOR: Unkown Error')
            break;
    }
    handle_automatc_loc_update_failure();
}


function handle_automatc_loc_update_failure() {
    $('#user_location_modal_manual_popup').modal('show');
}


function update_user_final_location(lat, lng, suburb, state, full_address) {

    $("#user_current_saved_location").html(full_address);
    current_lat = lat;
    current_lng = lng;
    map.panTo(new google.maps.LatLng(current_lat, current_lng));
    current_user_marker.setPosition(new google.maps.LatLng(current_lat, current_lng));
    //populate_random_job_markers();
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
    full_address = place.formatted_address;
    console.log(place);
    map.setZoom(16);
    //console.log(full_address);
    if (place.address_components.length < 4) {
        for (var i = 0; i < place.address_components.length; i++) {
            suburb = place.address_components[0]['long_name'];
            state = place.address_components[1]['short_name'];
        }
        update_user_final_location(place_lat, place_lng, suburb, state, full_address);
        $('#user_location_modal_manual_popup').modal('hide');
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
        update_user_final_location(place_lat, place_lng, suburb, state, full_address);
        $('#user_location_modal_manual_popup').modal('hide');
    }
}
//end in it autocomplete code


//reverse geocoding
//Pan the map based on user location and notify user of new location details
function geocodePosition(pos) {
    //console.log(pos);
    if (enable_geocoder) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                place_lat = responses[0].geometry.location.lat();
                place_lng = responses[0].geometry.location.lng();
                map.setCenter(responses[0].geometry.location);
                full_address = responses[0].formatted_address;
                if (responses[0].address_components.length < 4) {
                    for (var i = 0; i < responses[0].address_components.length; i++) {
                        suburb = responses[0].address_components[0]['long_name'];
                        state = responses[0].address_components[1]['short_name'];
                    }
                    update_user_final_location(place_lat, place_lng, suburb, state, full_address);
                }
                if (responses[0].address_components.length > 4) {
                    for (var i = 0; i < responses[0].address_components.length; i++) {
                        var addressType = responses[0].address_components[i].types[0];
                        if (addressType == "locality") {
                            suburb = responses[0].address_components[i]['long_name'];
                        }
                        if (addressType == "administrative_area_level_1") {
                            state = responses[0].address_components[i]['short_name'];
                        }
                    }
                    update_user_final_location(place_lat, place_lng, suburb, state, full_address);
                }
            }
        });
    } else {
        update_user_final_location(pos.lat(), pos.lng(), "Test Suburb", "Test State", "Test Full Address, 1234");
    }
}


//display random markers on map with job cateogry names
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        infowindow = new google.maps.InfoWindow({});
        markers[i].addListener('click', function() {
            //map.panTo(this.position);
            //map.setZoom(15);
            infowindow.setContent("<p class='p-3 text-primary'>This provider offer services in <b>" + this.custom_data + "</b></p>")
            infowindow.open(map, this);
            //populate_map_job_detail_modal_popup(this.customMarkerJobId);

        });


        markers[i].setMap(map);
    }
}

function populate_random_job_markers() {
    setMapOnAll(null);
    markers = [];
    for (var i = 0; i < 10; i++) {
        var coords = generate_random_coordinate();
        service_provider_conversation_marker = new google.maps.Marker({
            position: new google.maps.LatLng(coords.lat, coords.lng),
            icon: {
                //url: './images/dot.svg',
                url: app_url + '/images/map/service_seeker_job_icon.svg',
                scaledSize: new google.maps.Size(30, 30),
            },
            custom_data: service_categories[Math.floor(Math.random() * (10 - 1) + 1)],
        });
        markers.push(service_provider_conversation_marker);
        setMapOnAll(map);
    }
}


function generate_random_coordinate() {
    var r = 5000 / 111300 // = 100 meters
        ,
        y0 = current_user_marker.getPosition().lat(),
        x0 = current_user_marker.getPosition().lng(),
        u = Math.random(),
        v = Math.random(),
        w = r * Math.sqrt(u),
        t = 2 * Math.PI * v,
        x = w * Math.cos(t),
        y1 = w * Math.sin(t),
        x1 = x / Math.cos(y0)
    var coords = {
        lat: y0 + y1,
        lng: x0 + x1
    };
    //console.log(coords);

    return coords;
}