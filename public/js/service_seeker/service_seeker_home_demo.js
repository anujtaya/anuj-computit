function map_display_control() {
    if ($("#map").is(":visible")) {
        $("#map:visible").fadeOut()
    } else {
        $("#map:hidden").fadeIn()
    }
}


var current_service_id = null;
var current_service_node_id = null;
var current_job_lat = null;
var current_job_lng = null;
var draft_obj = {
    title: $("#service_job_title").val(),
    description: $("#service_job_description").val(),
    job_date_time: $("#service_job_datetime").val(),
    service_subcategory_id: current_service_node_id,
    job_lat: current_job_lat,
    job_lng: current_job_lng,
}

function user_service_selection(service_id) {
    var service_name = $("#" + service_id).data("catname");
    var user_service_id = service_id.substr(4);
    $("#service_selection_name_display").text(service_name);
    //sert current service id to user selected service id
    current_service_id = user_service_id;
    $("#view_box_1").hide();
    // retrieve service sub categories
    retrieve_sub_categories(current_service_id);
    //display service wizard
    $("#view_box_2").fadeIn();
}



function wizard_exit() {
    wizard_switch_2('wizard_view_1');
    $("#view_box_2").hide();
    $("#view_box_1").fadeIn();
    //clear draft job here for current user session
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
        resetPosition();
        wizard_switch_4(id);
    }
}

function wizard_switch_1(id) {
    $("#wizard_view_1").hide();
    $("#wizard_view_2").hide();
    $("#wizard_view_3").hide();
    $("#wizard_view_4").hide();
    $("#" + id).show();
    toggle_animation(false);
}

function wizard_switch_2(id) {
    if (current_service_node_id == null) {
        $("#wizard_view_1").show();
        console.log('No service node id found.');
        $("#wizard_service_node_list").addClass('animated shake');
        setTimeout(function() { $("#wizard_service_node_list").removeClass('animated shake'); }, 1000);
    } else {
        $("#wizard_view_1").hide();
        $("#wizard_view_2").hide();
        $("#wizard_view_3").hide();
        $("#wizard_view_4").hide();
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
        $("#" + id).show();

    } else {
        if (!a) {
            $("#service_job_title").addClass('animated shake is-invalid');
            setTimeout(function() { $("#service_job_title").removeClass('animated shake '); }, 1000);
        }
        if (!b) {
            $("#service_job_description").addClass('animated shake is-invalid');
            setTimeout(function() { $("#service_job_description").removeClass('animated shake '); }, 1000);
        }
    }
    toggle_animation(false);
}

function wizard_switch_4(id) {
    $("#wizard_view_1").hide();
    $("#wizard_view_2").hide();
    $("#wizard_view_3").hide();
    $("#wizard_view_4").hide();
    $("#" + id).show();
    toggle_animation(false);
}

function hasValue(elem) {
    return $(elem).filter(function() { return $(this).val(); }).length > 0;
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
        success: function(results) {
            if (results) {
                render_service_node_list(results);
            } else {
                alert("Category not found");
            }
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
}

function render_service_node_list(data) {
    if (data != null) {
        var ul = document.getElementById('wizard_service_node_list');
        ul.innerHTML = '';
        console.log(data);
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
            li.addEventListener("click", function(e) {
                //change sub category name in job page
                $("#service_subselection_name_display").text(this.getAttribute('data-subcatname'));
                set_current_node_id(this.id);
                create_draft_job();
            }, true);
            li.innerHTML = service_subname;
            ul.appendChild(li);
        }
    }
    toggle_animation(false);
}




var placeSearch;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    postal_code: 'short_name'
};
var autocomplete;

function initAutocomplete() {

    autocomplete = new google.maps.places.Autocomplete(document.getElementById('street_number'), {
        types: ['geocode'],
        componentRestrictions: { country: 'au' }
    });
    google.maps.event.addListener(autocomplete, 'place_changed', function() {

        // Get the place details from the autocomplete object.
        place = autocomplete.getPlace();
        current_address_string = place['address_components'];

        //console.log(current_address_string);
        current_job_lat = place.geometry.location.lat();
        current_job_lng = place.geometry.location.lng();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        var fullAddress = [];

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
            if (addressType == "street_number") {
                fullAddress[0] = val;
            } else if (addressType == "route") {
                fullAddress[0] += " " + val;
            }
        }

        document.getElementById('street_number').value = fullAddress.join(" ");
        if (document.getElementById('street_number').value !== "") {
            document.getElementById('street_number').disabled = false;
        }


    });
}







//draft job create routes
var draft_obj = null;

function create_draft_job() {
    // if(current_job_draft_id == null){
    draft_obj = null;
    draft_obj = {
        title: $("#service_job_title").val(),
        description: $("#service_job_description").val(),
        job_date_time: $("#service_job_datetime").val(),
        service_category_id: current_service_id,
        service_subcategory_id: current_service_node_id,
        job_lat: current_job_lat,
        job_lng: current_job_lng,

    }

    console.log(draft_obj);
}