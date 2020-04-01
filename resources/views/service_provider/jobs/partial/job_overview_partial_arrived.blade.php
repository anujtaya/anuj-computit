<div class="fs--1">
   <div class="mt-3 border-0  rounded shadow-sm-none" >
      <div class="d-flex bd-highlight">
         <div class="p-q bd-highlight">
            <span class="theme-color" style="font-size: 0.8rem;">Job Total</span>  <br>
            <span class="text-success fs-1">${{$conversation->json['offer']}}</span>
         </div>
         <div class="ml-auto p-2 bd-highlight">
            <a href="{{route('service_provider_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}" class="fs--1 btn btn-sm btn-white theme-color card-1" onclick="toggle_animation(true);"><i class="fas fa-comments-dollar"></i> Messages</a>
         </div>
      </div>
   </div>
   <div class="text-center p-3">
      <img src="{{asset('images/svg/l2l_vault.svg')}}" alt="" style="opacity:0.4;"  width="150px" class="img-fluid" alt="Responsive image">
      <br>
      <br>
      <p class="fs--1">Please enter the pin code in the input field given below. Please ask for PIN code from Service Seeker.</p>
      <form action="{{route('service_provider_job_update_status_mark_started')}}" class="text-center" method="POST" onsubmit="toggle_animation(true);">
         @csrf
         <!-- <label for="pin_code_input">Enter PIN Code Below</label> -->
         <input type="hidden" value="{{$job->id}}" name="job_id" required>
         <input type="text" name="pin_code_input"
         maxlength="4" minlength="4"
         onkeypress='return event.charCode >= 48 && event.charCode <= 57'    
         required  placeholder="----" style="text-align:center;"  class="form-control form-control-lg-b rounded-0 @error('pin_code_input') is-invalid @enderror"> 
         @error('pin_code_input')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
         @enderror
         <br> <br>
         <button class="btn btn-sm text-success border-0 card-1  fs--1 bg-white  delay-2s mr-2" type="submit">Start Trip <i class="fas fa-arrow-right fs--2"></i></button>
      </form>
   </div>
</div>