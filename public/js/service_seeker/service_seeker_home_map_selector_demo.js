var markers = [];
var map, infowindow, pos, current_job_marker;
var radius = 50;
var bounds, zoomLevel;


function initMap() {
    //service provider current location
    geocoder = new google.maps.Geocoder();
    map = new google.maps.Map(document.getElementById('map'), {

            zoom: 14,
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
        fetch_marker_data(current_job_lat, current_job_lng);
    }
}







function reset_map_position() {
    map.panTo(new google.maps.LatLng(current_job_lat, current_job_lng));
    map.setZoom(14);
}


// function setMapOnAll(map) {
//     for (var i = 0; i < markers.length; i++) {
//         infowindow = new google.maps.InfoWindow({});
//         markers[i].addListener('click', function() {
//             map.panTo(this.position);
//             //map.setZoom(15);
//             show_service_provider_info_modal(this.marker_service_provider_id);
//         });
//         markers[i].setMap(map);
//     }
// }


// function fetch_service_providers() {
//     $.ajax({
//         type: "POST",
//         url: guest_service_seeker_draft_job_proider_list_url,
//         data: {
//             "_token": csrf_token,
//         },
//         success: function(results) {
//             $("#map_msg").html('There are ' + results.length + ' Service Providers near your current location.');
//             if (results.length != 0) {
//                 console.log(results);
//                 populate_markers(results);
//             }
//         },
//         error: function(results, status, err) {
//             console.log(err);
//         }
//     });
// }


// function populate_markers(data) {
//     setMapOnAll(null);
//     markers = [];
//     for (var i = 0; i < data.length; i++) {
//         var service_provider_conversation_marker = new google.maps.Marker({
//             position: new google.maps.LatLng(data[i]['user_lat'], data[i]['user_lng']),
//             icon: {
//                 url: app_url + '/images/map/service_seeker_job_icon.svg',
//                 scaledSize: new google.maps.Size(30, 30),
//             },
//             marker_service_provider_id: data[i]['user_id'],
//             marker_service_provider_distance: data[i]['distance'],
//         });
//         markers.push(service_provider_conversation_marker);
//         setMapOnAll(map);
//     }
// }


// function show_service_provider_info_modal(user_id) {
//     $('#service_provider_info_container').html('Please wait while we do some maths.');
//     $.ajax({
//         type: "POST",
//         url: guest_service_seeker_draft_job_proider_info_url,
//         data: {
//             "_token": csrf_token,
//             "user_id": user_id
//         },
//         success: function(results) {
//             console.log(results);
//             if (results == false) {
//                 $('#service_provider_info_container').html('An error occured. Please try again after some time.');
//             } else {
//                 //populate modal with information and display if data is valid
//                 $('#service_provider_info_container').html(results);
//                 $('#service_provider_account_information_modal').modal('show');
//             }
//         },
//         error: function(results, status, err) {
//             console.log(err);
//         }
//     });
// }



//display random markers on map with job cateogry names
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        infowindow = new google.maps.InfoWindow({});
        markers[i].addListener('click', function() {
            //map.panTo(this.position);
            //map.setZoom(15);
            //infowindow.setContent("<p class='p-3 text-primary'>This provider offer services in <b>" + this.custom_data + "</b></p>")
            if (this.profile_image_path == 'user_image/no_user_image.png') {
                infowindow.setContent("<div class='d-flex bd-highlight'>" +
                    "<div class='p-1 bd-highlight'>" +

                    "<span class='font-weight-bolder' style='font-size:1.3em;'>" + this.name + "</span>" +
                    "<br><span class='font-weight-bolders' style='font-size:1em;'>" + this.service_name + "</span>" +
                    "</div>" +
                    "</div>");
            } else {
                infowindow.setContent("<div class='d-flex bd-highlight'><div class='p-1 bd-highlight'><img class='rounded-circle shadow-lg' height='40px' width='40px' src=" + "https://s3-ap-southeast-2.amazonaws.com/l2l-resources/" + this.profile_image_path + "></div>" +
                    "<div class='p-1 bd-highlight'>" +

                    "<span class='font-weight-bolder' style='font-size:1.3em;'>" + this.name + "</span>" +
                    "<br><span class='font-weight-bolders' style='font-size:1em;'>" + this.service_name + "</span>" +
                    "</div>" +
                    "</div>");
            }

            infowindow.open(map, this);
            //populate_map_job_detail_modal_popup(this.customMarkerJobId);

        });


        markers[i].setMap(map);
    }
}



function fetch_marker_data(a, b) {
    //get marker data from server close to user current location
    $.ajax({
        type: "POST",
        url: app_url + '/guest/service_seeker/services/service_providers_nearby/fetch',
        data: {
            "_token": csrf_token,
            "user_current_lat": a,
            "user_current_lng": b,
        },
        success: function(results) {
            console.log(results);
            populate_job_markers(results);
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
}

function populate_job_markers(marker_data) {
    setMapOnAll(null);
    markers = [];
    for (var i = 0; i < marker_data.length; i++) {

        service_provider_conversation_marker = new google.maps.Marker({
            position: new google.maps.LatLng(marker_data[i].user_lat, marker_data[i].user_lng),
            icon: {
                //url: './images/dot.svg',
                url: app_url + '/images/map/service_provider_job_icon.svg',
                scaledSize: new google.maps.Size(30, 30),
            },
            service_name: service_categories[Math.floor(Math.random() * (10 - 1) + 1)],
            user_lat: marker_data[i].user_lat,
            name: capitalizeFirstLetter(marker_data[i].first) + ' ' + capitalizeFirstLetter(marker_data[i].last),
            profile_image_path: marker_data[i].profile_image_path,
        });
        markers.push(service_provider_conversation_marker);
        setMapOnAll(map);
    }
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}