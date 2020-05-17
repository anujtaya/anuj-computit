@extends('market/marketMaster')
@section('title')
LocaL2LocaL – Frequently asked questions
@endsection
@section('scripts')
@endsection
@section('content')

<div class="container bg-white p-4 ">
 <div class="p-2 m-1">
      <h3>FAQ's</h3>
   </div>

<div class="">
<div class="font_title_small" id="accordion">
   <div class=" mb-3">
      <div  class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="headingOne" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
         <strong >1. What is LocaL2LocaL? <span class="w3-right"><a data-toggle="collapse" data-target="#collapseOne" href="#headingOne" role="button" aria-expanded="true" aria-controls="collapseOne"></a></span></strong>
      </div>
      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
         <div class="card-body">
            An easy to use online platform that helps people to request services like car repairs,dog walking, house cleaning, parcel delivery, just to name a few, from people around them. LocaL2LocaL is a community-based real-time help service.
         </div>
      </div>
   </div>
   <div class=" mb-3">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="headingTwo" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
         <strong >2. What type of jobs are available on LocaL2LocaL?<span class="w3-right"><a data-toggle="collapse" data-target="#collapseTwo" href="#headingTwo" role="button" aria-expanded="true" aria-controls="collapseTwo"></a></span></strong>
      </div>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
         <div class="card-body">
            Almost anything you can think of with the list of categories expanding regularly as suggestions are made. 
            As the platform expands and more Service Providers get on-board and realise their skills can make them extra money after work even if its “not your day job”, the list of jobs will be almost endless.
         </div>
      </div>
   </div>
   <div class=" mb-3">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="heading3" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
         <strong >3. Who can request a job?<span class="w3-right"><a data-toggle="collapse" data-target="#collapse3" href="#heading3" role="button" aria-expanded="true" aria-controls="collapse3" ></a></span></strong>
      </div>
      <div id="collapse3" class="collapse" aria-labelledby="heading3" data-parent="#accordion">
         <div class="card-body">
            Anyone with a device and the capability to download an App can request a job (under 18 year olds need to have a parent or guardians approval).
         </div>
      </div>
   </div>
   <div class=" mb-3">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="heading4" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
         <strong>4. Who is a Service Provider?<span class="w3-right"><a data-toggle="collapse" data-target="#collapse4" href="#heading4" role="button" aria-expanded="true" aria-controls="collapse4"></a></span></strong>
      </div>
      <div id="collapse4" class="collapse" aria-labelledby="heading4" data-parent="#accordion">
         <div class="card-body">
            A Service Provider is someone who can offer their services, skills or talents on the LocaL2LocaL App and complete the job for the Service Seeker who requested them.
         </div>
      </div>
   </div>
   <div class=" mb-3">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="heading9" data-toggle="collapse" data-target="#collapse9" aria-expanded="true" aria-controls="collapse9">
         <strong>5. Who is a Service Seeker?<span class="w3-right"><a data-toggle="collapse" data-target="#collapse9" href="#heading9" role="button" aria-expanded="true" aria-controls="collapse9"></a></span></strong>
      </div>
      <div id="collapse9" class="collapse" aria-labelledby="heading9" data-parent="#accordion">
         <div class="card-body">
            A Service Seeker is a person who needs a job done. 
         </div>
      </div>
   </div>
   <div class=" mb-3">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="heading5" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
         <strong>6. What is unique about LocaL2LocaL?<span class="w3-right"><a data-toggle="collapse" data-target="#collapse5" href="#heading5" role="button" aria-expanded="true" aria-controls="collapse5"></a></span></strong>
      </div>
      <div id="collapse5" class="collapse" aria-labelledby="heading5" data-parent="#accordion">
         <div class="card-body">
            LocaL2LocaL has the unique advantage of real time tracking of the requested job. If a Service Seeker has a job they need done immediately and there is a Service Provider nearby who accepts the job, they can track them from the acceptance of the job.
            This eliminates the window of time that some trades offer as to when they will arrive and gives real time updates as they travel to your job. You can now plan your day and not be left wondering.
         </div>
      </div>
   </div>
   <div class=" mb-3">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="heading7" data-toggle="collapse" data-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
         <strong>7. When can a Service Seeker see that I am available?<span class="w3-right"><a data-toggle="collapse" data-target="#collapse7" href="#heading7" role="button" aria-expanded="true" aria-controls="collapse7"></a></span></strong>
      </div>
      <div id="collapse7" class="collapse" aria-labelledby="heading7" data-parent="#accordion">
         <div class="card-body">
            When a Service Provider decides they have some available time to offer their services they simply flick the barOn the App Home Page to online (active) or green which will allow a Service Seeker nearby to select them to complete the job they require.
         </div>
      </div>
   </div>
   <div class=" mb-3">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="heading8" data-toggle="collapse" data-target="#collapse8" aria-expanded="true" aria-controls="collapse8">
         <strong>8. What if I don’t want to be available?<span class="w3-right"><a data-toggle="collapse" data-target="#collapse8" href="#heading8" role="button" aria-expanded="true" aria-controls="collapse8"></a></span></strong>
      </div>
      <div id="collapse8" class="collapse" aria-labelledby="heading8" data-parent="#accordion">
         <div class="card-body">
            Simply flick the bar on the App Home Page across to red, you are now offline or inactive and can't be seen.
         </div>
      </div>
   </div>
   <div class="mb-3">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="heading10" data-toggle="collapse" data-target="#collapse10" aria-expanded="true" aria-controls="collapse10">
         <strong>9. What is the LocaL2LocaL Service Fee?<span class="w3-right"><a data-toggle="collapse" data-target="#collapse10" href="#heading10" role="button" aria-expanded="true" aria-controls="collapse10"></a></span></strong>
      </div>
      <div id="collapse10" class="collapse" aria-labelledby="heading10" data-parent="#accordion">
         <div class="card-body">
            The total Service Fee amount charged will always be clearly displayed. The Service Fee will only be payable once a job has been accepted by a Service Provider.
            <li>All service fees are subject to GST, which will be clearly displayed on the invoice.</li>
         <li>A Service fee is charged for all payments made through the LocaL2LocaL payment gateway (Stripe)</li>
         <li>If a cancellation occurs a service fee may still be charged.</li>
         </div>
      </div>
   </div>
   <div class="">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="heading6" data-toggle="collapse" data-target="#collapse6" aria-expanded="true" aria-controls="collapse6">
         <strong>10. What is Stripe?<span class="w3-right"><a data-toggle="collapse" data-target="#collapse6" href="#heading6" role="button" aria-expanded="true" aria-controls="collapse6"></a></span></strong>
      </div>
      <div id="collapse6" class="collapse" aria-labelledby="heading6" data-parent="#accordion">
         <div class="card-body">
            Stripe helps to power 100,000+ businesses in 100+ countries and across nearly every industry. Headquartered in San Francisco, Stripe has 9 global offices and hundreds of people working to help transform how modern businesses are built and run.
            Data security is of utmost importance to Stripe. They invest heavily in securing their infrastructure in close partnership with world-class security experts.•	All card numbers are encrypted on disk with AES-256. Decryption keys are stored on separate machines.</p>
            Stripe’s infrastructure for storing, decrypting, and transmitting card numbers runs in separate hosting infrastructure, and doesn’t share any credentials with Stripe’s primary services.</p>
            <a href="https://stripe.com/docs/security/stripe" class="w3-text-black">Click here to visit Stripe Inc.</a></p>
         </div>
      </div>
   </div>
    <div class="">
      <div class="w3-btn w3-block m-1 w3-large border-bottom text-left " id="heading11" data-toggle="collapse" data-target="#collapse11" aria-expanded="true" aria-controls="collapse11">
         <strong>11. How much does LocaL2LocaL charge?<span class="w3-right"><a data-toggle="collapse" data-target="#collapse6" href="#heading6" role="button" aria-expanded="true" aria-controls="collapse6"></a></span></strong>
      </div>
      <div id="collapse11" class="collapse" aria-labelledby="heading11" data-parent="#accordion">
         <div class="card-body">
            You can register to be both a Service Seeker and a Service Provider for free. 
			It is also free for a Service Provider to advertise their business & personal services.
			A Service Provider nominates the amount they wish to be paid either per job or per hour. 
			When a Service Seeker engages you to do a job, the nominated amount is secured from the Service Seeker’s credit card and placed on hold. 
			When the Service Provider completes the job, they are paid automatically less a small engagement fee of 12%.  
			<br>
			Local2Local will send both the Service Seeker and Service Provider a receipt and tax invoice for the transaction. 
         </div>
      </div>
   </div>
</div>
{{--page main content ends here --}}
<div class="w3-border-light-grey w3-border   font_title_small home_back">
   <div class="w3-margin">
      <ul>
         
      </ul>
   </div>
</div>
</div>
@endsection