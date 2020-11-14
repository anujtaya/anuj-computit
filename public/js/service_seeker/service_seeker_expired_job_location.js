var map, current_user_marker, geocoder, placeSearch, autocomplete;
var current_address_string = {
    street_number: '',
    street_name: '',
    state: '',
    postcode: '',
    city: '',
    suburb: ''
}

function initMap() {
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
        map.setZoom(18);
    });

    //set new current location on marker drag
    google.maps.event.addListener(current_user_marker, 'dragend', function(evt) {
        geocodePosition(current_user_marker.getPosition());
    });

    geocoder = new google.maps.Geocoder();
    geocodePosition(new google.maps.LatLng(job_lat, job_lng));
}

function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(document.getElementById('street_number'), {
        types: ['geocode'],
        componentRestrictions: { country: 'au' }
    });
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        // Get the place details from the autocomplete object.
        place = autocomplete.getPlace();
        prepare_user_address_object(place['address_components']);
        current_job_lat = place.geometry.location.lat();
        current_job_lng = place.geometry.location.lng();
        update_map_position(place.geometry.location);
    });
}

function submit_updated_location() {
    if (current_job_lat != '') {
        if (current_job_lat.toString() != job_lat) {
            console.log('Location update sending to server.')
            var job_obj = {
                job_id: current_job_id,
                current_address_string: current_address_string,
                job_lat: current_job_lat,
                job_lng: current_job_lng,
            }
            $.ajax({
                type: "POST",
                url: job_location_update_url,
                data: {
                    "_token": csrf_token,
                    "job_obj": JSON.stringify(job_obj),
                },
                success: function(results) {
                    console.log(results);
                },
                error: function(results, status, err) {
                    console.log(err);
                }
            });
        }
    }
    console.log('Location not changed.')
}

function update_map_position(location) {
    map.panTo(location);
    current_user_marker.setPosition(location);
    map.setZoom(18);
    submit_updated_location();
}

function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {
            prepare_user_address_object(responses[0].address_components);
            current_job_lat = responses[0].geometry.location.lat();
            current_job_lng = responses[0].geometry.location.lng();
            update_map_position(responses[0].geometry.location);
            document.getElementById('street_number').value = responses[0].formatted_address;
        }
    });
}

//prepare user current address string for job booking object
function prepare_user_address_object(address_object) {
    //make default values null
    current_address_string = {
        street_number: '',
        street_name: '',
        state: '',
        postcode: '',
        city: '',
        suburb: ''
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
    }
}