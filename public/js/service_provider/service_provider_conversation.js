$(document).ready(function() {
  check_every_five_seconds();
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
              // alert("Something went wrong!");
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