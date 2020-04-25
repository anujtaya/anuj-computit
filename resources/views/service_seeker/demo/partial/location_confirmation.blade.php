<div class="col-12 fs--1 p-2 p-3" >
   <div class="form-group">
      <label class="" for="service_location_line_1">Confirm Location</label>
      <!-- <input type="text" class="form-control form-control-sm" onkeyup="initAutocomplete()"  id="service_location_full_address" placeholder="Start typing your address here"> -->
      <div class="form-group">
         <label class="text-muted" for="feInputAddress">Line 1</label>
         <input type="text" class="form-control form-control-sm" id="street_number" placeholder="Start typing your address here"  name="user_street_number" value="{{old('user_street_number')}}" onFocus="initAutocomplete()" data-dpmaxz-eid="10" required autocomplete="off">
      </div>
      <div class="form-group col-md-3">
         <label for="feInputAddress"></label>
         <input type="text" class="form-control form-control-sm" id="route"   name="user_street_name" value=""   data-dpmaxz-eid="10" hidden>
      </div>
      <div class="form-group">
         <label class="text-muted" for="feInputCity">Suburb</label>
         <input type="text" class="form-control form-control-sm" id="locality"  name="user_city" data-dpmaxz-eid="11" value="{{old('user_city')}}"  required>
      </div>
      <div class="form-row">
        <div class="form-group col">
         <label class="text-muted" for="feInputState">State</label>
         <input type="text" class="form-control form-control-sm" id="administrative_area_level_1"  name="user_state" value="{{old('user_state')}}"   data-dpmaxz-eid="10" required>
       </div>
       <div class="form-group col">
         <label class="text-muted" for="inputZip">Post Code</label>
         <input type="number" class="form-control form-control-sm" id="postal_code"  name="user_postcode" data-dpmaxz-eid="13" value="{{old('user_postcode')}}"   required>
       </div>
      </div>
      <div class="form-group col-md-3">

      </div>
   </div>
</div>
