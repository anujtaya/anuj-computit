<style>
    body {
        background: #f7f7f9 !important;
    }
</style>
<div class="border-top p-2">
    @if($session_draft_job != null)
    @if($session_draft_job->status == 'DRAFT')
    <div class="p-2 bg-white theme-color shadow-sm rounded fs--1  mb-3" style="border-color:#f7f7f9!important;">
        Welcome back! We have pre-filled some section for the draft job from your previous visit.
    </div>
    @elseif($session_draft_job->status == 'READY')
    <div class="p-2 bg-white rounded fs--1 mb-3 shadow-sm mb-3" style="border-color:#f7f7f9!important;">
        Hello there! Continue where you left earlier by tapping the button below.
        <br>
        <a class="btn theme-background-color text-white btn-block btn-sm border-0 card-1 mt-2"
            href="{{route('guest_service_seeker_home')}}?showSPSView=on" onclick="toggle_animation(true)">Continue <i
                class="fas fa-arrow-right"></i></a>
    </div>
    @endif
    @endif
    <div class="sticky-top pb-2" style="background:#f7f7f9!important;">
        <div class="input-group pt-2 mb-3 ">
            <div class="input-group-prepend   fs--1">
                <span class="input-group-text bg-white " id="basic-addon1"><i
                        class="fas text-muted  fs--1 fa-search"></i></span>
            </div>
            <input id="seeker_services_filter_input" type="text" class="form-control p-4 fs--1"
                onkeyup="populate_seeker_services();" placeholder="Enter keywords.." aria-label="Username"
                aria-describedby="basic-addon1">
        </div>
        <div class="text-center mb-3">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" id="services-sort-az"
                    class="btn theme-button-color border-theme-color text-white rounded-capsules btn-sm border fs--2"
                    onclick="seeker_services_sort(1);">Sort A-Z</button>
                <button type="button" id="services-sort-popularity" class="btn btn-white rounded-capsules border fs--2"
                    onclick="seeker_services_sort(2);">Sort Popular</button>
            </div>
        </div>
    </div>
    <div style="margin-bottom:30%;">
        <div id="seeker_services_list_container" class="row text-center m-0" style="font-size: 0.9rem;">
            @foreach($categories as $category)
            <div class="col-6 p-1">
                <div class="rounded  bg-white pt-3 pl-2 pr-2 text-center shadow-sms card-1"
                    style="min-height:160px!important;" id="sid-{{$category->id}}"
                    onclick="user_service_selection(this.id);" data-catname="{{$category->service_name}}">

                    <img src="{{asset('images/service_icons/'.strtolower(str_replace(' ', '',$category->service_name)).'.svg')}}"
                        class="rounded mx-auto d-block" style="height:60px;width:60px; margin-bottom:15px;" alt="">

                    <div>{{$category->service_name}}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    var seeker_services_fetch_url = "{{route('guest_service_seeker_services_filter')}}"
   var seeker_services_filter_array = null;
   var sort_unselected_class = "btn btn-white rounded-capsules border fs--1";
   var sort_selected_class = "btn theme-button-color border-theme-color text-white rounded-capsules btn-sm border fs--2";
   var app_url = "{{URL::to('/')}}";
   var current_session_id = "{{Session::getId()}}";

   function populate_seeker_services(){
       var search_term = $('#seeker_services_filter_input').val();
       $.ajax({
           url: seeker_services_fetch_url,
           type: 'POST',
           data: {_token: CSRF_TOKEN, search:search_term},
           dataType: 'JSON',
           success: function (result) {
               display_updated_seeker_service_list(result)
               seeker_services_filter_array = result;
           }
       });
   }

   function display_updated_seeker_service_list(data) {
    var element = document.getElementById("seeker_services_list_container");
    element.innerHTML = "";
    for(var i=0;i<data.length;i++) {
      var div_1 = document.createElement('div');
      var div_2 = document.createElement('div');
      var img = document.createElement('img');

      div_1.classList = 'col-6 p-1';
      div_2.classList = 'rounded  bg-white pt-3 pl-2 pr-2 text-center shadow-sms card-1';
      div_2.id = "sid-"+data[i]['id'];
      div_2.style = "min-height:160px!important;";
      div_2.dataset.catname = data[i]['service_name'];
      div_2.addEventListener('click', function(){
        user_service_selection(this.id);
      });
      img.src = app_url + "/images/service_icons/"+ data[i]['service_name'].replace(/ /g,'').toLowerCase() + ".svg";
      img.classList = "rounded mx-auto d-block";
      img.style = "height: 60px; width: 50px;";
      var text = document.createTextNode(data[i]['service_name']);

      element.appendChild(div_1);
      div_1.appendChild(div_2);
      div_2.appendChild(img);
      div_2.appendChild(text);

    }
}


   function seeker_services_sort(type){
     if(type == 1){
       //// sort by alphabetical order /////
       // Change class name
       $("#services-sort-az").removeClass();
       $("#services-sort-az").addClass(sort_selected_class)
       $("#services-sort-popularity").removeClass();
       $("#services-sort-popularity").addClass(sort_unselected_class)
       var key = 'service_name';
       var result = seeker_services_filter_array.sort(function(a,b){
         var x = a[key]; var y = b[key];
         return ((x < y) ? -1 : ((x > y) ? 1 : 0));  });
       //console.log(result);
     }
     else if(type == 2){
       // sort by popularity
       $("#services-sort-popularity").removeClass();
       $("#services-sort-popularity").addClass(sort_selected_class)
       $("#services-sort-az").removeClass();
       $("#services-sort-az").addClass(sort_unselected_class)
       // add custom function
     }

   }
</script>
