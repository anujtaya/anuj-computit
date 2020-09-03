<style>
.new-editprofile{
   margin:auto;
}
.new-dot{
border-radius:50%;
}
</style>

<div class="mt-2 fs--1">
<!-- basic info  -->
<div class="d-flex  theme-background-color rounded  text-white bd-highlight m-2 sticky-top shadow">
   <div class="p-3 bd-highlight">
      <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/{{Auth::user()->profile_image_path}}" class="border-white card-1 new-dot" id="trigger_image" height="40" width="40"  alt="Service Provider profile image" onerror="this.src='data:image/png;base64,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'" >
   </div>
   <div class="p-3 bd-highlight">
      <span>{{Auth::user()->first}} {{Auth::user()->last}}</span> <br>
      <span class="fs--1 text-white">Member Since: 2020</span>
   </div>
   <div class="p-3 ml-auto bd-highlight">
      <a href="{{route('service_provider_profile_edit')}}" onclick="toggle_animation(true);" class="float-right text-white new-editprofile">Edit Profile</a>
   </div>
</div>
<!-- completion rate info  -->
<div class="d-flex bd-highlight rounded m-2 card-1">
   <div class="p-3 bd-highlight">
      <span class="fs-2">
      @switch($stats->percentage)
      @case($stats->percentage > 80 && $stats->percentage <= 100)
      <span class="text-success">{{$stats->percentage}}%</span> 
      @break
      @case($stats->percentage > 40 && $stats->percentage < 80)
      <span class="theme-color">{{$stats->percentage}}%</span>  
      @break
      @case( $stats->percentage < 40)
      <span class="text-danger">{{$stats->percentage}}%</span>    
      @break
      @default
      @endswitch
      </span> 
      <br>Completion Rate 
      <span></span>
   </div>
   <div class="p-3 bd-highlight">
      <span class="fs-2">{{$stats->rating}} </span> <br>
      <span class="text-warning">
         @for($i=0;$i<intval($stats->rating);$i++)
            <i class="fas fa-star mt-0"></i> 
         @endfor
      </span>
   </div>
</div>
<div class="m-2 p-2 rounded card-1">
   <div class="d-flex bd-highlight rounded">
      <div class="p-1 bd-highlight">
         <span>Add Services</span>
      </div>
      <div class="p-1 ml-auto bd-highlight">
         <a href="{{route('service_provider_profile_update_service_preferences')}}" onclick="toggle_animation(true);"><i class="fas fa-plus-circle rounded-circle card-1 theme-color fs-1"></i></a>
      </div>
   </div>
   @foreach($user_services as $user_service)
   <span class="badge bg-white theme-color  m-1  fs--1 card-1 rounded-pill "  >
   {{$user_service->service_sub_cat->service_category->service_name}} - {{$user_service->service_sub_cat->service_subname}}
   </span>
   @endforeach  
</div>
<div class="m-2 p-2 card-1 rounded">
   <div class="d-flex bd-highlight rounded">
      <div class="p-1 bd-highlight">
         <span>Education & Certifications</span>
      </div>
      <div class="p-1 ml-auto bd-highlight">
         <a href="{{route('service_provider_profile_update_certificate_preferences')}}" onclick="toggle_animation(true);"><i class="fas fa-plus-circle rounded-circle card-1 theme-color fs-1"></i></a>
      </div>
   </div>
   <br>
   @foreach($certificates as $certificate)
   <li class="list-group-item fs--2">
      <div class="d-flex p-0 bd-highlight">
         <div class="p-1 flex-grow-1 bd-highlight"> {{$certificate->certificate_name}}</div>
         <div class="p-1 bd-highlight">{{ date('d/m/Y', strtotime($certificate->certificate_expiry)) }}</div>
         <div class="p-1 bd-highlight"> <a href="{{route('service_provider_delete_certificate', $certificate->id)}}" onclick="toggle_animation(true);" class="text-decoration-none text-danger">Remove</a> </div>
      </div>
   </li>
   @endforeach
</div>
<div class="m-2 p-2 card-1 rounded">
   <div class="d-flex bd-highlight rounded">
      <div class="p-1 bd-highlight">
         <span>Languages</span>
      </div>
      <div class="p-1 ml-auto bd-highlight">
         <a href="{{route('service_provider_profile_update_languages_preferences')}}" onclick="toggle_animation(true);"><i class="fas fa-plus-circle rounded-circle card-1 theme-color fs-1"></i></a>
      </div>
   </div>
   <div>
      @foreach($current_languages as $language)
      <span class="badge bg-white theme-color  m-1  fs--1 card-1 rounded-pill"> {{$language->language_name}} </span>
      @endforeach    
      <span class="badge bg-white theme-color  m-1  fs--1 card-1 rounded-pill"> English (Default) </span>
   </div>
</div>
<div class="m-2 p-2 rounded card-1">
   <div class="d-flex bd-highlight rounded">
      <div class="p-1 bd-highlight">
         <span>Bio (About you)</span>
      </div>
      <div class="p-1 ml-auto bd-highlight">
         <a href="{{route('service_provider_profile_update_user_bio')}}" onclick="toggle_animation(true);"><i class="fas fa-plus-circle rounded-circle card-1 theme-color fs-1"></i></a>
      </div>
   </div>
   <p class="p-2">
      @if(Auth::user()->user_bio != null)
      <i>
         <span class="teaser">{{substr(Auth::user()->user_bio, 0, 30)}}</span>
         @if(strlen(Auth::user()->user_bio) > 29)
            <span class="complete" style="display:none;">{{substr(Auth::user()->user_bio, 30)}}</span>
            <span class="more theme-color">More</span>
         @endif
      </i>
      @else
      <i class="theme-color">
         You haven’t submitted any information in the about me section. You are strongly encouraged to fill out this section to attract more engagement from Service Seekers in your area.
      </i>
      @endif
   </p>
</div>
<div class="m-2   rounded">
   <div class="d-flex bd-highlight mt-4 rounded">
      <div class="p-2 bd-highlight">
         <span>Reviews</span>
      </div>
   </div>
   <div>
      @foreach($stats->rating_records as $r)
      <div class="shadow-sm mt-2 p-4">
         <div class="d-flex bd-highlight mb-2">
            <div class="p-1 bd-highlight">
               {{$r->service_seeker_profile->first.' '.$r->service_seeker_profile->last}}
            </div>
            <div class="p-1 ml-auto bd-highlight">
               @for($i=0;$i<intval($r->service_seeker_rating);$i++)
               <i class="fas fa-star text-warning"></i> 
               @endfor
            </div>
         </div>
         </span>
         <i class="text-muted">{{$r->service_seeker_comment}}</i>
         </span>
          
      </div>
      @endforeach   
   </div>
</div>
<script>
   $.fn.clicktoggle = function(a, b) {
       return this.each(function() {
           var clicked = false;
           $(this).click(function() {
               if (clicked) {
                   clicked = false;
                   return b.apply(this, arguments);
               }
               clicked = true;
               return a.apply(this, arguments);
           });
       });
   };
   
   $(".more").clicktoggle(function() {
     $(this).text("Less").siblings(".complete").show();
   }, function() {
     $(this).text("More").siblings(".complete").hide();
   });
</script>