@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal Reports - User Login Analytics')
@section('content')
<div class="row m-2">
   <div class="col-lg-12 p-0">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"> <a href="{{route('app_portal_admin_reports_all')}}">Reports/Analytics</a></li>
            <li class="breadcrumb-item active" aria-current="page">User Login Analytics</li>
         </ol>
      </nav>
   </div>
   <div class="col-lg-4 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header ">
            Login Today
         </div>
         <div class="card-body">
            <span class="display-4">{{$analytics->login_today}}</span>
            <br>
            @if($analytics->login_variation > 0)
            <span class="text-success"><i class="fas fa-arrow-up"></i> {{number_format($analytics->login_variation,2)}}% Boost</span>
            @elseif($analytics->login_variation < 0)
            <span class="text-danger"><i class="fas fa-arrow-down"></i> {{number_format($analytics->login_variation)}}% Loss</span>
            @endif
         </div>
      </div>
   </div>
   <div class="col-lg-4  p-1">
      <div class="card h-100 rounded-0  bg-white ">
         <div class="card-header ">
            Login Yesterday
         </div>
         <div class="card-body">
            <span class="display-4">{{$analytics->login_yesterday}}</span>
         </div>
      </div>
   </div>
   <div class="col-lg-4  p-1">
      <div class="card h-100 rounded-0  bg-white ">
         <div class="card-header ">
            Data Variation
         </div>
         <div class="card-body">
            <div class="wrapper">
               <canvas id="chart-area"></canvas>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="row m-2">
   <div class="col-lg-8 p-1">
      <div class="card h-100 rounded-0 bg-white ">
         <div class="card-header">
            All Reports List - User Login Analytics 
         </div>
         <div class="card-body">
            <table class="table  table-bordered table-hover" id="users-datatable">
               <thead class="bg-light">
                  <tr>
                     <th>User ID</th>
                     <th>Total Login Attempts</th>
                     <th>User Name</th>
                     <th>Last Login Time</th>
                     <th>Log Created At</th>
                     <th>Log Updated At</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($logs as $log)
                  <tr>
                     <td>
                        <a href="{{route('app_portal_admin_users_profile', $log->user_id)}}">{{$log->user_id}}</a> 
                     </td>
                     <td>{{$log->total_count}}</td>
                     <td><a href="{{route('app_portal_admin_users_profile', $log->user_id)}}">{{ $log->user->first.' '.$log->user->last }}</a></td>
                     <td>{{ date('d/m/Y h:ia', strtotime($log->last_login_date)) }}</td>
                     <td>{{ date('d/m/Y h:ia', strtotime($log->created_at)) }}</td>
                     <td>{{ date('d/m/Y h:ia', strtotime($log->updated_at)) }}</td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
            {{ $logs->links() }}
         </div>
      </div>
   </div>
</div>
<script>
   var chart;
   var data_1 = "{{$analytics->login_today}}";
   var data_2 = "{{$analytics->login_yesterday}}";
   
   window.onload = function() {
     populate_user_allocation_chart(data_1,data_2);
   };
   
   function populate_user_allocation_chart(a,b) {
   if(chart != null){
       chart.destroy();
   }
       var config = {
           type: 'pie',
           data: {
              datasets: [{
                 data: [a, b], 
                
              backgroundColor: [
                 '#75cfb8',
                 '#ffb26b',
              ]
              }],
              labels: [
                 'Login Today',
                 'Login Yesterday',
              ],
             
           },
           options: {
               responsive: true,
           }
       };
       var ctx = document.getElementById('chart-area').getContext('2d');
       chart = new Chart(ctx, config);
   }
   
   
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
@endsection