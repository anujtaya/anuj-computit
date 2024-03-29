var map, map_pickup, map_dropoff, current_user_marker, current_user_marker_pickup, current_user_marker_dropoff, geocoder, placeSearch, autocomplete;
var current_service_id = null;
var current_service_node_id = null;
var current_job_draft_id = null;
var current_job_lat = null;
var current_job_lng = null;
var current_job_lat_pickup = null;
var current_job_lng_pickup = null;
var current_job_lat_dropoff = null;
var current_job_lng_dropoff = null;
//set the boolean to true if the service type is delivery
var is_delivery_service = false;
var current_address_string = {
	street_number: '',
	street_name: '',
	state: '',
	postcode: '',
	city: '',
	suburb: ''
}

var current_address_string_pickup = {
	street_number: '',
	street_name: '',
	state: '',
	postcode: '',
	city: '',
	suburb: ''
}

var current_address_string_dropoff = {
	street_number: '',
	street_name: '',
	state: '',
	postcode: '',
	city: '',
	suburb: ''
}

var map_style = [{
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
];

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
			styles: map_style,
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

	current_user_marker.addListener('click', function () {
		map.panTo(current_user_marker.position);
		map.setZoom(18);
	});

	//set new current location on marker drag
	google.maps.event.addListener(current_user_marker, 'dragend', function (evt) {
		geocodePosition(current_user_marker.getPosition());
	});

	geocoder = new google.maps.Geocoder();


	//map 2 for location pickup
	map_pickup = new google.maps.Map(document.getElementById('map_pickup'), {

			zoom: 12,
			clickableIcons: false,
			// disableDefaultUI: true,
			gestureHandling: 'greedy',
			disableDefaultUI: true,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
			},
			styles: map_style,
		}),

		current_user_marker_pickup = new google.maps.Marker({
			map: map_pickup,
			zIndex: 1,
			//icon: icons,
			// icon: {
			//     url: '/images/map/marker.svg',
			//     scaledSize: new google.maps.Size(40, 40), // scaled size
			// },
			draggable: true,
		});

	current_user_marker_pickup.addListener('click', function () {
		map_pickup.panTo(current_user_marker_pickup.position);
		map_pickup.setZoom(18);
	});

	//set new current location on marker drag
	google.maps.event.addListener(current_user_marker_pickup, 'dragend', function (evt) {
		geocodePositionPickup(current_user_marker_pickup.getPosition());
	});

	//map 3 for location pickup
	map_dropoff = new google.maps.Map(document.getElementById('map_dropoff'), {

			zoom: 12,
			clickableIcons: false,
			// disableDefaultUI: true,
			gestureHandling: 'greedy',
			disableDefaultUI: true,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
			},
			styles: map_style,
		}),

		current_user_marker_dropoff = new google.maps.Marker({
			map: map_dropoff,
			zIndex: 1,
			//icon: icons,
			// icon: {
			//     url: '/images/map/marker.svg',
			//     scaledSize: new google.maps.Size(40, 40), // scaled size
			// },
			draggable: true,
		});

	current_user_marker_dropoff.addListener('click', function () {
		map_dropoff.panTo(current_user_marker_dropoff.position);
		map_dropoff.setZoom(18);
	});

	//set new current location on marker drag
	google.maps.event.addListener(current_user_marker_dropoff, 'dragend', function (evt) {
		geocodePositionDropOff(current_user_marker_dropoff.getPosition());
	});
}


function map_display_control() {
	if ($("#map").is(":visible")) {
		$("#map:visible").fadeOut()
		user_map_settings(false); // UPDATE
	} else {
		$("#map:hidden").fadeIn()
		user_map_settings(true); // UPDATE
	}
}


function user_map_settings(map_status) {
	var user_preferences = {
		"map_status": map_status
	}
	$.ajax({
		type: "POST",
		url: app_url + '/service_seeker/preferences/update',
		data: {
			"_token": csrf_token,
			"user_preferences": JSON.stringify(user_preferences),
		},
		success: function (results) {
			console.log(results);
		},
		error: function (results, status, err) {
			console.log(err);
		}
	});
}


var draft_obj = {
	title: $("#service_job_title").val(),
	description: $("#service_job_description").val(),
	job_date_time: $("#service_job_datetime").val(),
	service_subcategory_id: current_service_node_id,
	job_lat: current_job_lat,
	job_lng: current_job_lng,
}


function user_service_selection(service_id) {
	//console.log("Current service id is: " + service_id.substr(4));
	if (service_id.substr(4) == 9) {
		$(".total_steps").text(5);
		is_delivery_service = true;
		console.log('User selected the delivery service type.');
	} else {
		$(".total_steps").text(4);
		console.log('User selected the non-delivery service type.');
	}

	var service_name = $("#" + service_id).data("catname");
	var user_service_id = service_id.substr(4);
	$("#service_selection_name_display").text(service_name);
	//sert current service id to user selected service id
	current_service_id = user_service_id;
	$("#view_box_1").hide();
	//retrieve service sub categories
	retrieve_sub_categories(current_service_id);
	//display service wizard
	$("#view_box_2").fadeIn();
}


function wizard_exit() {
	wizard_switch_2('wizard_view_1');
	$("#service_job_title").val("");
	$("#service_job_description").val("");
	$("#view_box_2").hide();
	$("#view_box_1").fadeIn();
	is_delivery_service = false;
	if (current_job_draft_id != null) {
		clear_job_draft_data(current_job_draft_id);
	}
}


function set_current_node_id(node_id) {


	toggle_animation(true);
	var temp_node_id = node_id.substr(4);
	$('#nid_' + current_service_node_id).removeClass('theme-background-color text-white');


	if (temp_node_id != null || node_id != '') {
		current_service_node_id = temp_node_id;
		console.log('Node id set to ' + current_service_node_id);
		//mark node active
		$('#' + node_id).addClass('theme-background-color text-white');
		wizard_switch('wizard_view_2');
	}
}


function wizard_switch(id) {
	// create_seeker_job_draft();
	if (id == 'wizard_view_2') {
		wizard_switch_2(id);
	}
	if (id == 'wizard_view_3') {
		wizard_switch_3(id);
	}
	if (id == 'wizard_view_1') {
		wizard_switch_1(id);
	}
	if (id == 'wizard_view_4') {

		if (is_delivery_service == true) {
			wizard_switch_5('wizard_view_5');
		} else {
			resetPosition();
			wizard_switch_4(id);
		}

	}
	if (id == 'wizard_view_5') {
		//resetPosition();
		wizard_switch_5(id);
	}
	if (id == 'wizard_view_6') {
		//resetPosition();
		wizard_switch_6(id);
	}
}


function wizard_switch_1(id) {
	$("#wizard_view_1").hide();
	$("#wizard_view_2").hide();
	$("#wizard_view_3").hide();
	$("#wizard_view_4").hide();
	$("#wizard_view_5").hide();
	$("#wizard_view_6").hide();
	$("#" + id).show();
	toggle_animation(false);
}


function wizard_switch_2(id) {


	if (current_service_node_id == null) {
		$("#wizard_view_1").show();
		console.log('No service node id found.');
		$("#wizard_service_node_list").addClass('animated shake');
		setTimeout(function () {
			$("#wizard_service_node_list").removeClass('animated shake');
		}, 1000);
	} else {
		$("#wizard_view_1").hide();
		$("#wizard_view_2").hide();
		$("#wizard_view_3").hide();
		$("#wizard_view_4").hide();
		$("#wizard_view_5").hide();
		$("#wizard_view_6").hide();
		$("#" + id).show();
	}
	toggle_animation(false);
}


function wizard_switch_3(id) {
	let a = hasValue("#service_job_title");
	let b = hasValue("#service_job_description");
	$("#service_job_title").removeClass('animated shake is-invalid');
	$("#service_job_description").removeClass('animated shake is-invalid');
	if (a && b) {
		$("#wizard_view_1").hide();
		$("#wizard_view_2").hide();
		$("#wizard_view_3").hide();
		$("#wizard_view_4").hide();
		$("#wizard_view_5").hide();
		$("#wizard_view_6").hide();
		$("#" + id).show();

	} else {
		if (!a) {
			$("#service_job_title").addClass('animated shake is-invalid');
			setTimeout(function () {
				$("#service_job_title").removeClass('animated shake ');
			}, 1000);
		}
		if (!b) {
			$("#service_job_description").addClass('animated shake is-invalid');
			setTimeout(function () {
				$("#service_job_description").removeClass('animated shake ');
			}, 1000);
		}
	}
	toggle_animation(false);
}


function wizard_switch_4(id) {
	$("#wizard_view_1").hide();
	$("#wizard_view_2").hide();
	$("#wizard_view_3").hide();
	$("#wizard_view_4").hide();
	$("#wizard_view_5").hide();
	$("#wizard_view_6").hide();
	$("#" + id).show();
	toggle_animation(false);
}


function wizard_switch_5(id) {
	$("#wizard_view_1").hide();
	$("#wizard_view_2").hide();
	$("#wizard_view_3").hide();
	$("#wizard_view_4").hide();
	$("#wizard_view_5").hide();
	$("#wizard_view_6").hide();
	$("#" + id).show();
	toggle_animation(false);
}

function wizard_switch_6(id) {

	//check if the user has entered location for pickup point
	let a = hasValue("#location_pickup");
	if (!a) {
		$("#location_pickup").addClass('animated shake is-invalid');
		setTimeout(function () {
			$("#location_pickup").removeClass('animated shake ');
		}, 1000);
	} else {
		$("#location_pickup").removeClass('is-invalid');
		$("#wizard_view_1").hide();
		$("#wizard_view_2").hide();
		$("#wizard_view_3").hide();
		$("#wizard_view_4").hide();
		$("#wizard_view_5").hide();
		$("#wizard_view_6").hide();
		$("#" + id).show();
	}
	toggle_animation(false);

}

function hasValue(elem) {
	return $(elem).filter(function () {
		return $(this).val();
	}).length > 0;
}


function retrieve_sub_categories(service_cat_id) {
	toggle_animation(true);

	$.ajax({
		type: "POST",
		url: app_url + '/service_seeker/services/subcategories/fetch',
		data: {
			"_token": csrf_token,
			"service_cat_id": service_cat_id,
		},
		success: function (results) {
			if (results) {
				render_service_node_list(results);
			} else {
				alert("Category not found");
			}
		},
		error: function (results, status, err) {
			console.log(err);
		}
	});
}

function render_service_node_list(data) {
	if (data != null) {
		var ul = document.getElementById('wizard_service_node_list');
		ul.innerHTML = '';
		//console.log(data);
		if (data.length == 0) {
			ul.innerHTML = "<span class='text-danger'>No services currently available. Check back later.</span>";
		}
		for (var i = 0; i < data.length; i++) {
			var li = document.createElement('li');
			li.innerHTML = ""
			li.classList = "list-group-item";
			li.id = "nid_" + data[i]['id'];
			var service_subname = data[i]['service_subname'];
			li.dataset.subcatname = service_subname;
			li.addEventListener("click", function (e) {
				//change sub category name in job page
				$("#service_subselection_name_display").text(this.getAttribute('data-subcatname'));
				set_current_node_id(this.id);
				create_seeker_job_draft();
			}, true);
			li.innerHTML = service_subname;
			ul.appendChild(li);
		}
	}
	toggle_animation(false);
}

function create_seeker_job_draft() {
	var draft_obj = {
		title: $("#service_job_title").val(),
		description: $("#service_job_description").val(),
		job_date_time: $("#service_job_datetime").val(),
		service_category_id: current_service_id,
		service_subcategory_id: current_service_node_id,
		job_lat: current_job_lat,
		job_lng: current_job_lng,
	}
	$.ajax({
		type: "POST",
		url: app_url + '/service_seeker/job/request/draft',
		data: {
			"_token": csrf_token,
			"draft_obj": JSON.stringify(draft_obj),
		},
		success: function (results) {
			current_job_draft_id = results;
			load_images(current_job_draft_id);
			$("#current_job_id").val(current_job_draft_id);
		},
		error: function (results, status, err) {
			console.log(err);
		}
	});
}


function clear_job_draft_data(job_draft_id) {
	if (job_draft_id != null) {
		$.ajax({
			type: "POST",
			url: app_url + '/service_seeker/job/clear/draft',
			data: {
				"_token": csrf_token,
				"job_draft_id": job_draft_id,
			},
			success: function (results) {
				console.log("Job draft data cleared");
				current_job_draft_id = null;
				current_job_lat = null;
				current_job_lng = null;
				// $("#service_job_datetime").val('');
			},
			error: function (results, status, err) {
				console.log(err);
			}
		});
	}
}


function book_job() {
	if (current_address_string.postcode != '') {
		if (current_job_lat != null && current_job_lng != null) {
			//show job booking type selector modal
			job_booking_submit('BOARD');
		} else {
			$("#street_number").addClass('animated shake is-invalid');
			setTimeout(function () {
				$("#street_number").removeClass('animated shake ');
			}, 1000);
		}
	} else {
		$("#street_number").addClass('animated shake is-invalid');
		setTimeout(function () {
			$("#street_number").removeClass('animated shake ');
		}, 1000);
	}
}


function job_booking_submit(type) {
	toggle_animation(true, 'Searching for providers. This usually takes around 10-20 minutes so please check back in your jobs tab when alerted.');
	var job_obj = {
		current_job_draft_id: current_job_draft_id,
		title: $("#service_job_title").val(),
		description: $("#service_job_description").val(),
		job_date_time: $("#service_job_datetime").val(),
		service_category_id: current_service_id,
		service_subcategory_id: current_service_node_id,
		service_category_name: $("#service_selection_name_display").text(),
		service_subcategory_name: $("#nid_" + current_service_node_id).text(),
		service_category_id: current_service_id,
		current_address_string: current_address_string,
		job_lat: current_job_lat,
		job_lng: current_job_lng,
		job_type: type,
	}
	$.ajax({
		type: "POST",
		url: app_url + '/service_seeker/jobs/request/type/board/submit',
		data: {
			"_token": csrf_token,
			"job_obj": JSON.stringify(job_obj),
		},
		success: function (results) {
			console.log(results);
			if (results) {
				window.location = seeker_jobs_url;
			} else {
				toggle_animation(false);
				alert("Something went wrong!")
			}
		},
		error: function (results, status, err) {
			toggle_animation(false);
			display_app_error("Job Booking: " + err);
			console.log(err);
		}
	});
}


function initAutocomplete() {

	autocomplete = new google.maps.places.Autocomplete(document.getElementById('street_number'), {
		types: ['geocode'],
		componentRestrictions: {
			country: 'au'
		}
	});
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		// Get the place details from the autocomplete object.
		place = autocomplete.getPlace();
		prepare_user_address_object(place['address_components']);
		current_job_lat = place.geometry.location.lat();
		current_job_lng = place.geometry.location.lng();
		update_map_position(place.geometry.location);
	});
}

function initAutocompletePickUp() {

	autocomplete = new google.maps.places.Autocomplete(document.getElementById('location_pickup'), {
		types: ['geocode'],
		componentRestrictions: {
			country: 'au'
		}
	});
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		// Get the place details from the autocomplete object.
		place = autocomplete.getPlace();
		prepare_user_address_pickup_object(place['address_components']);
		current_job_lat_pickup = place.geometry.location.lat();
		current_job_lng_pickup = place.geometry.location.lng();
        prepare_user_address_object(place['address_components']);
		current_job_lat = place.geometry.location.lat();
		current_job_lng = place.geometry.location.lng();
		update_map_pickup_position(place.geometry.location);
	});
}

function initAutocompleteDropOff() {

	autocomplete = new google.maps.places.Autocomplete(document.getElementById('location_dropoff'), {
		types: ['geocode'],
		componentRestrictions: {
			country: 'au'
		}
	});
	google.maps.event.addListener(autocomplete, 'place_changed', function () {
		// Get the place details from the autocomplete object.
		place = autocomplete.getPlace();
		prepare_user_address_dropoff_object(place['address_components']);
		current_job_lat_dropoff = place.geometry.location.lat();
		current_job_lng_dropoff = place.geometry.location.lng();
		update_map_dropoff_position(place.geometry.location);
	});
}


//user presses reset btn event
function resetPosition() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (position) {
				pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				geocodePosition(pos);
			},
			function () {});
	} else {
		display_snakbar_alert('Unable to update location! Please try entering location manually.');

	}
}

function update_map_position(location) {
	map.panTo(location);
	current_user_marker.setPosition(location);
	map.setZoom(18);
}

//for pickup location (Deliveries only)
function update_map_pickup_position(location) {
	map_pickup.panTo(location);
	current_user_marker_pickup.setPosition(location);
	map_pickup.setZoom(18);
}
//for dropoff location (Deliveries only)
function update_map_dropoff_position(location) {
	map_dropoff.panTo(location);
	current_user_marker_dropoff.setPosition(location);
	map_dropoff.setZoom(18);
}

function prefill_location_info() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (position) {
				pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};
				geocodePosition(pos);
			},
			function () {});
	} else {
		console.log('Unable to prefil location. Please enter location manually.');
	}
}

function geocodePosition(pos) {
	geocoder.geocode({
		latLng: pos
	}, function (responses) {
		if (responses && responses.length > 0) {
			prepare_user_address_object(responses[0].address_components);
			current_job_lat = responses[0].geometry.location.lat();
			current_job_lng = responses[0].geometry.location.lng();
			update_map_position(responses[0].geometry.location);
			document.getElementById('street_number').value = responses[0].formatted_address;
		}
	});
}

function geocodePositionPickup(pos) {
	geocoder.geocode({
		latLng: pos
	}, function (responses) {
		if (responses && responses.length > 0) {

            prepare_user_address_object(responses[0].address_components);
			current_job_lat = responses[0].geometry.location.lat();
			current_job_lng = responses[0].geometry.location.lng();

			current_job_lat_pickup = responses[0].geometry.location.lat();
			current_job_lng_pickup = responses[0].geometry.location.lng();
			prepare_user_address_pickup_object(responses[0].address_components);
            
			update_map_pickup_position(responses[0].geometry.location);
			document.getElementById('location_pickup').value = responses[0].formatted_address;
			//copy all the data to job address string object
			
		}
	});
}

function geocodePositionDropOff(pos) {
	geocoder.geocode({
		latLng: pos
	}, function (responses) {
		if (responses && responses.length > 0) {
			current_job_lat_dropoff = responses[0].geometry.location.lat();
			current_job_lng_dropoff = responses[0].geometry.location.lng();
			prepare_user_address_dropoff_object(responses[0].address_components);
			update_map_dropoff_position(responses[0].geometry.location);
			document.getElementById('location_dropoff').value = responses[0].formatted_address;
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


//prepare user pickup address string for job booking object
function prepare_user_address_pickup_object(address_object) {
	//make default values null
	current_address_string_pickup = {
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
			current_address_string_pickup.street_number = val;
		} else if (address_type == "route") {
			current_address_string_pickup.street_name = val;
		} else if (address_type == "administrative_area_level_2") {
			current_address_string_pickup.city = val;
		} else if (address_type == "administrative_area_level_1") {
			current_address_string_pickup.state = val;
		} else if (address_type == "postal_code") {
			current_address_string_pickup.postcode = val;
		} else if (address_type == "postal_code") {
			current_address_string_pickup.postcode = val;
		} else if (address_type == "locality") {
			current_address_string_pickup.suburb = val;
		}
	}
}


//prepare user dropoff address string for job booking object
function prepare_user_address_dropoff_object(address_object) {
	//make default values null
	current_address_string_dropoff = {
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
			current_address_string_dropoff.street_number = val;
		} else if (address_type == "route") {
			current_address_string_dropoff.street_name = val;
		} else if (address_type == "administrative_area_level_2") {
			current_address_string_dropoff.city = val;
		} else if (address_type == "administrative_area_level_1") {
			current_address_string_dropoff.state = val;
		} else if (address_type == "postal_code") {
			current_address_string_dropoff.postcode = val;
		} else if (address_type == "postal_code") {
			current_address_string_dropoff.postcode = val;
		} else if (address_type == "locality") {
			current_address_string_dropoff.suburb = val;
		}
	}
}

//delivery job booking functions 
function book_delivery_job() {

	//console.log("Preparing to book delivery job.");
	if (current_job_lat_dropoff != null && current_job_lat_dropoff != null) {
		console.log("Delivery job ready to submit.");
		//show job booking type selector modal
		job_booking_delivery_submit('BOARD');
	} else {
		$("#location_dropoff").addClass('animated shake is-invalid');
		setTimeout(function () {
			$("#location_dropoff").removeClass('animated shake is-invalid');
		}, 1000);
	}

}

//delivery job type submission
function job_booking_delivery_submit(type) {
	toggle_animation(true, 'Searching for providers. This usually takes around 10-20 minutes so please check back in your jobs tab when alerted.');
	var job_obj = {
		current_job_draft_id: current_job_draft_id,
		title: $("#service_job_title").val(),
		description: $("#service_job_description").val(),
		job_date_time: $("#service_job_datetime").val(),
		service_category_id: current_service_id,
		service_subcategory_id: current_service_node_id,
		service_category_name: $("#service_selection_name_display").text(),
		service_subcategory_name: $("#nid_" + current_service_node_id).text(),
		service_category_id: current_service_id,
		current_address_string: current_address_string,
		job_lat: current_job_lat,
		job_lng: current_job_lng,
        current_address_string_pickup: current_address_string_pickup,
		job_lat_pickup: current_job_lat_pickup,
		job_lng_pickup: current_job_lng_pickup,
        current_address_string_dropoff: current_address_string_dropoff,
		job_lat_dropoff: current_job_lat_dropoff,
		job_lng_dropoff: current_job_lng_dropoff,
		job_type: type,
	}
    
	$.ajax({
		type: "POST",
		url: app_url + '/service_seeker/jobs/request/type/board/submit/delivery',
		data: {
			"_token": csrf_token,
			"job_obj": JSON.stringify(job_obj),
		},
		success: function (results) {
			console.log(results);
			if (results) {
				window.location = seeker_jobs_url;
			} else {
				toggle_animation(false);
				alert("Something went wrong!")
			}
		},
		error: function (results, status, err) {
			toggle_animation(false);
			display_app_error("Job Booking: " + err);
			console.log(err);
		}
	});
}