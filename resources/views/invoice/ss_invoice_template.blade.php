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
      </style>
   </head>
   <body class="container-block">
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
      <div class=" w3-center">
         <h3>Remittance</h3>
      </div>
      @include('invoice.ss_invoice_extension')
      <div  class="w3-padding w3-margin-top  w3-border w3-border-light-grey w3-text-dark-grey w3-tiny ">
         <div class="w3-row">
            <p>All prices are in Austalian Dollars. GST is incuded in the final payable amount.</p>
            <p>This is an auto-generated invoice. Please contact LocaL2LocaL Pty. Ltd. for any questions related to this invoice. Our email address
               is info@local2local.com.au
            </p>
         </div>
      </div>
      <div  class="w3-padding w3-margin-top  w3-border w3-border-light-grey w3-text-dark-grey w3-tiny ">
         <p style="font-weight: bold;">Generated by:</p>
         <br>
         <div class="w3-row">
            <div class="w3-col s3 border-right">
               <p class="font-weight-bolder">LocaL2LocaL Pty. Ltd. Australia</p>
               <p>P.O. Box 6</p>
               <p>Toowong QLD 4066</p>
               <p>Australia</p>
               <p>ABN: 67-625-654-613</p>
            </div>
            <div class="w3-col s9 pl-2">
               <img src="{{public_path('images/brand/logo.png')}}?v=1" onerror="this.src='{{asset('/images/brand/logo.png')}}'" height=70" width="70">
            </div>
         </div>
      </div>
   </body>
</html>