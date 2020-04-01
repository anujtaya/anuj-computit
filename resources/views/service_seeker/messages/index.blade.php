@extends('layouts.service_seeker_master')
@section('content')
<script src="{{asset('js/service_seeker/service_seeker_messages.js')}}?v={{rand(1,100)}}"></script>

<style>
   .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
   color: #fff!important;
   background-color: #2c7be5;
   }
</style>
<div>
        <div id="map" class="text-center " style="min-width:900px important; min-height:440px!important; position: relative;overflow: hidden;"></div>
</div>

<div class="mt-3" style="">
  <h5 style="text-align: center">
    Your Service Providers
    <a  id="job_filter_btn" class="theme-color bg-white text-muted" style="border-radius:20px;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-filter float-right pr-4"></i>
    </a>
    <div class="dropdown-menu border" aria-labelledby="dropdownMenuLink">
       <a class="dropdown-item theme-color" href="#"> Distance</a>
       <a class="dropdown-item theme-color" href="#"> Date</a>
       <a class="dropdown-item theme-color" href="#"> Rating</a>
    </div>
  </h5>
  @if(count($messages) > 0)
  <div style="overflow:scroll; min-height: 200px!important; max-height: 400px!important;">
    <ul id="service_seeker_messages_offer_ul" class="list-group" >
       @foreach($messages as $message)
       <li class="list-group-item m-1 fs--1 animated" style="border: none!important">
         <a id="service_seeker_messages_offer_a" href="#" data-toggle="modal" data-target="#serviceSeekerMessagesOfferModal"  data-messageofferId="{{$message->conversation_id}}" style="text-decoration: none;">
      	<div class="d-flex bd-highlight mb-2">
      	   <div class="p-0 mt-1 bd-highlight">
      		  <img src="https://i.pravatar.cc/{{rand(300,400)}}" height="70" width="70" style="border-radius:50%;" class="mr-2 border" alt="">
      	   </div>
      	   {{-- Conversation name --}}
      	   <div class="p-1 bd-highlight">
      		  <span class="theme-color" style="font-size: 0.9rem;">{{$message->first}} {{$message->last}}</span> <br>
      		  <span class="text-warning"><i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i>  <i class="fas fa-star-half-alt"></i> </span>
            <br><span>{{str_limit($message->messages->offer_description, 29, '...')}}</span>
      	   </div>
      	   {{-- Conversation price --}}
      	   <div class="ml-auto p-0 bd-highlight">
      		  <span class="fs-1">${{$message->messages->offer}}</span> <br>
      	   </div>
      	</div>
       </li>
     </a>
       @endforeach
    </ul>
  </div>
  @else
  <ul id="" class="list-group" style="overflow:scroll; height: 250px;">
    <span class="text-center p-4 m-4"><small class="text-muted">You don't have any offers!</small></span>
  </ul>
  @endif
@include('service_seeker.messages.modals.messagesJobOffersModal')






<!-- end service selector -->
@include('service_seeker.bottom_navigation_bar')

<script src="{{asset('/js/service_seeker/service_seeker_home_map.js')}}?v={{rand(1,100)}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU&libraries=places&callback=initMap" async defer></script>

<script>

$(document).ready(function(){
  $( "#service_seeker_messages_offer_a" ).click(function() {
    var conversation_id = $(this).attr('data-messageofferId');
    fetch_job_offer_message(conversation_id);
  });
});



</script>
@endsection
