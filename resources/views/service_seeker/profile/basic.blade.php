<div class="m-1">
   <div class="alert" id="message" style="display: none"></div>
   <form method="post" id="upload_form" style="display:none" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="file" name="file" id="file" onchange="$('#upload_form').submit();" accept="image/*" />
   </form>
   <br>
   @if(Session::has('status'))
      <div class="fs--1 ml-2 border-0 card-1 mr-2 alert alert-info">{{Session::pull('status')}}</div>
   @endif
   <div class="d-flex theme-background-color-n bg-white rounded   bd-highlight ml-2 mr-2 mt-1 shadow-sm">
      <div class="p-3 bd-highlight" id="image_container">
         <img src="{{url('/')}}/storage/images/profile/{{Auth::user()->profile_image_path}}" class="border-white card-1" id="trigger_image" height="60" width="60"  style="border-radius:50%;" alt="User profile image" onerror="this.src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMQAAADECAMAAAD3eH5ZAAAAYFBMVEVmZmb///9jY2NdXV1gYGBaWlpVVVX29vZ2dnaCgoKkpKTi4uJUVFSVlZXf399tbW3y8vKzs7Obm5uIiIjY2Njs7Oy/v7/Kysrt7e24uLjV1dV6enpubm7ExMSRkZGLi4sh2BX/AAAGEUlEQVR4nO2c6YKqOgyAIV0ANxwFFXX0/d/yoJBS5uhIa2177s331y2haZI2iUlCEARBEARBEARBEARBEARBEARBEARBEAThEeBMCHlHCMYhtDzGABcs38521TxrmVe72TZn4p9SBAQUzTxLR2TzXdG+EFq2iXCZNOv0IesmkTy0fBOARVE91qCjKhaxrwaI/PibCjeOedxGBezrlQo3vljEWrCknqJDmtbtW+MExHIs6mq3KUq5WMiy2OxW49eWcZrUD1OqNq1WfYi7hT1INqMNH6VJgdhpIjYnwWAkJQATp0Z7yy6+tQChrcO+fCwgiHKvrUV0WojhIdcn+VQ6kKdh7zfCp4SvETMl2jf7NSZzNpjdLCoteKEJ9sJIQFO4iCgHAaHEukx4uOKi3h7RthBqu+aTDETkygVEY1Bsq0LYxEDMVFjcRhK6AdDhfE1+rsoh1xCHQbFNL1A13cJBYPjeRLEUwPAIlxg8VEj6D2VRpB9qIcyeqeXHPoScd8KsDR2N6I+wtfyMXCZAaeiZEOWhyvD2xBq7hRiWogluTwC9Nc2MRWF9+jEP7mWVNeXGkkAeiz2hk1lZ2ARbReKfMG36slHiK5IECp+mTVKNCfw88EpAeTCP1urDfdQ+BN4UkHc5R22nRJc5ZuZOwSn81D3Mo9URjfdXnqewBzzeHyX2VmbNeq+wDazEtRNjZ+Vg8KrqGsdKvKcErcT7/Df2RO+dKjvvVEXhnTBOHOzixCGKOOEkYteh01ixsjdr3FA2GbBTxHefxVq4J7x8+g6dxfL+pDw37xYA3h8Kl6GvldX9kbmHQc9mtZ+cAtBvCvOKCdZlVsHP2Op4lpnaE/D+5tDmUOgYZU+mJ2V1BRjcmlokVqjNCiaqMLOK4AZQ+SdDs1BV7+C+6Y7A8kRuIA7HS6c6dJDoUJeqBrFCxQjjK9xPgdc26X6yeUus8gVPORAVtSYnH0P7QeAsXGNoTZlSAdZrwBHECASkalrcPG+JGN6NESLNXr/bH/yMYr1untHbcc7RGNMNNjQJrJLfSonAkqF96xKPMd3RGjay5fMWFc6WQ7tsXP0pNzQt0ip/3P3KZa51n8WnQ+v6NS3S41X8aKoGLsRVbzedxZAz/QUb9TGum6K897m33Drfy2LcthxLpP4JK8bt4Yeq2Wzzssy3m6Y6jF7Kikh1aLXgPxpHn7Hi0epwaxS/PGl1H1naJep2ceCL/OViVGXUOnBeHLNXOrR7pTn/3uwYELa4TtwSbdL+JJIEhsvlhO2gGVUeU/J3B9jpwSpk63petczr9QMr25VxuSjO/5qbqL+XRV4Cl0JIDue82Ox/ziWsl1F0nfWI89iSst21lF207t7QRW15Xu7HauxFLDtDbzm+m8lp8WQYrc2f5HWsRxFHFghcF6ueJa96xfNG3yAv27J9MFy+3Oxok7yWCcRZn6NowmvBE207NDBtp8LoXLEPrQXLB9Oonox+PILLi/bBsE6KazoYDqYwGE5Ix5BaDM3JaXY1NQp9kOoYLnqDUFH6YBF9QVy1ZfyAfJPAymmazu3SuWGOIt0E0mKIcdY2zYZQH+a8Olwjr+yHxQfvdghSflxgPreGNxIgpkaq9gt3sk3+deVb3tGhNUqlxdW7Qaly1du/rWoVa+9lVOy3Spu3L/LUZI5vP6umA+v3/wFiqAt47nvC8RWjiukzVF1ges3PBdi/6GiAgx1DLIXqInCTuSmD8tm/ryY/XG1FVRH2mM6yPmky7qx5BuBS+KumQpK5XYhhlsTfFCdHb+JuHyqX7W1CGy346HAbst5n2/VrmwOYP7vsjsZamVWXsAXYzpq5/D3l8DzZkxrKcupJcKrFfOjQCvmR8Ticf6y8pB6qc9Gt9Sp78rKz0Rtmjk9iC5+bAhsXXTrYG3isuPhQAve16wzhU9/7EMwQXLeCYrOvlx5++ca06W+oaQovSmSuE6cOHM9e+/CxqITr/ABdd+ZDid4VZs73H16x+7hEQyWc/9bCoxIyvf1nZ3ZwvurycP/i1Eve0f176gd+6mNfTBAEQRAEQRAEQRAEQRAEQRAEQRAEQRDE/5E/uag0Dy41gk8AAAAASUVORK5CYII='"  >
      </div>
      <div class="p-4 bd-highlight">
         <span class="font-weight-bold">{{Auth::user()->first}} {{Auth::user()->last}}</span> <br>
         <span class="fs--1 ">{{Auth::user()->email}}</span> <br>
       {{--  @if(Auth::user()->is_verified)
            <span class="badge border-0 card-1 text-success mt-1 p-2" style="border-radius:20px!important;"><i class="far fa-check-circle"></i> Verified</span>
         @endif
         --}}
      </div>
   </div>
   <div class="row m-1" style="overflow:scroll; height:630px;" >
      <div class="col-12 fs--1 p-2 " >
         <form action="{{route('app_user_update_account_information')}}" method="POST" onsubmit="toggle_animation(true);">
            @csrf
            <div class="form-group">
               <label for="user_first_name">First Name</label>
               <input type="text" class="form-control form-control-sm"  id="user_first_name" name="user_first_name" value="{{Auth::user()->first}}">
               @error('user_first_name')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group">
               <label for="user_last_name">Last Name</label>
               <input type="text" class="form-control form-control-sm"  id="user_last_name" name="user_last_name" value="{{Auth::user()->last}}">
               @error('user_last_name')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group">
               <label for="user_phone">Mobile No.   @if(Auth::user()->is_verified) <span class="badge badge-success fs--2">Verified</span> @endif</label>
               <input type="tel" class="form-control form-control-sm"  id="user_phone" name="user_phone" value="{{Auth::user()->phone}}" required>
               @error('user_phone')
               <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
               </span>
               @enderror
            </div>
            <div class="form-group">
               <label for="user_email">Email</label>
               <input type="email" class="form-control form-control-sm"  id="user_email"  value="{{Auth::user()->email}}" readonly>
            </div>
            <div class="form-group">
               <button type="submit" class="btn theme-background-color btn-sm fs--1 font-weight-normal card-1">Save Changes</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script>
   var master_url = "{{route('service_seeker_profile')}}"; // needs to be changed later
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   //user profile image upload script
   var CSRF_TOKEN = "{{csrf_token()}}"
   $(document).ready(function(){
      $('#upload_form').on('submit', function(event){
         event.preventDefault();
         toggle_animation(true);
         $.ajax({
               url:"{{ route('imageservice_images_user_profile_image_upload') }}",
               method:"POST",
               data:new FormData(this),
               dataType:'JSON',
               contentType: false,
               cache: false,
               processData: false,
               success:function(data)
               { 
                  toggle_animation(false);
                  //console.log(data);
                  $('#message').css('display', 'block');
                  $('#message').html(data.message);
                  $('#message').addClass(data.class_name);
                  $('#image_container').html(data.uploaded_image);
                  //console.log(data.uploaded_image);
                  document.getElementById('trigger_image').onclick = function() {
                     document.getElementById('file').click();
                  };
               },
               error: function(xhr, status, error) {
                  toggle_animation(false);
               }
         })
      });
   });
   //prompt user to select a file from device
   document.getElementById('trigger_image').onclick = function() {
      document.getElementById('file').click();
   };
</script>