/* Code wirttend and developed by Anuj Taya
   Date file created: 12/12/2018
   Code written for Computit Pty Ltd
   Email: tayaanuj@gmail.com
*/
var image_array = [{
        state: 'QLD',
        url: 'https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/stock_images/brisbane.jpg'
    },
    {
        state: 'NSW',
        url: 'https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/stock_images/sydney.JPG'
    },
    {
        state: 'TAS',
        url: 'https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/stock_images/hobart.JPG'
    },

    {
        state: 'WA',
        url: 'https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/stock_images/perth.JPG'
    },
    {
        state: 'SA',
        url: 'https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/stock_images/adelaide.JPG'
    },
    {
        state: 'NT',
        url: 'https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/stock_images/darwin.JPG'
    },
    {
        state: 'VIC',
        url: 'https://s3-ap-southeast-2.amazonaws.com/l2l-resources/public/stock_images/melbourne.jpg'
    }
];

function find_image(a) {

    var r = search(a, image_array);
    if (typeof r === 'undefined') {
        //console.log('Must Display the standard image');
    } else {
        //console.log(r['url']);
        display_image(r['url']);
    }

}

function display_image(url) {
    var targetDiv = document.querySelector('#image_display');
    //var url = targetDiv.parentNode.href;
    targetDiv.style.backgroundImage = 'url(' + url + ')';

    $("#image_display").attr("src", url);
}

function search(nameKey, myArray) {
    for (var i = 0; i < myArray.length; i++) {
        if (myArray[i].state === nameKey) {
            return myArray[i];
        }
    }
}
var geocoder;

function initMap() {
    geocoder = new google.maps.Geocoder();
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        console.log('Geolocation is not supported in the web-browser!');
    }
}

function showPosition(position) {
    pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
    };
    geocodePosition(pos);
}

function showError(error) {
    switch (error.code) {
        case error.PERMISSION_DENIED:
            console.log(true, 'Location services are disabled');

            break;
        case error.POSITION_UNAVAILABLE:
            console.log(true, 'Location information is unavailable.');

            break;
        case error.TIMEOUT:
            console.log(true, 'The request to get user location timed out.');

            break;
        case error.UNKNOWN_ERROR:
            console.log(true, 'An unknown error occurred.');

            break;
    }
}

function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {
            //console.log(responses[0].address_components[4]);
            find_image(responses[0].address_components[4].short_name);
        } else {
            console.log('Geocoder failed to gecode the location!');
        }
    });
}