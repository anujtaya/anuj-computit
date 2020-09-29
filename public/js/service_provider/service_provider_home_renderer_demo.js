function filter_service_provider_jobs(data, isViewUpdateRequired) {
    if (data != null) {
        data = data.attr('data-value');
    }
    if (data == null) {
        //console.log('No sort requested!');
        make_filter_ajax_request(data, isViewUpdateRequired);
    } else if (data == 'Rating') {
        make_filter_ajax_request(data, isViewUpdateRequired);
        //console.log('Rating sort requested!');
    } else if (data == 'Distance') {
        make_filter_ajax_request(data, isViewUpdateRequired);
        //console.log('Distance sort requested!');
    }
}

function make_filter_ajax_request(data, isViewUpdateRequired) {
    //toggle_animation(true);
    $.ajax({
        type: "POST",
        url: service_provider_jobs_fetch_url,
        data: {
            "_token": csrf_token,
            "filter_action": data,
            "current_lat": current_lat,
            "current_lng": current_lng
        },
        success: function(results) {
            console.log(results['jobs']);
            update_refresh_count = 0;
            update_refresh_count_display();
            jobs = results['jobs'];
            display_job_markers();
            //toggle_animation(false);

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