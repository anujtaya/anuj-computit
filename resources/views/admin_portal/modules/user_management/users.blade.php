@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal User Managment')
@section('content')
<div class="row">
   <div class="col-lg-12 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header bg-secondary text-white">
            Search User
         </div>
         <div class="card-body">
            <form action="{{route('app_portal_admin_users_search')}}" method="POST">
               @csrf
               <div class="row">
                  <div class="col-6">
                     <label for="email">Email</label>
                     <input id="email" type="text" class="form-control" value="{{old('email')}}" name="email" placeholder="Enter email here">
                  </div>
                  <div class="col-6">
                     <label for="user_id">User ID</label>
                     <input id="user_id" type="number" class="form-control" value="{{old('user_id')}}" name="user_id" placeholder="Enter user id here">
                  </div>
               </div>
               <br>
               <button type="submit" class="btn btn-secondary card-1">Search</button>
               <a href="{{route('app_portal_admin_users_all')}}" class="btn btn-warning card-1">Reset Results</a>
            </form>
         </div>
      </div>
   </div>
   <div class="col-lg-12 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header bg-secondary text-white">
            All System Users
         </div>
         <div class="card-body">
            @if(count($users) > 0)
            <table class="table table-sm table-bordered table-hover" id="users-datatable">
               <thead class="bg-light">
                  <tr>
                     <th>ID</th>
                     <th>Status</th>
                     <th>First</th>
                     <th>Last</th>
                     <th>Email</th>
                     <th>Phone</th>
                     <th>Postcode</th>
                     <th>City/Locale</th>
                     <th>Registration Date</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($users as $user)
                  <tr>
                     <td>{{$user->id}}</td>
                     <td>
                        <?php if($user->status == 0)
                           {echo("<span class='badge badge-danger rounded-0 p-1' >Not Active</span>");}
                           else if($user->status == 1)
                           {echo("<span class='badge badge-success rounded-0 p-1' >Active</span>");}
                           else if($user->status == 2){echo("<span class='badge badge-warning rounded-0 p-1' >Suspended</span>");}else {echo("NA");}?>
                     </td>
                     <td>{{$user->first}}</td>
                     <td>{{$user->last}}</td>
                     <td>{{$user->email}}</td>
                     <td>{{$user->phone}}</td>
                     <td>{{$user->user_postcode}}</td>
                     <td>{{$user->user_city}}</td>
                     <td>{{ date('d/m/Y h:ia', strtotime($user->created_at)) }}</td>
                     <td>  </td>
                  </tr>
                  @endforeach
               </tbody>
               @if(request()->is('app/portal/admin/users/all'))
               {{ $users->links() }}
               @endif
            </table>
            @else
            <span class="text-danger">No Users Found.</span>
            @endif
         </div>
      </div>
   </div>
</div>
@endsection