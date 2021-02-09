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
                        @elseif($job->status == 'EXPIRED')
                        <span class="badge badge-secondary font-weight-normal ">EXPIRED</span>
                        @elseif($job->status == 'DRAFT')
                        <span class="badge badge-secondary font-weight-normal ">DRAFT</span>
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
                  @if($job->status == 'APPROVED' || $job->status == 'INPROGRESS' || $job->status == 'ONTRIP' || $job->status == 'STARTED' || $job->status == 'OPEN' || $job->status == 'DRAFT')
                  <!-- job cancellation form  -->
                  <tr>
                     <td>Cancel Job</td>
                     <td>
                        <form action="{{route('app_portal_admin_jobs_job_cancel')}}" method="POST">
                           @csrf
                           <input type="hidden" name="job_id" value="{{$job->id}}" required>
                           <button class="btn btn-danger text-white btn-sm fs--2 shadow" type="submit">Cancel Job</button>
                        </form>
                     </td>
                  </tr>
                  @endif
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
      <div class="card h-100 bg-white text-center">
         <div class="card-header">
            Service Provider Information
         </div>
         <div class="card-body">
            @php
            $service_provider =  $job->service_provider_profile;
            @endphp
            @if($service_provider != null)
            <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/{{$service_provider->profile_image_path}}"  alt="Service Provider Profile" onerror="this.src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMQAAADECAMAAAD3eH5ZAAAAYFBMVEVmZmb///9jY2NdXV1gYGBaWlpVVVX29vZ2dnaCgoKkpKTi4uJUVFSVlZXf399tbW3y8vKzs7Obm5uIiIjY2Njs7Oy/v7/Kysrt7e24uLjV1dV6enpubm7ExMSRkZGLi4sh2BX/AAAGEUlEQVR4nO2c6YKqOgyAIV0ANxwFFXX0/d/yoJBS5uhIa2177s331y2haZI2iUlCEARBEARBEARBEARBEARBEARBEARBEAThEeBMCHlHCMYhtDzGABcs38521TxrmVe72TZn4p9SBAQUzTxLR2TzXdG+EFq2iXCZNOv0IesmkTy0fBOARVE91qCjKhaxrwaI/PibCjeOedxGBezrlQo3vljEWrCknqJDmtbtW+MExHIs6mq3KUq5WMiy2OxW49eWcZrUD1OqNq1WfYi7hT1INqMNH6VJgdhpIjYnwWAkJQATp0Z7yy6+tQChrcO+fCwgiHKvrUV0WojhIdcn+VQ6kKdh7zfCp4SvETMl2jf7NSZzNpjdLCoteKEJ9sJIQFO4iCgHAaHEukx4uOKi3h7RthBqu+aTDETkygVEY1Bsq0LYxEDMVFjcRhK6AdDhfE1+rsoh1xCHQbFNL1A13cJBYPjeRLEUwPAIlxg8VEj6D2VRpB9qIcyeqeXHPoScd8KsDR2N6I+wtfyMXCZAaeiZEOWhyvD2xBq7hRiWogluTwC9Nc2MRWF9+jEP7mWVNeXGkkAeiz2hk1lZ2ARbReKfMG36slHiK5IECp+mTVKNCfw88EpAeTCP1urDfdQ+BN4UkHc5R22nRJc5ZuZOwSn81D3Mo9URjfdXnqewBzzeHyX2VmbNeq+wDazEtRNjZ+Vg8KrqGsdKvKcErcT7/Df2RO+dKjvvVEXhnTBOHOzixCGKOOEkYteh01ixsjdr3FA2GbBTxHefxVq4J7x8+g6dxfL+pDw37xYA3h8Kl6GvldX9kbmHQc9mtZ+cAtBvCvOKCdZlVsHP2Op4lpnaE/D+5tDmUOgYZU+mJ2V1BRjcmlokVqjNCiaqMLOK4AZQ+SdDs1BV7+C+6Y7A8kRuIA7HS6c6dJDoUJeqBrFCxQjjK9xPgdc26X6yeUus8gVPORAVtSYnH0P7QeAsXGNoTZlSAdZrwBHECASkalrcPG+JGN6NESLNXr/bH/yMYr1untHbcc7RGNMNNjQJrJLfSonAkqF96xKPMd3RGjay5fMWFc6WQ7tsXP0pNzQt0ip/3P3KZa51n8WnQ+v6NS3S41X8aKoGLsRVbzedxZAz/QUb9TGum6K897m33Drfy2LcthxLpP4JK8bt4Yeq2Wzzssy3m6Y6jF7Kikh1aLXgPxpHn7Hi0epwaxS/PGl1H1naJep2ceCL/OViVGXUOnBeHLNXOrR7pTn/3uwYELa4TtwSbdL+JJIEhsvlhO2gGVUeU/J3B9jpwSpk63petczr9QMr25VxuSjO/5qbqL+XRV4Cl0JIDue82Ox/ziWsl1F0nfWI89iSst21lF207t7QRW15Xu7HauxFLDtDbzm+m8lp8WQYrc2f5HWsRxFHFghcF6ueJa96xfNG3yAv27J9MFy+3Oxok7yWCcRZn6NowmvBE207NDBtp8LoXLEPrQXLB9Oonox+PILLi/bBsE6KazoYDqYwGE5Ix5BaDM3JaXY1NQp9kOoYLnqDUFH6YBF9QVy1ZfyAfJPAymmazu3SuWGOIt0E0mKIcdY2zYZQH+a8Olwjr+yHxQfvdghSflxgPreGNxIgpkaq9gt3sk3+deVb3tGhNUqlxdW7Qaly1du/rWoVa+9lVOy3Spu3L/LUZI5vP6umA+v3/wFiqAt47nvC8RWjiukzVF1ges3PBdi/6GiAgx1DLIXqInCTuSmD8tm/ryY/XG1FVRH2mM6yPmky7qx5BuBS+KumQpK5XYhhlsTfFCdHb+JuHyqX7W1CGy346HAbst5n2/VrmwOYP7vsjsZamVWXsAXYzpq5/D3l8DzZkxrKcupJcKrFfOjQCvmR8Ticf6y8pB6qc9Gt9Sp78rKz0Rtmjk9iC5+bAhsXXTrYG3isuPhQAve16wzhU9/7EMwQXLeCYrOvlx5++ca06W+oaQovSmSuE6cOHM9e+/CxqITr/ABdd+ZDid4VZs73H16x+7hEQyWc/9bCoxIyvf1nZ3ZwvurycP/i1Eve0f176gd+6mNfTBAEQRAEQRAEQRAEQRAEQRAEQRAEQRDE/5E/uag0Dy41gk8AAAAASUVORK5CYII='"  height="100" width="100" class="rounded-circle"/>
            <br><br>
            <a href="{{route('app_portal_admin_users_profile', $service_provider->id)}}" target="_blank" class="text-uppercase">{{$service_provider->first}} {{$service_provider->last}}</a>
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
            <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/{{$service_seeker->profile_image_path}}"  alt="Service Provider Profile" onerror="this.src='data:image/png;base64,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'"  height="100" width="100" class="rounded-circle"/>
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
               <div class="p-2 bd-highlight">Service Fee ({{number_format($job_payment->service_fee_percentage, 2)}}%)</div>
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
            <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
               <div class="p-2 bd-highlight">View Provider Invoice</div>
               <div class="ml-auto p-2 bd-highlight"><a href="{{route('app_portal_admin_jobs_job_invoice_provider', $job->id)}}" target="_blank">View</a></div>
            </div>
            <div class="d-flex border bd-highlight" style="border-style:dotted!important;">
               <div class="p-2 bd-highlight">View Seeker Invoice</div>
               <div class="ml-auto p-2 bd-highlight"><a href="{{route('app_portal_admin_jobs_job_invoice_seeker', $job->id)}}" target="_blank">View</a></div>
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
                     <th>Total Transfer Amount</th>
                     <td>${{number_format($job_paylog->total_amount, 2)}}</td>
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
   <div class="col-lg-6 p-3">
      <div class="card h-100 bg-white">
         <div class="card-header">
            Job Conversations
         </div>
         <div class="card-body">
            @php 
            $conversatons = $job->conversations;
            @endphp
            <ul class="list-group">
            @foreach($conversatons as $conversation)
            <li class="list-group-item card-1 mt-3 rounded border-0 p-0" onclick="location.href= app_url + '/service_seeker/jobs/job/{{$job->id}}';toggle_animation(true);">
               <div class="p-2">
                  @if($conversation->status == 'OPEN')
                  <span class="badge card-1 badge-success font-weight-normal p-2">OPEN</span>
                  @elseif($conversation->status == 'CLOSED')
                  <span class="badge card-1 badge-danger font-weight-normal p-2">CLOSED/DELETED</span>
                  @endif  
               </div>
               <div class="d-flex pl-2 pr-2 pt-2 bd-highlight">
                  <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold">
                     <h4> Service Provider: {{$conversation->service_provider_profile->first}} {{$conversation->service_provider_profile->last}}</h4>
                  </div>
               </div>
               <div class=" p-2" >
                  @if($conversation->json != null)
                  {{$conversation->service_provider_profile->first}} has offered to complete this job for ${{number_format($conversation->json['offer'],2)}}. Offer Description: {{$conversation->json['offer_description']}}.
                  @else
                  {{$conversation->service_provider_profile->first}} hasn’t made any job offers for this job.
                  @endif
               </div>
               <div class="p-2">
               <span>Conversation information: </span> <br><br>
               @php  
                  $msgs = $conversation->conversation_messages;
               @endphp
               @foreach($msgs as $msg)
                  <!-- Reciever Message  -->
                       @if($job->service_seeker_id == $msg->user_id)
                        <div class="media fs--2 w-50 ml-auto">
                           <div class="media-body">
                              <div class="py-2 px-3 mb-2 rounded" style="background:#399BDB!important;color:white!important;" >
                                 <p class=" mb-0 text-white text-break">{{$msg->text}}</p>
                              </div>
                              <p class="float-right m1-2 small text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>

                           </div>
                        </div>
                        @else
                        <!-- sender message -->
                        <div class="media fs--2 w-50 mb-1">
                           <div class="media-body">
                              <div class=" py-2 px-3 mb-2 rounded" style="background:#5D29BA!important;color:white!important;" >
                                 <p class=" mb-0 text-white">{{$msg->text}}</p>
                              </div>
                              <p class="small ml-1 text-muted">{{date('d/m/Y h:i a', strtotime($msg->msg_created_at))}}</p>
                           </div>
                        </div>
                        @endif
               @endforeach


               </div>
            </li>
            @endforeach
            <u/l>
         </div>
      </div>
   </div>
</div>
@endsection