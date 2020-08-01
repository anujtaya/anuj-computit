@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal Job Managment -  View/Edit Job')
@section('content')
<div class="row m-2">
   <div class="col-lg-4 p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Job information | ID:{{$job->id}}
         </div>
         <div class="card-body">
            <table class="table table-sm table-bordered">
               <tbody>
                  <tr>
                     <th>Unique ID</th>
                     <td>{{$job->id}}</td>
                  </tr>
                  <tr>
                     <th>Status</th>
                     <td>
                        @if($job->status == 'OPEN')
                           <span class="badge badge-success font-weight-normal">Open</span>
                        @elseif($job->status == 'APPROVED')
                           <span class="badge badge-success font-weight-normal">Approved</span>
                        @elseif($job->status == 'ONTRIP')"
                           <span class="badge badge-warning font-weight-normal ">On-Trip</span>
                        @elseif($job->status == 'ARRIVED')
                           <span class="badge badge-secondary font-weight-normal ">Arrived</span>
                        @elseif($job->status == 'STARTED')
                           <span class="badge badge-warning font-weight-normal ">In-Progress</span>
                        @elseif($job->status == 'COMPLETED')
                           <span class="badge badge-secondary font-weight-normal ">COMPLETED</span>
                        @elseif($job->status == 'CANCELLED')
                           <span class="badge badge-danger font-weight-normal">CANCELLED</span>
                        @endif  
                     </td>
                  </tr>
                  <tr>
                     <th>Title</th>
                     <td>{{$job->title}}</td>
                  </tr>
                  <tr>
                     <th>Description</th>
                     <td>{{$job->description}}</td>
                  </tr>
                  <tr>
                     <th>Major Service Name</th>
                     <td>{{$job->service_category_name}}</td>
                  </tr>
                  <tr>
                     <th>Minor Service Name</th>
                     <td>{{$job->service_subcategory_name}}</td>
                  </tr>
                  <tr>
                     <th>Created at</th>
                     <td>{{ date('d/m/Y h:ia', strtotime($job->created_at)) }}</td>
                  </tr>
                  <tr>
                     <th>Updated at</th>
                     <td>
                        {{ date('d/m/Y h:ia', strtotime($job->updated_at)) }}
                     </td>
                  </tr>
                  <tr>
                     <th>Job Start at</th>
                     <td>{{ date('d/m/Y h:ia', strtotime($job->job_date_time)) }}</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
   </div>
   <div class="col-lg-4 p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Job Google Map Location
         </div>
         <div class="card-body">
            <img width="100%"  class="m-2" src="https://maps.googleapis.com/maps/api/staticmap?center={{$job->job_lat}},{{$job->job_lng}}&zoom=14&size=800x400&maptype=roadmap&markers=color:red|{{$job->job_lat}},{{$job->job_lng}}&key=AIzaSyClfjwR-ajvv7LrNOgMRe4tOHZXmcjFjaU">
         </div>
      </div>
   </div>
   <div class="col-lg-2  p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Service Provider Information
         </div>
         <div class="card-body">
            @php
               $service_provider =  $job->service_provider_profile;
            @endphp
            @if($service_provider != null)
            <img src="{{url('/')}}/storage/images/profile/{{$service_provider->profile_image_path}}"  alt="Service Provider Profile" height="100" width="100" class="w3-circle"/>
            <br><br>
            <a href="{{route('app_portal_admin_users_profile', $service_provider->id)}}" target="_blank" class="text-uppercase"{{$service_provider->first}} {{$service_provider->last}}</a>
            @else
               No info available.
            @endif
         </div>
      </div>
   </div>
   <div class="col-lg-2  p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Service Seeker Information
         </div>
         <div class="card-body text-center">
            @php
               $service_seeker =  $job->service_seeker_profile;
            @endphp
            @if($service_seeker != null)
            <img src="{{url('/')}}/storage/images/profile/{{$service_seeker->profile_image_path}}"  alt="Service Provider Profile" height="100" width="100" class="rounded-circle"/>
            <br><br>
            <a href="{{route('app_portal_admin_users_profile', $service_seeker->id)}}" target="_blank" class="text-uppercase">{{$service_seeker->first}} {{$service_seeker->last}}</a>
            @else
               No info available.
            @endif
         </div>
      </div>
   </div>
   <div class="col-lg-4 p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Job Extras
         </div>
         <div class="card-body">
            @php
               $job_extras =  $job->extras;
            @endphp
            <ul class="list-group fs--1 border-light border">
               @foreach($job_extras as $extra)
                  <li class="list-group-item mb-1-0  border" style="border-style:dashed!important;">
                     <div class="d-flex bd-highlight">
                        <div class="pb-2 w-100 bd-highlight theme-color">
                           {{$extra->quantity}} ×  {{$extra->name}}
                        </div>
                        <div class="pb-2 ml-auto"><span class="fs--2">$</span>{{number_format(($extra->quantity * $extra->price),2)}}</div>
                     </div>
                     <div class="d-flex bd-highlight fs--2">
                        <div class="pb-2 bd-highlight">{{$extra->description}}</div>
                     </div>
                  </li>
               @endforeach
               @if(count($job_extras) == 0)
                  No job extras currently assigned to this job.
               @endif 
            </ul>
         </div>
      </div>
   </div>
   <div class="col-lg-4 p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Payment Information
         </div>
         <div class="card-body">
            @php
               $job_payment =  $job->job_payments;
            @endphp
               @if($job_payment != null)
               @if($job_payment->status == 'UNPAID')
               <div class="alert alert-danger">
                     We are currently waiting for Service Seeker approval for this job invoice. Once the Service Seeker approves the invoice we will transfer the money in your nominated bank account.  
               </div>
               @endif
               <div class="d-flex bd-highlight mb-2">
                  <div class="p-0 bd-highlight font-weight-bolder">Job Summary</div>
               </div>
               <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
                  <div class="p-2 bd-highlight">Total Job Price</div>
                  <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->job_price, 2)}}</div>
               </div>
               <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
                  <div class="p-2 bd-highlight">GST Included</div>
                  <div class="ml-auto p-2 bd-highlight"> ${{number_format($job_payment->gst_fee_value,2)}}</div>
               </div>
               <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
                  <div class="p-2 bd-highlight">Service Fee ({{number_format($job_payment->service_fee_percentage, 2)}})</div>
                  <div class="ml-auto p-2 bd-highlight text-danger"> ${{number_format($job_payment->service_fee_price, 2)}}</div>
               </div>
               <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
                  <div class="p-2 bd-highlight">Service Provider Gets</div>
                  <div class="ml-auto p-2 bd-highlight text-success"> ${{number_format($job_payment->service_provider_gets, 2)}}</div>
               </div>
               <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
                  <div class="p-2 bd-highlight">Payment Mode</div>
                  <div class="ml-auto p-2 bd-highlight"> {{$job_payment->payment_method}}</div>
               </div>
               <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
                  <div class="p-2 bd-highlight">Payment Reference Number</div>
                  <div class="ml-auto p-2 bd-highlight"> {{$job_payment->payment_reference_number}}</div>
               </div>
               @else
                  No information available.
               @endif
         </div>
      </div>
   </div>
   <div class="col-lg-4 p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Service Provider Paylog
         </div>
         <div class="card-body">
            @php
               $job_paylog =  $job->job_paylog;
            @endphp
               @if($job_paylog != null)
               <table class="table table-sm table-bordered">
                  <tbody>
                     <tr>
                        <th>Unique ID</th>
                        <td>{{$job_paylog->id}}</td>
                     </tr>
                     <tr>
                     <th>Status</th>
                     <td>
                        @if($job_paylog->status == 'PENDING')
                           <span class="badge badge-warning font-weight-normal">Pending</span>
                        @elseif($job_paylog->status == 'PAID')
                           <span class="badge badge-success font-weight-normal">Paid</span>
                        @else
                           <span class="badge badge-secondary font-weight-normal">Not Available</span>
                        @endif  
                     </td>
                  </tr>
                     <tr>
                        <th>Created at</th>
                        <td>{{ date('d/m/Y h:ia', strtotime($job_paylog->created_at)) }}</td>
                     </tr>
                     <tr>
                        <th>Updated at</th>
                        <td>{{ date('d/m/Y h:ia', strtotime($job_paylog->updted_at)) }}</td>
                     </tr>
                  </tbody>
               </table>
               @else
                  No information available.
               @endif
         </div>
      </div>
   </div>
</div>
@endsection