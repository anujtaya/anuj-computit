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
               <img  src="{{url('/')}}/storage/images/profile/{{Auth::user()->profile_image_path}}" onerror="this.src='{{secure_url('/images/image-default.png')}}'" class="w3-round p-2 mb-2 w3-center" width="100px" height="100px"/>
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