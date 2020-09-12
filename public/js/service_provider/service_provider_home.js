function fetch_all_jobs(flag) {
    if (is_view_update_required == true) {
        preloader_container.style.display = "block";
        job_list_container.style.display = "block";
    }
    $.ajax({
        url: service_provider_jobs_fetch_url,
        type: 'POST',
        data: { _token: CSRF_TOKEN },
        dataType: 'JSON',
        success: function(data) {
            //console.log(data);
            //console.log('Event: Job Refresh Counter Updated.')
            update_refresh_count = 0;
            update_refresh_count_display();
            // if(data.length != 0) {
            jobs = data;
            display_job_list();
            display_job_markers();
            // }
        }
    });
}

function update_refresh_count_display() {
    //console.log('Event: Refresh Time Counter Updated.')
    update_refresh_count = update_refresh_count + 5;
    $("#update_refresh_counter_el").html(update_refresh_count)
}


function display_job_list() {
    if (is_view_update_required == true) {
        preloader_container.style.display = "none";
        job_list_container.style.display = "block";
    }
    job_list_container.innerHTML = "";

    //apply filters here

    for (var i = 0; i < jobs.length; i++) {
        //preapre the main list object
        var li = document.createElement('li');
        li.classList = "custom-job-class-list list-group-item  m-1 shadow-sm";
        li.id = "jl_" + jobs[i]['id'];
        li.addEventListener("click", function() {
            open_job_view(this.id);
        });

        //preapre the first flex div
        var div1 = document.createElement('div');
        div1.classList = "pb-1 w-100 bd-highlight  font-weight-bold cjtfs";
        div1.innerHTML = jobs[i]['title'];

        //appedn the second child div
        var div2 = document.createElement('div');
        div2.classList = "pb-1 flex-shrink-1 text-success fs--2";
        div2.innerHTML = 'Currently Open';


        //appedn the third child div
        var div3 = document.createElement('div');
        div3.classList = "fs--2";
        div3.innerHTML = '<i class="fas fa-map-marker-alt"></i>' + ' Toownd 18.5kms';

        //appedn the fourth child div
        var div4 = document.createElement('div');
        div4.classList = "fs--2";
        div4.innerHTML = '<i class="far fa-calendar-alt"></i>' + ' 28/02/2020 10:30AM';

        //appedn the fifth child div
        var div5 = document.createElement('div');
        div5.classList = "text-muted bg-light p-2 mb-1 mt-1 fs--2 rounded";
        div5.innerHTML = jobs[i]['description'].substr(0, 40);


        //append the main list object to the job list container
        li.appendChild(div1);
        li.appendChild(div2);
        li.appendChild(div3);
        li.appendChild(div4);
        li.appendChild(div5);
        job_list_container.appendChild(li);

    }
}

function open_job_view(link_id) {
    toggle_animation(true);
    location.href = app_url + "/service_provider/jobs/job/" + link_id.substr(3);
    console.log(link_id);
}