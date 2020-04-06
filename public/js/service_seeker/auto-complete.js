function initAutocomplete() {

    var autocomplete = new google.maps.places.Autocomplete(document.getElementById('service_location_full_address'), {
        types: ['geocode'],
        componentRestrictions: {country: 'au'}
    });
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        place = autocomplete.getPlace();
        current_address_string = place['address_components'];
        current_job_lat = place.geometry.location.lat();
        current_job_lng = place.geometry.location.lng();

    });
}

//user presee reset btn event
function resetPosition() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
                pos = {
                    lat: position.coords.latitude, //get current lattitude from device.
                    lng: position.coords.longitude //get current longitude from device.
                };
                geocodePosition(pos);
            },
            function() {});
    } else {
        display_snakbar_alert('Unable to update location! Please try entering location manually.');

    }
}
function geocodePosition(pos) {
   var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {
            // update_current_location(responses[0].geometry.location);
            $("#service_location_full_address").val(responses[0].formatted_address);
            current_job_lat = pos.lat;
            current_job_lng = pos.lng;
            // current_suburb = responses[0]['address_components'][2]['long_name'];
            // $("#suburb").html(current_suburb)
        }
    });
   current_job_lat = -27.491633099999998;
   current_job_lng = 153.00209949999999;
}
