var markers = [];
var map, infoWindow, pos, serviceMarker, currentUserMarker, user1, tempuserlat, tempuserlng,
    servicelatlng, userlatlng, source, destination, cityCircle;
var radius = 50;

function initMap() {
    // Try HTML5 geolocation.
    var  icons = {
        url: '/images/map/marker.svg',
        scaledSize: new google.maps.Size(40, 40), // scaled size
    // origin: new google.maps.Point(0,0), // origin
    // anchor: new google.maps.Point(0, 0) // anchor
    };
                //service provider current location
                map = new google.maps.Map(document.getElementById('map'), {
                        
                        zoom: 12,
                        clickableIcons: false,
                        // disableDefaultUI: true,
                        gestureHandling: 'greedy',
                        disableDefaultUI: true,
                        mapTypeControlOptions: {
                            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
                          },
                        styles:[
                          {
                              "featureType": "all",
                              "elementType": "geometry.fill",
                              "stylers": [
                                  {
                                      "weight": "2.00"
                                  }
                              ]
                          },
                          {
                              "featureType": "all",
                              "elementType": "geometry.stroke",
                              "stylers": [
                                  {
                                      "color": "#9c9c9c"
                                  }
                              ]
                          },
                          {
                              "featureType": "all",
                              "elementType": "labels.text",
                              "stylers": [
                                  {
                                      "visibility": "on"
                                  }
                              ]
                          },
                          {
                              "featureType": "landscape",
                              "elementType": "all",
                              "stylers": [
                                  {
                                      "color": "#f2f2f2"
                                  }
                              ]
                          },
                          {
                              "featureType": "landscape",
                              "elementType": "geometry.fill",
                              "stylers": [
                                  {
                                      "color": "#ffffff"
                                  }
                              ]
                          },
                          {
                              "featureType": "landscape.man_made",
                              "elementType": "geometry.fill",
                              "stylers": [
                                  {
                                      "color": "#ffffff"
                                  }
                              ]
                          },
                          {
                              "featureType": "poi",
                              "elementType": "all",
                              "stylers": [
                                  {
                                      "visibility": "off"
                                  }
                              ]
                          },
                          {
                              "featureType": "road",
                              "elementType": "all",
                              "stylers": [
                                  {
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
                              "stylers": [
                                  {
                                      "color": "#eeeeee"
                                  }
                              ]
                          },
                          {
                              "featureType": "road",
                              "elementType": "labels.text.fill",
                              "stylers": [
                                  {
                                      "color": "#7b7b7b"
                                  }
                              ]
                          },
                          {
                              "featureType": "road",
                              "elementType": "labels.text.stroke",
                              "stylers": [
                                  {
                                      "color": "#ffffff"
                                  }
                              ]
                          },
                          {
                              "featureType": "road.highway",
                              "elementType": "all",
                              "stylers": [
                                  {
                                      "visibility": "simplified"
                                  }
                              ]
                          },
                          {
                              "featureType": "road.arterial",
                              "elementType": "labels.icon",
                              "stylers": [
                                  {
                                      "visibility": "off"
                                  }
                              ]
                          },
                          {
                              "featureType": "transit",
                              "elementType": "all",
                              "stylers": [
                                  {
                                      "visibility": "off"
                                  }
                              ]
                          },
                          {
                              "featureType": "water",
                              "elementType": "all",
                              "stylers": [
                                  {
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
                              "stylers": [
                                  {
                                      "color": "#b5dae1"
                                  }
                              ]
                          },
                          {
                              "featureType": "water",
                              "elementType": "labels.text.fill",
                              "stylers": [
                                  {
                                      "color": "#070707"
                                  }
                              ]
                          },
                          {
                              "featureType": "water",
                              "elementType": "labels.text.stroke",
                              "stylers": [
                                  {
                                      "color": "#ffffff"
                                  }
                              ]
                          }
                      ],
                    }),

                    currentUserMarker = new google.maps.Marker({
                        position: new google.maps.LatLng(-27.4698,153.0251), //client's co-ordinates
                        map: map,
                        zIndex: 1,
                        icon: icons,
                        // draggable: true,
                    });


                currentUserMarker.addListener('click', function() {
                    map.panTo(currentUserMarker.position);
                    map.setZoom(14);
                });



                //set new current location on marker drag
                // google.maps.event.addListener(currentUserMarker, 'dragend', function(evt) {
                //     find_nearby(currentUserMarker.getPosition());
                // });

                map.setCenter(new google.maps.LatLng(-27.4698,153.0251));

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
                    icon: { url: './images/dot.svg', },
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