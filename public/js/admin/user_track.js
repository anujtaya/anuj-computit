var markers = [];
var map, infoWindow, pos, serviceMarker, currentUserMarker, user1, tempuserlat, tempuserlng,
    servicelatlng, userlatlng, source, destination, cityCircle;
var radius = 50;
var current_user_id = null;
var refresh_interval;

function initMap() {
    // Try HTML5 geolocation.
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
                pos = {
                    lat: position.coords.latitude, //get current lattitude from device. 
                    lng: position.coords.longitude //get current longitude from device.

                };
                //service provider current location
                map = new google.maps.Map(document.getElementById('map'), {
                        center: {
                            //set the center to users' current location
                            lat: pos.lat,
                            lng: pos.lng
                        },
                        zoom: 12,
                        clickableIcons: false,
                        // disableDefaultUI: true,
                        gestureHandling: 'greedy',
                        mapTypeControlOptions: {
                            mapTypeIds: ['roadmap']
                        },

                    }),

                    currentUserMarker = new google.maps.Marker({
                        position: new google.maps.LatLng(pos.lat, pos.lng), //client's co-ordinates
                        map: map,
                        zIndex: 1,
                        draggable: true,
                    });


                currentUserMarker.addListener('click', function() {
                    map.panTo(currentUserMarker.position);
                    map.setZoom(14);
                });




            },
            function() {
                handleLocationError(true, infoWindow, map.getCenter());
            });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }
}





function set_user_location(data) {
    var position = new google.maps.LatLng(data['lat'], data['lng'])
    currentUserMarker.setPosition(position);
    output.innerHTML += " <li class='list-group-item'>User with id:" + current_user_id + " location updated to " + data['lat'] + "," + data['lng'] + "</li>";
    map.panTo(position);
}



function find_user_location() {
    current_user_id = document.getElementById('user_id').value;
    if (current_user_id == null || current_user_id == '') {
        output.innerHTML = "";
        alert('User id is empty.');

    } else {
        output.innerHTML = "";
        clearInterval(refresh_interval);
        fetch_user_location();
        refresh_interval = setInterval(fetch_user_location, 5000);
    }

}

function fetch_user_location() {
    if (current_user_id == null || current_user_id == '') {
        output.innerHTML = "";
    } else {


        $.ajax({

            type: "POST",
            url: heatmap_fetch_api_url,
            data: {
                'user_id': current_user_id,
            },
            success: function(results) {
                if (results != false) {
                    console.log(results);
                    set_user_location(results);
                } else {
                    console.log('No result found.');
                }



            },
            error: function(result, status, err) {
                console.log(err);
            }
        });
    }
}