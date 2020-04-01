<div class="pl-3 pr-3">
   <div class="form-group">
      <label for="">Add Images</label>
      <div class="custom-file">
         <input type="file" class="custom-file-input" id="validatedCustomFile" required>
         <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
         <div class="invalid-feedback">Example invalid custom file feedback</div>
      </div>
   </div>

   
  <div class="row m-0">
      @for($i=0;$i<25;$i++)
     <div class="p-0 col-4 text-center bd-highlight"  data-toggle="modal" data-target="#imagePreviewModal">
     <img src="https://picsum.photos/200/200" class=" pb-0 ml-1 mt-1 float-center" height="115px;" width="115px" alt="">

     </div>
     @endfor
  </div>

  
</div>

<!-- Modal -->
<div class="modal bg-white fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <div class="modal-header border-0">
        <h5 class="modal-title border-0 fs-1" id="imagePreviewCenterModalTitle">Image Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-2">
      <img src="https://picsum.photos/1200/1500" class="img-fluid mt-4" " alt="">
      
   
      </div>
      
    </div>
  </div>
</div>