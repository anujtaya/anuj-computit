@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal - System Manager')
@section('content')
<div class="row m-2">
   <div class="col-lg-4 p-1">
      <div class="card h-100 rounded-0 bg-white">
         <div class="card-header">
            About this page
         </div>
         <div class="card-body">
            This page helps you view system reports and run admin functions. You can view the status of crone jobs. Please contact your developer to know more about this page.
         </div>
      </div>
   </div>
   <div class="col-lg-4 p-1">
      <div class="card h-100 rounded-0 bg-white">
         <div class="card-header">
            Run Job Expiry Crone Job
         </div>
         <div class="card-body">
            If you click on the button below it will run the crone job that will set the job status to expiry if a job is expired. The user can reopen the job if they wish to from their jobs history menu.
            A notification will be delivered to their mobile via push notification channel.
            <form action="{{route('app_portal_admin_system_job_expiry_crone_manual')}}" method="POST" class="mt-3">
                @csrf
                <button class="btn btn-primary btn-sm card-1" type="SUBMIT">Run Crone Job</button>
            </form>
         </div>
      </div>
   </div>
</div>
@endsection