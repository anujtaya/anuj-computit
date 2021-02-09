@extends('admin_portal.layouts.master')
@section('title', 'Admin Portal Job Managment -  Service Provider Payment Transfer')
@section('content')
<div class="row m-2">
    <div class="col-lg-12 p-0">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item">Banking</li>
            <li class="breadcrumb-item active" aria-current="page">Service Provider Payment Transfer</li>
         </ol>
      </nav>
   </div>
   <div class="col-lg-6 h-100 p-3">
      <div class="card rounded-0  bg-white">
         <div class="card-header">
            Payment Service Provider
         </div>
         <div class="card-body">
            <div class="d-flex bd-highlight">
               <div class=" flex-grow-1 bd-highlight font-weight-bolder">Deafult Payment Gateway: Stripe </div>
               <div class="p-2 bd-highlight" id="p_m"><i class="fas fa-circle-notch fa-spin"></i></div>
            </div>
            <a href="https://stripe.com/au/privacy" target="_blank">Stripe Privacy Policy</a>
            <br>
            <a href="https://stripe.com/au/connect/legal" target="_blank">Stripe platform agreement</a>
            <br>
            <a href="https://stripe.com/au/connect-account/legal" target="_blank">Stripe connect account agreement</a>
            <br>
            <a href="https://stripe.com/au/ssa" target="_blank">Stripe service agreemnet</a>
         </div>
      </div>
   </div>
   <div class="col-lg-6 p-3">
      <div class="card h-100 rounded-0  h-100 bg-white">
         <div class="card-header">
            Account Balance(s)
         </div>
         <div class="card-body">
            <table class="table table-bordered table-hover table-sm">
               <tr>
                  <td>Available</td>
                  <td id="a_b" style="text-align:right;color:green;font-weight:900;">
                     <i class="fas fa-circle-notch fa-spin"></i>
                  </td>
               </tr>
               <tr>
                  <td>Connect Reserved</td>
                  <td id="c_r_b" style="text-align:right;">
                     <i class="fas fa-circle-notch fa-spin"></i>
                  </td>
               </tr>
               <tr>
                  <td>Pending</td>
                  <td id="p_b" style="text-align:right;">
                     <i class="fas fa-circle-notch fa-spin"></i>
                  </td>
               </tr>
            </table>
         </div>
      </div>
   </div>
   <div class="col-lg-8  p-3">
      <div class="card h-100 rounded-0  h-00 bg-white">
         <div class="card-header">
            Service Provider Payment Logs
         </div>
         <div class="card-body">
            <table class="table table-bordered table-sm table-hover" id="records_table_0">
               <thead>
                  <tr class="bg-light">
                     <th>Service Provider ID </th>
                     <th>Job ID </th>
                     <th>Payment Status</th>
                     <th>Amount (In AUD)</th>
                     <th>Updated</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach($paylogs as $d)
                  <tr>
                     <td class="text-right"><a href="{{route('app_portal_admin_users_profile',$d->user_id )}}" target="_blank" >{{$d->user_id}}</a></td>
                     <td class="text-right"><a href="{{route('app_portal_admin_jobs_job', $d->job_id)}}" target="_blank">{{$d->job_id}}</a></td>
                     <td class="text-right">
                        @if($d->status == 'PENDING')
                        <span class="badge badge-warning rounded-0">PENDING PAYMENT</span>
                        @elseif($d->status == 'PAID')
                        <span class="badge badge-success rounded-0">PAID</span>
                        @endif
                     </td>
                     <td class="text-right">{{number_format($d->total_amount,2)}}</td>
                     <td>
                        {{date('d/m/Y h:ia', strtotime($d->updated_at))}}
                     </td>
                     <td >
                        @if($d->status == 'PENDING')
                        <a class="text-success" href="{{route('app_portal_admin_banking_service_provider_paylog_payment_transfer' , $d->id)}}">Pay Now</a>
                        @else
                        
                        @endif
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
      </div>
   </div>
</div>
<script>
   $(document).ready(function() {
       stripe_data();
      
   });
        
  
   function stripe_data(){
      $.ajax({
         dataType:'json',
         type: "POST",
         url: "{{route('app_portal_admin_banking_stripe_account_data')}}",
         success: function(results) {
               var a_b = document.getElementById("a_b");
               var c_r_b = document.getElementById("c_r_b");
               var p_b = document.getElementById("p_b");
               var p_m = document.getElementById("p_m");
               
               if(typeof results === 'object'){
                     a_b.innerHTML = '$' + parseFloat(results['available'][0]['amount']/100).toFixed(2);
                     c_r_b.innerHTML = '$' + parseFloat(results['connect_reserved'][0]['amount']/100).toFixed(2);
                     p_b.innerHTML = '$' + parseFloat(results['pending'][0]['amount']/100).toFixed(2);
                     if(results['livemode'] === true){
                        p_m.innerHTML = "<span class='badge badge-success rounded-0 p-2'> Live Mode<span>";
                     } else if(results['livemode'] === false) {
                        p_m.innerHTML = "<span class='badge badge-warning rounded-0 p-2'> Test Mode<span>"; 
                     }
                     
                  console.log(results);
               } else {
                  Snackbar.show({
                  text: '<strong>Alert!' + results + '</strong>',
                  pos: 'top-center'
               });   
               }  
         },
         error: function(result, status, err) {
            Snackbar.show({
               text: '<strong>Alert! Failed to connect with stripe!</strong>',
               pos: 'top-center'
         });
         }
      });
   }
</script>
@endsection