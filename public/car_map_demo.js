var markers = [];
var map, infoWindow, pos, serviceMarker, currentUserMarker, user1, tempuserlat, tempuserlng,
    servicelatlng, userlatlng, source, destination, cityCircle;
var radius = 50;

function initMap() {
    // Try HTML5 geolocation.
    var  icons = {
        url: 'https://laravel.dev/images/map/marker.svg',
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
                    map: map,
                    zIndex: 1,
                    icon: icons,
                    // draggable: true,
                });


                currentUserMarker.addListener('click', function() {
                    map.panTo(currentUserMarker.position);
                    map.setZoom(17);
                });



                if (navigator.geolocation) {
                    navigator.geolocation.watchPosition(set_center, show_error);

                    
                } else {
                    reporter_alert(true, 'GPS signal not found!');
                }

               

            }
          
function set_center(position) {
    var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };
    map.setCenter(pos);
    currentUserMarker.setPosition(pos);
}

function show_error(error){
    console.log(error);
}






function animate_marker() {
    var start_address = $("#start_address").val();
    var end_address = $("#end_address").val();
    console.log(start_address);
    console.log(end_address);
}

