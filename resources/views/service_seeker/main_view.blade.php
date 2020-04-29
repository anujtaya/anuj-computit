<style>
  body {
      background:#f7f7f9!important;
  }
</style>
<div class="border-top p-2">
   <div class="sticky-top pb-2" style="background:#f7f7f9!important;">
    <div class="input-group mt-2 mb-3 ">
        <div class="input-group-prepend   fs--1">
          <span class="input-group-text bg-white " id="basic-addon1"><i class="fas text-muted  fs--1 fa-search"></i></span>
        </div>
        <input id="seeker_services_filter_input" type="text" class="form-control p-4 fs--1" onkeyup="populate_seeker_services();" placeholder="Enter keywords.." aria-label="Username" aria-describedby="basic-addon1" >
    </div>
    <div class="text-center mb-3">
        <div class="btn-group" role="group" aria-label="Basic example">
          <button type="button" id="services-sort-az" class="btn theme-button-color border-theme-color text-white rounded-capsules btn-sm border fs--2" onclick="seeker_services_sort(1);">Sort A-Z</button>
          <button type="button" id="services-sort-popularity" class="btn btn-white rounded-capsules border fs--2" onclick="seeker_services_sort(2);">Sort Popular</button>
        </div>
    </div>
  </div>
   <div style="margin-bottom:20%;">
      <div id="seeker_services_list_container" class="row text-center fs--1 m-0" >
        @foreach($categories as $category)
         <div  class="col-6 p-1">
            <div class="rounded h-100 bg-white p-1 text-center shadow-sms card-1" id="sid-{{$category->id}}" onclick="user_service_selection(this.id);" data-catname="{{$category->service_name}}">
              <img src="{{asset('images/service_icons/'.strtolower(str_replace(' ', '',$category->service_name)).'.svg')}}" class="rounded mx-auto d-block" style="height:60px;width:50px;" alt="">
              <span>{{$category->service_name}}</span>
            </div>
         </div>
        @endforeach
      </div>
   </div>
</div>

<script>
var seeker_services_fetch_url = "{{route('service_seeker_services_filter')}}"
var seeker_services_filter_array = null;
var sort_unselected_class = "btn btn-white rounded-capsules border fs--1";
var sort_selected_class = "btn theme-button-color border-theme-color text-white rounded-capsules btn-sm border fs--2";
var app_url = "{{URL::to('/')}}";

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

      div_1.classList = 'col-6 p-2';
      div_2.classList = 'rounded h-100 bg-white p-1 text-center border';
      div_2.id = "sid-"+data[i]['id'];
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
    console.log(result);
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

@include('service_seeker.bottom_navigation_bar')
