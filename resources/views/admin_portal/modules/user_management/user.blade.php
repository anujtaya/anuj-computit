@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal User Managment -  Edit User')
@section('content')
<div class="row m-2">
<div class="col-lg-6  p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            User information | ID:{{$user->id}}
         </div>
         <div class="card-body">
            <div class="w3-card w3-round-large m-2">
               <span>
               <img  src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/{{$user->profile_image_path}}" onerror="this.src='data:image/png;base64,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'" class="w3-round p-2 mb-2 w3-center" width="100px" height="100px"/>
               </span>
               <span ><a href="mailto:{{$user->email}}"  class="w3-xlarge" target="_top">{{$user->email}}</a></span>
            </div>
            <table class="table table-bordered table-sm table-hover">
               <tr>
                  <td><strong>Account Status</strong></td>
                  <td>
                     <?php if($user->status == 0)
                        {echo("<span class='badge badge-danger rounded-0 p-1' >Not Active</span>");}
                        else if($user->status == 1)
                        {echo("<span class='badge badge-success rounded-0 p-1' >Active</span>");}
                        else if($user->status == 2){echo("<span class='badge badge-warning rounded-0 p-1' >Suspended</span>");}else {echo("NA");}?>
                  </td>
               </tr>
               <tr>
                  <td><strong>Verification Status</strong></td>
                  <td>
                     @if($user->is_verified == 0)
                     <span class='badge badge-danger rounded-0 p-1' >Not-verified</span>
                     @elseif($user->is_verified == 1)
                     <span class='badge badge-success rounded-0 p-1' >Verified</span>
                     @endif
                  </td>
               </tr>
               <tr>
                  <td><strong>Account created on</strong></td>
                  <td>
                     {{date('d/m/Y h:iA', strtotime($user->created_at))}}
                  </td>
               </tr>
               <tr>
                  <td><strong>Last profile update</strong></td>
                  <td>
                     {{date('d/m/Y h:iA', strtotime($user->updated_at))}}
                  </td>
               </tr>
               <tr>
                  <td><strong>Primary Email</strong></td>
                  <td>
                     {{$user->email}}
                  </td>
               </tr>
               <tr>
                  <td><strong>Contact No.</strong></td>
                  <td>
                     {{$user->phone}}
                  </td>
               </tr>
               <tr>
                  <td><strong>Change Acc. Status</strong></td>
                  <td>
                     <form action="{{route('app_portal_admin_users_update_user_account_status')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$user->id}}" name="user_id" required>
                        <select class="form-control form-control-sm rounded-0" name="user_profile_account_status"  id="sel1" onchange="this.form.submit();" required>
                            <option value="" disabled selected>Select One.</option>
                            <option value="0">Not Active</option>
                            <option value="1">Active</option>
                            <option value="2">Suspended</option>
                        </select>
                     </form>
                  </td>
               </tr>
               <tr>
                  <td><strong>Change Online/Offline Status</strong></td>
                  <td>
                    <form action="{{route('app_portal_admin_users_update_user_online_status')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$user->id}}" name="user_id" required>
                        <select class="form-control form-control-sm rounded-0" name="user_profile_online_status"  id="sel1" onchange="this.form.submit();" required>
                           <option value="1" @if($user->is_online == 1)  selected @endif >Online</option>
                           <option value="0" @if($user->is_online == 0)  selected @endif>Offline</option>
                        </select>
                     </form>
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </div>
   <div class="col-lg-6  p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Update Profile
         </div>
         <div class="card-body">
            <form  action="{{route('app_portal_admin_users_update_user_profile_info')}}" method="post"  files="true" enctype="multipart/form-user">
               {{csrf_field()}}
               <input type="hidden" class="form-control form-control-sm  rounded-0" name="id"  value="{{$user->id}}"/>
               <div class="form-row">
                  <div class="form-group col-md-4">
                     <label>First Name</label>
                     <input type="text" class="form-control form-control-sm rounded-0" name="first" value="{{$user->first}}"/>
                  </div>
                  <div class="form-group col-md-4">
                     <label>Last Name</label>
                     <input type="text" class="form-control form-control-sm rounded-0" name="last"  value="{{$user->last}}"/>
                  </div>
                  <div class="form-group col-md-4">   <label>Email</label>
                     <input type="email" class="form-control form-control-sm rounded-0" name="email"  value="{{$user->email}}" readonly/>
                  </div>
                  <div class="form-group col-md-4">
                     <label>Phone</label>
                     <input type="number" class="form-control form-control-sm rounded-0" name="phone"  value="{{$user->phone}}" />
                  </div>
                  <div class="form-group col-md-4">
                     <label>Job Radius</label>
                     <input type="number" class="form-control form-control-sm rounded-0" name="work_radius" style="width:100%!important" value="{{$user->work_radius}}"/>
                  </div>
                  <div class="form-group col-md-4">
                     <label>Car Rego</label>
                     <input type="text" class="form-control form-control-sm rounded-0" name="car_rego" style="width:100%!important; text-transform:uppercase" value="{{$user->car_rego}}"/>
                  </div>
               </div>
               <button type="submit" class="btn btn-primary btn-sm mt-3 rounded-0">Update Profile</button>
            </form>
         </div>
      </div>
   </div>
   <div class="col-lg-4 p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Account Actions
         </div>
         <div class="card-body">
            <div class="m-1 bg-light">
               <span>Email Notification: </span><br>
               <a href="{{route('app_portal_admin_users_update_user_send_welcome_email', $user->id)}}">Send Welcome Email</a>
            </div><br>
            <div class="m-1 bg-light">
               <span>Mobile Push Notification: </span><br>
               @if($user->push_notification_token != null)
               <br>
               <span>Use the form below to test push notification on user device.</span><br>
               <form action="{{route('app_portal_admin_users_send_user_mobile_test_notification')}}" method="POST">
                     @csrf
                     <input type="hidden" name="user_id" value="{{$user->id}}" required>
                     <div class="form-row">
                        <div class="form-group col-md-12">
                           <label>Notification Title</label>
                           <input type="text" class="form-control form-control-sm rounded-0" name="title" value="Test Notification Title" required>
                        </div>
                        <div class="form-group col-md-12">
                           <label>Notification Body Message</label>
                           <textarea type="text" class="form-control form-control-sm rounded-0" name="body" required>Test Notification Body</textarea>
                        </div>
                     </div>
                  <button type="submit" class="btn btn-primary btn-sm mt-3 rounded-0">Test Notification</button>
               </form>
               @else
               <span class="text-danger">This user doesn't have push notification enabled. Please download LocaL2LocaL app on user device to set-up the push notification service.</span>
               @endif
            </div>
         </div>
      </div>
   </div>

   <div class="col-lg-4 p-3">
      <div class="card  h-100 bg-white">
         <div class="card-header">
            User Bio
         </div>
         <div class="card-body">
            @if($user->user_bio != null)
            <i>"
            {{$user->user_bio}}
            "</i>
            @else
            No information provided by the user.
            @endif
         </div>
      </div>
   </div>


   <div class="col-lg-4 p-3">
      <div class="card  h-100 bg-white">
         <div class="card-header">
            Banking
         </div>
         <div class="card-body">
            <table class="table table-bordered table-sm table-hover">
               <tr>
                  <td><strong>Credit/Debit Card</strong></td>
                  <td id="ucc">
                     @if($user->service_seeker_stripe_payment != null)
                           <span class="badge badge-success rounded-0 p-2">Setup Completed</span>
                     @else
                     <span class="badge badge-danger rounded-0 p-2">Not Provided</span>
                     @endif
                  </td>
               </tr>
               <tr>
                  <td><strong>Bank Account</strong></td>
                  <td id="ub">
                     @if($user->service_provider_payment != null)
                           <span class="badge badge-success rounded-0 p-2">Setup Completed</span>
                     @else
                     <span class="badge badge-danger rounded-0 p-2">Not Provided</span>
                     @endif
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </div>
  
</div>
@endsection