<ul id="service_seeker_job_filter_offer_ul" class="list-group">
   @foreach($conversations as $conversation)
   <li class="list-group-item m-1 card-1 fs--1 border-0" onclick="location.href= '{{route('service_seeker_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}';toggle_animation(true);" >
      <div class="d-flex bd-highlight mb-2">
         <div class="p-0 mt-1 bd-highlight">
            <img src="{{url('/')}}/storage/images/profile/{{$conversation->service_provider_profile->profile_image_path}}"
              onerror="this.src='data:image/png;base64,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'" 
              class="shadow-sm" id="trigger_image" height="40" width="40" style="border-radius:50%;" alt="">
         </div>
         <div class="p-2 bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">{{$conversation->service_provider_profile->first}} {{$conversation->service_provider_profile->last}}</span> <br>
            <span class=""> @if($conversation->service_provider_profile_rating != null) {{number_format($conversation->service_provider_profile->rating,2)}} @else 5.00 @endif <i class="fas fa-star fs--2 text-warning"></i> </span>
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <span class="text-success fs-1"><span class="fs--1">$</span>{{number_format($conversation->json['offer'],2)}}</span> <br>
         </div>
      </div>
      <div class="text-muted bg-light p-2 mb-1 fs--2 rounded">
         <i>{{$conversation->json['offer_description']}}</i>
      </div>
      <span class="text-muted font-weight-normal fs--2 p-1">{{count($conversation->conversation_messages)}} messages</span>
   </li>
   @endforeach
   @if(count($conversations) == 0)
   <style>
      .loader {
      display: inline-block;
      width: 30px;
      height: 30px;
      position: relative;
      border: 4px solid #399bdb4d;
      top: 50%;
      animation: loader 2s infinite ease;
      }
      .loader-inner {
      vertical-align: top;
      display: inline-block;
      width: 100%;
      background-color: #fff;
      animation: loader-inner 2s infinite ease-in;
      }
      @keyframes loader {
      0% {
      transform: rotate(0deg);
      }
      25% {
      transform: rotate(180deg);
      }
      50% {
      transform: rotate(180deg);
      }
      75% {
      transform: rotate(360deg);
      }
      100% {
      transform: rotate(360deg);
      }
      }
      @keyframes loader-inner {
      0% {
      height: 0%;
      }
      25% {
      height: 0%;
      }
      50% {
      height: 100%;
      }
      75% {
      height: 100%;
      }
      100% {
      height: 0%;
      }
      }
   </style>
   <div class="text-center">
   		<img src="{{asset('images/svg/l2l_waiting.svg')}}" alt="" style="opacity:0.4;"  width="250px" class="img-fluid" alt="Responsive image">
		<br><br>
		<p class="fs--1">We are waiting for Service Providers to respond with price quote. We let you know when the quotes are available.</p>
		<br>
      	<!-- <span class="loader"><span class="loader-inner"></span></span> -->
         <img src="{{secure_url('/images/brand/l2l-logo-svg.svg')}}" class="fa-spin spin" height="50" width="50">
   </div>
   @endif
</ul>