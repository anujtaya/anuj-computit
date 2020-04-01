var current_offer_modal_job_id = null;
var current_offer_modal_service_provider_id = null;



function fetch_job_offer_message(conversation_id){
  toggle_animation(true);

  $.ajax({
       type: "POST",
       url: app_url + '/serivce_seeker/messages/offer/'+conversation_id,
       data: {
         "_token": csrf_token,
         "conversation_id": conversation_id,
       },
       success: function(results){
         var re = JSON.parse(results);
         console.log(re);
         current_offer_modal_job_id = re.conversation.job_id;
         current_offer_modal_service_provider_id = re.conversation.service_provider_id;
         $("#message_offer_service_provider_name").text(re.service_provider.first+" "+re.service_provider.last);
         $("#message_offer_service_provider_description").text(re.conversation.json["offer_description"]);
         $("#message_offer_service_provider_price").text("$"+re.conversation.json["offer"]);

         toggle_animation(false);
       },
       error: function(results, status, err) {
           console.log(err);
       }
   });
}

function show_job_offer_conversation(){
  location.href = app_url+"/service_seeker/jobs/job/conversation/"+current_offer_modal_job_id+"/"+current_offer_modal_service_provider_id+"/"+"MJFO";
}
