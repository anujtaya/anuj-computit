function filter_service_provider_jobs(data,isViewUpdateRequired) {
   if (data != null) {
      data = data.attr('data-value');
   }
   if (data == null) {
      console.log('No sort requested!');
      make_filter_ajax_request(data,isViewUpdateRequired);
   }
   else if (data == 'Rating') {
      make_filter_ajax_request(data,isViewUpdateRequired);
      console.log('Rating sort requested!');
   }
   else if (data == 'Distance') {
      make_filter_ajax_request(data,isViewUpdateRequired);
      console.log('Distance sort requested!');
   }
}

function make_filter_ajax_request(data , isViewUpdateRequired) {
    //toggle_animation(true);
    if(isViewUpdateRequired) {
        job_list_container.style.display = "none";
        preloader_container.style.display = 'block';
    }
    $.ajax({
        type: "POST",
        url: service_provider_jobs_fetch_url,
        data: {
            "_token": csrf_token,
            "filter_action": data,
            "current_lat" : current_lat,
            "current_lng" : current_lng
        },
        success: function(results) {
                console.log(results['jobs']);    
            if(isViewUpdateRequired) {
                    job_list_container.style.display = "block";
                    preloader_container.style.display = 'none';    
                }
                var myUl = $("#job_list_display");
                update_refresh_count = 0;    
                update_refresh_count_display();
                //console.log(results);      
                myUl.html(results['html']);
                jobs = results['jobs'];
                display_job_markers();
                //toggle_animation(false);
                if (data != null)
                {
                    var filterAnchorTag = document.getElementById('sp_jobs_filter');
                    filterAnchorTag.innerHTML = "<i class='fas fa-sort-amount-up-alt'></i> Filter <small>(" + data.trim() + ")</small>";
                }
        },
        error: function(results, status, err) {
            console.log('Jobs ajax error: ' + err);
            if(isViewUpdateRequired) {
                job_list_container.style.display = "block";
                preloader_container.style.display = 'none';    
            }  
        }
    });
}


function update_refresh_count_display() {
   //console.log('Event: Refresh Time Counter Updated.')
   update_refresh_count = update_refresh_count + 5;
   $("#update_refresh_counter_el").html(update_refresh_count)
}


function switch_view_mode(str) {
   if (str == 'MAP') {
       $("#job_list_display").hide();
       $("#map_view_display").show();
       $("#map_reset_btn").show();
       $("#sp_jobs_filter").hide();
       $("#map_btn").hide();
       $("#list_btn").fadeIn();
       $("#list_btn").addClass('animated zoomIn');
       setTimeout(function() {
           $("#list_btn").removeClass('animated zoomIn ');
       }, 1000);
       find_closest_marker();
   } else if (str == 'LIST') {
       $("#job_list_display").show();
       $("#map_view_display").hide();
       $("#sp_jobs_filter").show();
       $("#list_btn").hide();
       $("#map_reset_btn").hide();
       $("#map_btn").fadeIn();
       $("#map_btn").addClass('animated zoomIn');
       setTimeout(function() {
           $("#map_btn").removeClass('animated zoomIn ');
       }, 1000);
   }
}