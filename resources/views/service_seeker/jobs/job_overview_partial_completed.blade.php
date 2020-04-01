@push('header-script')
<script src="{{asset('/service_seeker_home.js')}}?v={{rand(1,100)}}"></script>
<script src="{{asset('/service_seeker_home_map.js')}}?v={{rand(1,100)}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
<link rel="stylesheet" href="http://localhost/laravel-testserver/public/css/third/flatpickr.min.css?v=12">
<script src="http://localhost/laravel-testserver/public/js/third/flatpickr.js"></script>
@endpush
<div class="pl-2 pr-3 fs--1">
   <li class="list-group-item m-1 border-0 shadow-sm rounded fs--1 animated" onclick="location.href= '{{route('service_seeker_job_conversation')}}';toggle_animation(true);" >
      <div class="d-flex bd-highlight mb-2">
         <div class="p-0 mt-1 bd-highlight">
            <img src="https://i.pravatar.cc/{{rand(300,400)}}" height="45" style="border-radius:50%;" class="mr-2 border" width="45" alt="">
         </div>

         <div class="p-1 bd-highlight">
            <span class="theme-color" style="font-size: 0.9rem;">John Doe</span> <br>
            <span class="text-warning"><i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i>  <i class="fas fa-star-half-alt"></i> </span>
         </div>
         <div class="ml-auto p-0 bd-highlight">
         </div>
      </div>
      <div class="text-muted bg-light p-2 mb-1 rounded">
         Happy to do the job for $50.
      </div>
      <span class="text-muted font-weight-normal fs--1 p-1">2 Replies (Archived Conversation)</span>
   </li>
   <div class="d-flex p-2  shadow-sm bd-highlight">
      <div class="p-2 flex-grow-1 bd-highlight">Total Amount Paid
         <br> <span class="fs--2">Source: MasterCard **3546</span> <br>
         <span class="fs--2">TRN: #{{rand(1000,3400)}}</span>  <br> <br>
         <span class="badge border theme-border-color shadow-sm theme-color rounded-pill p-2"><i class="fas fa-paper-plane"></i> Send Invoice</span>
         <span class="badge border border-danger shadow-sm text-danger rounded-pill p-2"><i class="far fa-question-circle"></i> Report Issue</span>
      </div>
      <div class="p-2 bd-highlight">    <span class="text-success fs-2">${{rand(11,55)}}</span>
      </div>
   </div>
   <div class="p-2 shadow-sm ">
      <div class="d-flex   bd-highlight">
         <div class="p-2 flex-grow-1 bd-highlight">You Rated
         </div>
         <div class="p-2 bd-highlight text-warning">    <i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i>  <i class="fas fa-star-half-alt"></i></span>
         </div>
      </div>
      <p class="fs--2 p-2 bg-light">Nice and friendly guy. Get things done in short time.</p>
   </div>
</div>
