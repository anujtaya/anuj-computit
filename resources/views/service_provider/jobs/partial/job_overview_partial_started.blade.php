
<style>
   .modal-backdrop {
   position:;
   top: 0;
   right: 0;
   bottom: 0;
   left: 0;
   z-index: 1999;
   background-color:transparent;
   }
   .fade {
      transition: opacity .15s linear;
   }
   .modal {
      z-index:2000!important;
   }

</style>
<div class="fs--1">
   <div class="mt-3 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">Job Total</span>  <br>
            <span class="text-success fs-1">${{number_format($job_price,2)}}</span>
         </div>
         <div class="ml-auto p-0 bd-highlight">
            <button type="button"  class="btn btn-sm theme-background-color border-0 fs--1 card-1" data-toggle="modal" data-target="#add_extra_job_modal">
            <i class="fas fa-plus fs--2"></i> Add Extra
            </button>
            <a href="{{route('service_provider_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}"  class="btn btn-sm theme-background-color border-0 fs--1 card-1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   <div class="p-0 mt-2">
      <div class="mt-3 border-0  rounded shadow-sm-none" >
         <form action="{{route('service_provider_job_update_status_mark_completed')}}" id="complete_job_form" onsubmit="toggle_animation(true);" method="POST">
            @csrf
            <input type="hidden" value="{{$job->id}}" name="started_job_id" required>
            <a class="btn btn-sm theme-background-color border-0 fs--1 card-1 btn-block" data-toggle="modal" data-target="#complete_job_confirm_modal" onclick=" $('#complete_job_confirm_modal').modal('show');"><i class="fas fa-check-double fs--2"></i> Complete Job</a>
         </form>
      </div>
      <ul class="list-group fs--1 border-light border" style="overflow:scroll; height:440px;">
         @foreach($job_extras as $extra)
            <li class="list-group-item mb-1-0  border" style="border-style:dashed!important;">
               <div class="d-flex bd-highlight">
                  <div class="pb-2 w-100 bd-highlight theme-color">
                     {{$extra->quantity}} ×  {{$extra->name}}
                  </div>
                  <div class="pb-2 ml-auto">${{number_format(($extra->quantity * $extra->price),2)}}</div>
               </div>
               <div class="d-flex bd-highlight fs--2">
                  <div class="pb-2 bd-highlight">{{$extra->description}}</div>
                  <div class="pb-2 ml-auto">
                     <a href="{{route('app_services_job_extra_remove', $extra->id)}}" class="text-danger" onclick="toggle_animation(true)">Remove</a>
                  </div>
               </div>
            </li>
         @endforeach
      </ul>
   </div>
</div>
<!-- start add extra to job Modal -->
<div class="modal fade" id="add_extra_job_modal" tabindex="-1" role="dialog" aria-labelledby="add_extra_job_modal_label" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content border-0 card-1">
         <div class="modal-header">
         <span class="modal-title fs--1" id="exampleModalLabel">Add Extra</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form action="{{route('app_services_job_extra_add')}}" method="POST" onsubmit="toggle_animation(true);">
               @csrf
               <input type="hidden" name="extra_job_id" value="{{$job->id}}" required>
               <div class="form-group">
                  <label for="extra_name">Name</label>
                  <input type="text" minlength="3" class="form-control form-control-sm" id="extra_name" name="extra_name"  placeholder="" value="" required>
               </div>
               <div class="form-group">
                  <label for="extra_quantity">Quantity</label>
                  <input type="number" minlength="1"  class="form-control form-control-sm" id="extra_quantity" name="extra_quantity"  value="" placeholder="" required>
               </div>
               <div class="form-group">
                  <label for="extra_price">Unit Price</label>
                  <input type="number"   class="form-control form-control-sm" id="extra_price" name="extra_price"  step="0.01" value="" min="1" max="2000" placeholder="" required>
               </div>
               <div class="form-group">
                  <label for="extra_description">Description <small>(Optional)</small></label>
                  <textarea class="form-control form-control-sm" id="extra_description" rows="3" name="extra_description">Sample Description {{rand(1,100)}}</textarea>
               </div>
               <button class="btn btn-success btn-sm text-white card-1 btn-block"><i class="fas fa-check-double fs--2"></i> Submit</button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- end add extra to job modal  -->
<!-- job complete confirmation modal -->
<div class="modal fade" id="complete_job_confirm_modal" tabindex="-1" role="dialog" aria-labelledby="complete_job_confirm_modal_label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0 card-1">
      <div class="modal-header">
        <span class="modal-title fs--1" id="exampleModalLabel">Are you sure?</span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
         <p>If you click 'YES' the job will be marked completed and the job total amount will be charged from the Service Seeker's account.</p>
         <br>
        <button class="btn btn-sm theme-background-color card-1 mr-3" onclick="$('#complete_job_form').submit();">Yes</button>
        <button class="btn btn-sm btn-danger text-white card-1" data-dismiss="modal" aria-label="Close">No</button>
      </div>
    </div>
  </div>
</div>
<!-- end job comlete confirmation modal  -->
<script>
   var app_url_job_update_completed ="{{route('service_provider_job_update_status_cancelontrip')}}";
   var CSRF_TOKEN = "{{csrf_token()}}";
</script>