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
     <div class="p-0 col-4 text-center bd-highlight">
        <img src="https://picsum.photos/200/300" class=" pb-0 ml-1 mt-1 float-center" height="118px;" width="118px" alt="">111
     </div>
     @endfor
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="imagePreviewModal" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imagePreviewCenterModalTitle">Image Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-2">
        <div class="m-2">
          <img src="https://lithub.com/wp-content/uploads/2019/07/used-books-store-2.jpg" class="img-fluid"  height="150px" alt="">
        </div>
      </div>
    </div>
  </div>
</div>