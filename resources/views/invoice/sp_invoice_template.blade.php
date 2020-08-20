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
      <div class="pl-4 pr-4 pt-2" style="background:#E6E7EC!important;height:240px;">
         <div class="w3-row ml-3 mr-3 mt-4">
            <div class="w3-col s6">
               <img src="{{public_path('images/brand/logo.png')}}?v=1" onerror="this.src='{{asset('/images/brand/logo.png')}}'" height=70" width="70">
               <h4 class="font-weight-bolder mt-4">Remittance</h4>
               <p style="font-size:1.1em;">#1725</p>
               <p style="font-size:1.1em;">DATE: FRI 29/09/2020</p>
            </div>
            <div class="w3-col s6 text-right">
               <p class="">LocaL2LocaL Pty. Ltd. Australia</p>
               <p>P.O. Box 6</p>
               <p>Toowong QLD 4066</p>
               <p>Australia</p>
               <p>ABN: 67-625-654-613</p>
               <div class=" mt-4">
                  <span class="p-3 bg-dark w3-right text-white text-center font-weight-bolder">$ {{number_format($job_payment->service_provider_gets,2)}} AUD</span>
               </div>
            </div>
         </div>
      </div>
      <!-- data input for invoice -->
      @include('invoice.sp_invoice_extension')
      <!-- footer content  -->
      <div  class="pl-4 pr-4 pt-2">
         <div class="w3-row m-1">
            <div class="w3-col s12">
               <p class="font-weight-bolder">Customer Service</p>
              
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