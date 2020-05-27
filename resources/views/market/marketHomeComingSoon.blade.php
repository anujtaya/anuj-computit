@extends('layouts.app')
@section('title')
LocaL2LocaL – Website being upgraded
@endsection
@section('scripts')
@endsection
@section('content')
<div class="container">
   <div class="row mt-4 justify-content-center">
      <div class="col-lg-6 p-2 text-info">
         <div class=" text-center p-2">
            <img src="{{asset('images/brand/l2l-logo-svg.svg')}}" height="100" width="100" style="height:100px;width:100px;" class="img-responsive shadow rounded-circle" alt="">
            <br><br>
            <h3 class="theme-color">UNDER CONSTRUCTION</h3>
            <br>
            <p class="theme-color">
               LocaL2LocaL is currently being upgraded and will be available soon for use.
               Follow us on Instagram or Facebook for details on our Launch date.
            </p>
            <p>
               <a href="https://facebook.com/local2localapp/" target="_blank" class="theme-color"><i class="fab fa-facebook w3-xlarge"></i> Facebook</a></br>
               <a href="https://www.instagram.com/local2localapp/" class="theme-color"><i class="fab fa-instagram w3-xlarge"></i> Instagram</a> </br>
            </p>
            <p class="theme-color mt-3 text-uppercase">
               We look forward to seeing you.
            </p>
            <br>
            <p class="fs--2 theme-color">&copy;2020 Local2Local Pty. Ltd. ABN 67 625 654 613 </p>
         </div>
      </div>
   </div>
</div>
<div style="height: 150px; overflow: hidden;" class="fixed-bottom" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #399BDB;"></path></svg></div>
@endsection