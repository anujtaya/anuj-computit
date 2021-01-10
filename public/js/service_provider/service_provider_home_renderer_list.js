function filter_service_provider_jobs(data) {
    if (data != null) {
        current_filter_choice = data;
        make_filter_ajax_request(data);
    } else {
        data = current_filter_choice;
        make_filter_ajax_request(data);
    }

}



function make_filter_ajax_request(data) {
    $.ajax({
        type: "POST",
        url: service_provider_jobs_fetch_url,
        data: {
            "_token": csrf_token,
            "filter": data,
            "current_lat": current_lat,
            "current_lng": current_lng,
            "includes_keywords": $('#basic-search-1').val(),
        },
        success: function(results) {
            //console.log('Preparing job list...')
            var myUl = $("#job_list_display");
            update_refresh_count = 0;
            update_refresh_count_display();
            //console.log(results);
            myUl.html(results['html']);
            jobs = results['jobs'];
            //display_job_markers();
            if (jobs.length == 0) {
                console.log('No jobs found!');
                if (search_box.value != "") {

                } else {
                    search_box.readOnly = true;
                    search_box.placeholder = 'No jobs available in your area.';
                }
            } else {
                console.log('Jobs found!');
                search_box.readOnly = false;
                search_box.placeholder = 'Enter keywords...';
            }
            if (data != null) {
                document.getElementById('sp_jobs_filter').innerHTML = "<i class='fas fa-sort-amount-up-alt'></i> Sort <small>(" + data.trim() + ")</small>";
            }
        },
        error: function(results, status, err) {
            console.log('Jobs ajax error: ' + err);
        }
    });
}


function update_refresh_count_display() {
    //console.log('Event: Refresh Time Counter Updated.')
    update_refresh_count = update_refresh_count + 5;
    $("#update_refresh_counter_el").html(update_refresh_count)
}


//the alert message will be displayed to the user if there are no jobs to be displayed and when search input is clicked.
function display_empty_job_alert() {
    if (search_box != null) {
        if (search_box.readOnly == true) {
            //console.log("No job alert triggered,");
            $('#job_not_found_alert_modal').modal('show');
        }
    }
}