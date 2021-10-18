<div class="">

   <div class="form-group">
      <label class="" for="service_location_line_1">Confirm Location</label>
      <div class="form-group">
         <input type="text" class="form-control form-control-sm" id="street_number"
            placeholder="Start typing your address here" name="user_street_number" value="{{old('user_street_number')}}"
            onFocus="initAutocomplete()" data-dpmaxz-eid="10" required autocomplete="off">
      </div>
   </div>
</div>
<div class="">
   <div id="map" style="width: 100%; height: 295px!important; position: s;">
   </div>
   <p class="fs--2 mt-3">Drag and drop the marker for precise location:</p>
</div>