@extends('provider_portal.layout.provider_master')
@section('title', 'Provider Portal Homepage')
@section('content')
<div class="row">
   <div class="col-lg-6 pl-2 pr-2 pt-2">
      <div class="card shadow-none border h-100" >
         <div class="card-header bg-secondary  rounded-0">
            <h6 class="fs--1 text-white">Invoices List</h6>
         </div>
         <div class="card-body fs--1">
            <table class="table table-bordered table-striped table-sm fs--1">
               <thead>
                  <th>Job ID</th>
                  <th>Date</th>
                  <th>Service Type</th>
                  <th>Download Link</th>
               </thead>
               <tbody>
                  @foreach($jobs as $job)
                     <tr>
                        <td>JB-{{$job->id}}</td>
                        <td>{{date('d/m/Y h:i a', strtotime($job->job_date_time))}}</td>
                        <td>{{$job->service_category_name}} - {{$job->service_subcategory_name}}</td>
                        <td>
                           <a class="text-primary" href="{{route('app_portal_provider_inovice_download', $job->id)}}">Download</a>
                        </td>
                     </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>

</div>
@endsection