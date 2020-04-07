var markers = [];
var map, infoWindow, pos, serviceMarker, currentUserMarker, user1, tempuserlat, tempuserlng,
    servicelatlng, userlatlng, source, destination, cityCircle;
var radius = 50;

function initMap() {
    // Try HTML5 geolocation.
    var icons = {
        url: '/images/map/pulse_marker.svg',
        scaledSize: new google.maps.Size(60, 60),
    };
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

        currentUserMarker = new google.maps.Marker({
            map: map,
            zIndex: 1,
            //icon: icons,
            icon:{
                url: '/images/map/service_provider_job_icon_black.svg',
                scaledSize: new google.maps.Size(40, 40),
            }
            // draggable: true,
        });

    currentUserMarker.addListener('click', function() {
        map.panTo(currentUserMarker.position);
        map.setZoom(15);
    });

    if(current_lat != null) {
        map.setCenter(new google.maps.LatLng(current_lat,current_lng));
        currentUserMarker.setPosition(new google.maps.LatLng(current_lat,current_lng));
    }

    
}







function display_job_markers() {
    setMapOnAll(null);
    for (var i = 0; i < jobs.length; i++) {
        var serviceMarker = new google.maps.Marker({
            position: new google.maps.LatLng(jobs[i]['job_lat'], jobs[i]['job_lng']),
            icon: {
                url: '/images/map/service_provider_job_icon.svg',
                scaledSize: new google.maps.Size(40, 40),

            },
            customMarkerJobId: jobs[i]['id']
        });
        markers.push(serviceMarker);

    }
    var markerCluster = new MarkerClusterer(map, markers, {
        imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'
    });

    setMapOnAll(map);
}



function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i];
        infowindow = new google.maps.InfoWindow({});
        markers[i].addListener('click', function() {
            map.panTo(this.position);
            map.setZoom(15);
         
            populate_map_job_detail_model_popup(this.customMarkerJobId);
            
        });
        markers[i].setMap(map);
    }
}

function resetLocation() {
    map.setCenter(currentUserMarker.position);
    map.panTo(currentUserMarker.position);
    map.setZoom(15);
}

function find_nearby(pos) {
    viewAll(pos.lat(), pos.lng(), radius);
}



function viewAll(lat, lng, radius) {
    setMapOnAll(null);
    markers = [];
    $.ajax({

        type: "POST",
        url: "./api/heatmap_fetch",
        data: {
            'lat': lat,
            'lng': lng,
            'radius': radius
        },
        success: function(results) {
            console.log('Map Resutls Refreshed.')
            setMapOnAll(null);
            markers = [];
            for (var i = 0; i < results.length; i++) {
                serviceMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(results[i]['lat'], results[i]['lng']),
                    icon: {
                        //url: './images/dot.svg',
                        url: '/images/map/service_provider_job_icon.svg',
                        scaledSize: new google.maps.Size(40, 40),
                    },
                });
                markers.push(serviceMarker);
                setMapOnAll(map);

            }
            console.log(results);
        },
        error: function(result, status, err) {
            markers = [];
        }
    });

}


//populates the text values in map job detail modal
function populate_map_job_detail_model_popup(a){
    console.log(a);
    var temp_object = null;
    for(var i=0;i < jobs.length;i++) {
        if(jobs[i]['id'] === a) {
            temp_object = jobs[i];
        }
    }
    if(temp_object != null) {
        console.log(temp_object);
        $('#map_job_detail_model_title').html(temp_object['title']);
        $('#map_job_detail_model_description').html(temp_object['description']);
        $('#map_job_detail_model_category').html(temp_object['description']);
        var temp_date = utcToLocalTime(temp_object['job_date_time']);
        $('#map_job_detail_model_datetime').html(temp_date);
        $('#map_job_detail_model_location').html('Toowong');
        $('#map_job_detail_model_title').html(temp_object['title']);

        $('#map_job_detail_model_popup').modal('show');
    } else {
        console.log('No Job found');
        $('#map_job_detail_model_popup').modal('hide');
    }
    
}

function utcToLocalTime(utcTimeString){
    var theTime  = moment.utc(utcTimeString).toDate(); // moment date object in local time
    var localTime = moment(theTime).format('YYYY-MM-DD HH:mm'); //format the moment time object to string

    return localTime;
}

function reset_map_position(){
    map.setCenter(currentUserMarker.position);
    map.setZoom(14);
}


//user location update functions 


function update_sp_location(){
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
            update_user_final_location(pos.lat,pos.lng,suburb, state);
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

function handle_automatc_loc_update_failure(){
    $('#user_location_modal_manual_popup').modal('show');
}

function update_user_final_location(lat,lng,suburb,state) {
    $.ajax({
        type: "POST",
        url: service_provider_location_update_url,
        data: {
          "_token": csrf_token,
          "lat": lat,
          'lng':lng,
          'suburb':suburb,
          'state': state
        },
        success: function(results){
          if(results) {
            $("#user_current_saved_location").html('Location set to: <span class="theme-color">' + suburb + ',' + state + "</span>");
            current_lat = lat;
            current_lng = lng;
            map.setCenter(new google.maps.LatLng(current_lat,current_lng));
            currentUserMarker.setPosition(new google.maps.LatLng(current_lat,current_lng));
          } else {
            console.log('Location update notification should not be sent.');
          }
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
    //console.log('Location final updated to ' + suburb + ',' + state);
}



//intit autocomplete for manual location update
function initAutocomplete() {
    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('user_location_modal_manual_popup_input'), {
        types: ['geocode'],
        componentRestrictions: {country: 'au'}
    });
    google.maps.event.addListener(autocomplete, 'place_changed', function() {  
        place = autocomplete.getPlace();
        console.log(place);
        place_lat = place.geometry.location.lat();
        place_lng = place.geometry.location.lng();

        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if(addressType == "locality"){
                suburb  = place.address_components[i]['long_name'];
            }else if(addressType == "administrative_area_level_1"){
                state =  place.address_components[i]['short_name'];
            }
        }
        update_user_final_location(place_lat,place_lng,suburb, state);
        $('#user_location_modal_manual_popup').modal('hide');
    });
}