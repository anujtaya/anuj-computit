<!DOCTYPE html>
<html>
   <head>
      <title>Document - Tax Invoice</title>
      <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
      <meta charset="utf-8">
      <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
      <style>
         p {
         margin-bottom:0em;
         margin-top:0em;
         }
         @page { margin: 0px; }
         body { margin: 0px; }
         .table td, .table th {
         padding: 0rem;
         }
         #footer {
         position: fixed;
         left: 0px; right: 0px; bottom: 20px;
         text-align: center;
         height: 300px;
         bottom: 0px !important;
         }
      </style>
   </head>
   <body>
      <?php
         $job = \App\Job::find($job_id);
         $service_seeker = \App\User::find($job->service_seeker_id);
         $service_provider = \App\User::find($job->service_provider_id);
         $service_provider_business = $service_provider->business_info;
         $extras = $job->extras->where('status', 'ACTIVE');
         $job_payment = $job->job_payments;
         //calculate job total and other variables
         $conversation = \App\Conversation::where('job_id', $job->id)
            ->select('users.*', 'conversations.id as conversation_id', 'conversations.json', 'conversations.job_id', 'conversations.service_provider_id' )
            ->join('users', 'conversations.service_provider_id', '=', 'users.id')
            ->first();
         $abn = '';
         if($service_provider_business != null) {
            $abn = $service_provider_business->abn;
         }
         if(strlen($abn) == 11) {
            $abn_formatted =    (string)$abn;
            $abn_formatted =    substr($abn_formatted,0,2).'-'.substr($abn_formatted,2,3).'-'.substr($abn_formatted,5,3).'-'.substr($abn_formatted,8,3);
         }
         else {
            $abn_formatted = 'NA';
         }
         //dd($extras);
         ?>
      <!-- header content -->
      <div class="pl-4 pr-4 pt-2" style="background:#E6E7EC!important;height:315px;">
         <div class="w3-row ml-2 mr-2 mt-4">
            <div class="w3-col s6">
               <h4 class="font-weight-bolder mt-4">Tax Invoice</h4>
               <p style="font-size:1.1em;">#1725</p>
               <p style="font-size:1.1em;">DATE: FRI 29/09/2020</p>
            </div>
            <div class="w3-col s6 text-right">
               <div class="mt-4">
                  <span class="p-4 bg-dark w3-right text-white text-center font-weight-bolder">$ {{number_format($job_payment->payable_job_price,2)}} AUD</span>
               </div>
            </div>
         </div>
         <div class="w3-row m-2">
            <div class="w3-col s12">
               <p class="font-weight-bolder">To: Service Seeker</p>
               <p class="mt-1">{{$service_seeker->first}} {{$service_seeker->last}}</p>
            </div>
         </div>
         <div class="w3-row m-2">
            <div class="w3-col s6">
               <p class="font-weight-bolder">From: Service Provider</p>
               <p class="mt-1">{{$service_provider->first}} {{$service_provider->last}}</p>
               @if($abn != '') 
               <p class="mt-1">{{$service_provider_business->business_name}}</p>
               @endif
               @if($abn != '') 
               <p class="mt-1">{{$abn}}</p>
               @endif
            </div>
            <div class="w3-col s6 text-right">
            </div>
         </div>
      </div>
      <!-- data input for invoice -->
      @include('invoice.ss_invoice_extension')
      <!-- footer content  -->
      <div  class="pl-4 pr-4 pt-2">
         <div class="w3-row m-1">
            <div class="w3-col s12">
               <p class="font-weight-bolder"><img src="{{public_path('images/brand/l2l-logo-tm-min.png')}}?v=1"  class="mr-2" onerror="this.src='{{asset('/images/brand/l2l-logo-tm-min.png')}}'" height=50" width="50">Customer Service</p>
               <p class="mt-1">www.local2local.com.au | admin@local2local.com.au</p>
               <p>
                  This is an auto-generated invoice. <br>
                  All prices are in Austalian Dollars. GST is incuded in the final payable amount. <br>
                  Please contact LocaL2LocaL Pty. Ltd. for any questions related to this invoice.
               </p>
            </div>
            <div class="w3-col s6 text-right">
            </div>
         </div>
      </div>
      <div id="footer">
         <img src="{{public_path('images/brand/ribbon.png')}}" onerror="this.src='{{asset('/images/brand/ribbon.png')}}'" style="height:100%;width:100%" >
      </div>
   </body>
</html>