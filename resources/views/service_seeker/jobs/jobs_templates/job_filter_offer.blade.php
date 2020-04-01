<ul id="service_seeker_job_filter_offer_ul" class="list-group">
 @foreach($conversations as $conversation)
 <li class="list-group-item m-1 border shadow-sm fs--1 animated" onclick="location.href= '{{route('service_seeker_job_conversation', [$conversation->job_id, $conversation->service_provider_id, 'JFO'])}}';toggle_animation(true);" >
	<div class="d-flex bd-highlight mb-2">
	   <div class="p-0 mt-1 bd-highlight">
		  <img src="https://i.pravatar.cc/{{rand(300,400)}}" height="45" style="border-radius:50%;" class="mr-2 border" width="45" alt="">
	   </div>
	   {{-- Conversation name --}}
	   <div class="p-1 bd-highlight">
		  <span class="theme-color" style="font-size: 0.9rem;">{{$conversation->first}} {{$conversation->last}}</span> <br>
		  <span class="text-warning"><i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i>  <i class="fas fa-star-half-alt"></i> </span>
	   </div>

	   {{-- Conversation price --}}
	   <div class="ml-auto p-0 bd-highlight">
		  <span class="text-success fs-2">${{$conversation->json['offer']}}</span> <br>
	   </div>
	</div>

	{{-- Conversation offer description --}}
	<div class="text-muted bg-light p-2 mb-1 rounded">
	   {{$conversation->json['offer_description']}}
	</div>
	<!-- <span class="text-muted font-weight-normal fs--1 p-1">0 Replies</span> -->
 </li>
 @endforeach
</ul>
