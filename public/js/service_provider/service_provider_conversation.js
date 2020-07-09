$(document).ready(function() {
    check_every_five_seconds();
    if (job_status == 'OPEN') {
        check_if_offer_accepted();
    } else {
        console.log('No need to check to see if the job offer is accpeted.');
    }
});

function send_message_provider(conversation_id) {
    toggle_animation(true);
    $.ajax({
        type: "POST",
        url: app_url + '/service_provider/jobs/job/conversation/send_message',
        data: {
            "_token": csrf_token,
            "conversation_id": conversation_id,
            "message": $("#service_provider_conversation_message").val(),
        },
        success: function(results) {
            console.log(results)
            if (results) {
                location.reload();
            } else {
                toggle_animation(false);
            }
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
}

function check_every_five_seconds() {
    setInterval(check_new_messages, 10000);
}

function check_new_messages() {
    $.ajax({
        type: "POST",
        url: app_url + '/service_provider/jobs/job/conversation/check_new_messages',
        data: {
            "_token": csrf_token,
            "msgs": msgs,
            "conversation_id": conversation_id,
        },
        success: function(results) {
            if (results == false) {
                //do nothing
            } else {
                var myDiv = $("#scroll-area");
                myDiv.append(results['html']);
                msgs = results['msgs'];
                audio.play();
                $("#scroll-area").stop().animate({
                    scrollTop: "+=100"
                }, 100);
            }
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
}

var offer_interval = null;

function check_if_offer_accepted() {
    offer_interval = setInterval(start_offer_check_interval, 10000);
}


function start_offer_check_interval() {
    $.ajax({
        type: "POST",
        url: service_provider_offer_accept_check_url,
        data: {
            "_token": csrf_token,
            "job_id": job_id,
        },
        success: function(results) {
            if (results == true) {
                $('#job_accepted_modal').modal("show");
                clearInterval(offer_interval);
            }
        },
        error: function(results, status, err) {
            console.log(err);
        }
    });
}