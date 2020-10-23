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
    //toggle_animation(true);
    $.ajax({
        type: "POST",
        url: service_provider_jobs_fetch_url,
        data: {
            "_token": csrf_token,
            "filter": data,
            "current_lat": current_lat,
            "current_lng": current_lng,
            "includes_keywords": '',
        },
        success: function(results) {
            console.log(data);
            update_refresh_count = 0;
            update_refresh_count_display();
            jobs = results['jobs'];
            display_job_markers();
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