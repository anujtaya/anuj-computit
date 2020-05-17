@extends('market/marketMaster')
@section('scripts')
@endsection
@section('content')
<style>
   .home_back {
   }  
   .super_margin_top {
   margin-top:60px!important;
   }
   .marketing_image {
   background: url("./marketImages/a.jpg");
   min-height:200px!important;
   background-size: cover;
   }
   .font_title {
   font-size: 30px!important;
   }
   .font_title_small {
   font-size: 20px!important;
   }
   .padding_mega {
   padding: 30px 0px 30px 0px !important;
   }
   .icon_font_large {
    font-size: 100px!important;
   }
</style>
<div class="container bg-white p-3">
   <div class="">
      <h3 class="mt-3 mb-3">Security</h3>
       <p>Your security is important to us. That’s why we continue to develop technology that helps us deliver a safer online experirence. Read more below.</p>
   </div>
   
    <div class="row">
     
      
       <div class="col-sm w3-margin ">
          <i class="fas fa-user-shield icon_font_large mb-3 w3-text-blue"></i>
          <p >We verify every user before activating their account. The verification methods may include but not limited to phone number verification, email verification, background check, document verification etc.</p>
          
      </div>
       <div class="col-sm w3-margin ">
          <i class="fab fa-stripe icon_font_large mb-3 w3-text-blue"></i>
          <p >Secure, simple and fast payments are now one tap away. Local2Local uses Stripe Inc. to process online payment transactions. Stripe is a widely used payment gatway and uses the latest technology to keep your money safe at all times. 
          </p>
          <a class="w3-button w3-tiny w3-black" href='https://stripe.com/about' target="_blank">More about Stripe</a>
         
      </div>
       <div class="col-sm w3-margin ">
           <i class="fas fa-users icon_font_large mb-3 w3-text-blue"></i>
       
          <p >We've got your back! Service Providers have the option to insure themselves for your and their protection. If your service provider is insured you can check their badge on thir profile. </p>
          
      </div>

</div>
   
   
</div>





@endsection