<form method="POST" action="{{ route('service_provider_register_certificate_process') }}" onsubmit="toggle_animation(true);">
   @csrf
   <div class="form-group  mt-3 row">
      <div class="col-md-12 mb-2 text-centers">
      <h1 class="fs-1">Add Your Certificates</h1>
      </div>
      <div class="col-md-12 mb-3">
         <label for="name">Name</label>
         <input id="name" type="text" class="form-control form-control-sm  @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name"  autofocus>
         @error('name')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 mb-3">
         <label for="date">Expiry</label>
         <input id="date" type="date" class="form-control  form-control-sm @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date"  autofocus>
         @error('date')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 mb-4">
         <label for="guid">Unique ID</label>
         <input id="guid" type="text" class="form-control form-control-sm  @error('guid') is-invalid @enderror" name="guid" value="{{ old('guid') }}" required autocomplete="guid"  autofocus>
         @error('guid')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
         @enderror
      </div>
      <div class="col-md-12 text-centers mb-0">
         <button type="submit" class="btn theme-background-color fs--1 font-weight-normal mt-0 card-1"  id="" >
         <i class="fas fa-arrow-up"></i>  {{ __('Upload') }}
         </button>
      </div>
   </div>
</form>