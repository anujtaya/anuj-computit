<style>
.switch {
  display: inline-block;
  height: 28px!important;
  position: relative;
  width: 55px!important;
}

.switch input {
  display:none;
}

.slider {
  background-color: #ccc;
  bottom: 0;
  cursor: pointer;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  transition: .4s;
}

.slider:before {
  background-color: #fff;
  bottom: 4px;
  content: "";
  height: 20px;
  left: 4px;
  position: absolute;
  transition: .4s;
  width: 20px;
}

input:checked + .slider {
  background-color: #5d29ba7a!important;
}

input:checked + .slider:before {
  transform: translateX(26px);
}

.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="row m-2">
   <div class="col-12 fs--1 p-2 ">
   <form method="POST" action="{{ route('service_provider_profile_business_update') }}" id="business_info_form" onsubmit="toggle_animation(true);">
   @csrf
   <div class="form-group  mt-3 row">
      <div class="col-md-12 mb-3">
         <label for="business_name">Business Name</label>
         <input id="business_name" type="text" class="form-control form-control-sm  @error('business_name') is-invalid @enderror" name="business_name" value="{{ $current_business_info->business_name }}" required autocomplete="business_name"  autofocus>
         @error('business_name')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 mb-3">
         <label for="business_email">Business Email</label>
         <input id="business_email" type="email" class="form-control  form-control-sm @error('business_email') is-invalid @enderror" name="business_email" value="{{ $current_business_info->business_email }}"  required autocomplete="business_email"  autofocus>
         @error('business_email')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      {{--
      <div class="col-md-12 mb-4">
         <label for="business_address">Business Address</label>
         <input id="business_address" type="text" class="form-control   form-control-sm @error('business_address') is-invalid @enderror" placeholder="Optional" name="business_address" value="{{ $current_business_info->business_address }}" autocomplete="business_address"  autofocus>
         @error('business_address')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      --}}
      <div class="col-md-12 mb-4">
         <label for="business_abn">Business ABN</label>
         <input id="business_abn" type="number" class="form-control   form-control-sm @error('business_abn') is-invalid @enderror" placeholder="Optional" name="business_abn" value="{{ $current_business_info->abn }}"   autocomplete="business_abn">
         @error('business_abn')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 mb-2">
         <label for="business_gst">Are you registered for GST?</label>
         <br>
         <label class="switch" for="checkbox">
            <input type="checkbox" id="checkbox" name="business_gst" @if($current_business_info->gst_enabled)  checked @endif  >
            <div class="slider round"></div>
         </label>
      </div>
      <div class="col-md-12 mb-2">
         <button type="submit" class="btn theme-background-color btn-sm fs--1 font-weight-normal card-1">Save Changes</button>
      </div>
   </div>
</form>
   </div>
</div>
