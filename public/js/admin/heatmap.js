var markers = [];
var map, infoWindow, pos, serviceMarker, currentUserMarker, user1, tempuserlat, tempuserlng,
    servicelatlng, userlatlng, source, destination, cityCircle;
var radius = 50;

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
                        styles: [{
                                "featureType": "administrative",
                                "elementType": "geometry",
                                "stylers": [{
                                    "color": "#a7a7a7"
                                }]
                            },
                            {
                                "featureType": "administrative",
                                "elementType": "labels.text.fill",
                                "stylers": [{
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#737373"
                                    }
                                ]
                            },
                            {
                                "featureType": "landscape",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#efefef"
                                    }
                                ]
                            },
                            {
                                "featureType": "landscape.man_made",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "landscape.natural.landcover",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "landscape.natural.terrain",
                                "elementType": "all",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#dadada"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "labels",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "poi",
                                "elementType": "labels.icon",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "poi.attraction",
                                "elementType": "all",
                                "stylers": [{
                                        "visibility": "off"
                                    },
                                    {
                                        "color": "#e18aa5"
                                    }
                                ]
                            },
                            {
                                "featureType": "poi.attraction",
                                "elementType": "geometry",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "poi.attraction",
                                "elementType": "labels",
                                "stylers": [{
                                    "visibility": "on"
                                }]
                            },
                            {
                                "featureType": "poi.attraction",
                                "elementType": "labels.text",
                                "stylers": [{
                                    "color": "#897c7c"
                                }]
                            },
                            {
                                "featureType": "poi.attraction",
                                "elementType": "labels.text.fill",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "poi.attraction",
                                "elementType": "labels.text.stroke",
                                "stylers": [{
                                    "visibility": "on"
                                }]
                            },
                            {
                                "featureType": "road",
                                "elementType": "labels.text.fill",
                                "stylers": [{
                                    "color": "#696969"
                                }]
                            },
                            {
                                "featureType": "road",
                                "elementType": "labels.icon",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": "#ffffff"
                                }]
                            },
                            {
                                "featureType": "road.highway",
                                "elementType": "geometry.stroke",
                                "stylers": [{
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#b3b3b3"
                                    }
                                ]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": "#ffffff"
                                }]
                            },
                            {
                                "featureType": "road.arterial",
                                "elementType": "geometry.stroke",
                                "stylers": [{
                                    "color": "#d6d6d6"
                                }]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                        "visibility": "on"
                                    },
                                    {
                                        "color": "#ffffff"
                                    },
                                    {
                                        "weight": 1.8
                                    }
                                ]
                            },
                            {
                                "featureType": "road.local",
                                "elementType": "geometry.stroke",
                                "stylers": [{
                                    "color": "#d7d7d7"
                                }]
                            },
                            {
                                "featureType": "transit",
                                "elementType": "all",
                                "stylers": [{
                                        "color": "#808080"
                                    },
                                    {
                                        "visibility": "off"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "all",
                                "stylers": [{
                                        "saturation": "100"
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry",
                                "stylers": [{
                                        "visibility": "on"
                                    },
                                    {
                                        "saturation": "-63"
                                    },
                                    {
                                        "lightness": "53"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry.fill",
                                "stylers": [{
                                    "color": "#d3d3d3"
                                }]
                            },
                            {
                                "featureType": "water",
                                "elementType": "geometry.stroke",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels",
                                "stylers": [{
                                    "visibility": "off"
                                }]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels.text",
                                "stylers": [{
                                        "color": "#6a6a6a"
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels.text.fill",
                                "stylers": [{
                                        "visibility": "off"
                                    },
                                    {
                                        "color": "#7c7c7c"
                                    }
                                ]
                            },
                            {
                                "featureType": "water",
                                "elementType": "labels.icon",
                                "stylers": [{
                                        "saturation": "-75"
                                    },
                                    {
                                        "lightness": "61"
                                    },
                                    {
                                        "visibility": "on"
                                    }
                                ]
                            }
                        ]
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



                //set new current location on marker drag
                google.maps.event.addListener(currentUserMarker, 'dragend', function(evt) {
                    find_nearby(currentUserMarker.getPosition());
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



function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i];
        infowindow = new google.maps.InfoWindow({});
        markers[i].addListener('click', function() {
            map.panTo(this.position);
            map.setZoom(14);
        });
        markers[i].setMap(map);
    }
}

function resetLocation() {
    map.setCenter(currentUserMarker.position);
    map.panTo(currentUserMarker.position);
    map.setZoom(11);
}

function find_nearby(pos) {
    viewAll(pos.lat(), pos.lng(), radius);
}



function viewAll(lat, lng, radius) {
    setMapOnAll(null);
    markers = [];
    $.ajax({

        type: "POST",
        url: heatmap_fetch_api_url,
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
                    position: new google.maps.LatLng(results[i]['user_lat'], results[i]['user_lng']),
                    icon: { url: map_user_icon_dot_image, },
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