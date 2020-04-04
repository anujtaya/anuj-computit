@extends('layouts.service_seeker_master')
@section('content')
<script src="{{asset('js/service_seeker/service_seeker_conversation.js')}}?v={{rand(1,100)}}"></script>

<div class="container ">
   <div class="row  justify-content-center" >
      <div class="col-lg-12 shadow-sm sticky-top bg-white p-3 border-d">
         <div class="row">
            <div class="col-2">
                <a href="{{route('service_seeker_job',$job->id)}}" onclick="toggle_animation(true);"><i class="fas fa-arrow-left fs-1" style="color:#399BDB!important"></i> </a>
            </div>
            <div class="col-8 font-size-bolder text-center font-weight-bold theme-color">{{Auth::user()->first}} {{Auth::user()->last}} <br><span class="fs--2 text-muted font-weight-normal"> Active Conversation</span> </div>
            <div class="col-2 text-right">
              <a href="{{url('/jobs/service_provider/profile/1')}}"> <img src="https://i.pravatar.cc/{{rand(300,400)}}" height="30" style="border-radius:50%;" width="30" alt=""> </a>
            </div>
            @if($job->status == 'OPEN')
              <button type="button" class="btn btn-danger" style="color: white!important; width: 50%;" data-target="#jobConversationRejectOfferModal" data-toggle="modal">Reject Offer</button>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#jobConversationAcceptOfferModal" style="color: white!important; width: 50%">Accept Offer</button>
            @endif
         </div>
      </div>
      <div class="col-lg-12  mt-2  p-0" >
         @include('service_seeker.jobs.job_conversation_partial')
      </div>
   </div>
</div>

@include('service_seeker.jobs.modals.job_conversation_accept_offer_action_modal')
@include('service_seeker.jobs.modals.job_conversation_reject_offer_action_modal')

@endsection
