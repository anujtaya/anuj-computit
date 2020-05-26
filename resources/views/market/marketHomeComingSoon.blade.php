@extends('layouts.app')
@section('title')
LocaL2LocaL – Website being upgraded
@endsection
@section('scripts')
@endsection
@section('content')
<div class="container">
   <div class="row mt-4 justify-content-center">
      <div class="col-lg-6 p-2">
         <div class="border  rounded text-center p-2">
            <img src="{{asset('images/brand/l2l-logo-svg.svg')}}" height="100" width="100" style="height:100px;width:100px;" class="img-responsive shadow rounded-circle" alt="">
            <br><br>
            <h3>Website being upgraded</h3>
            <br>
            <p>
               LocaL2LocaL is currently being upgraded and will be available soon for use.
               Follow us on Instagram or Facebook for details on our Launch date.
            </p>
            <p>
               <a href="https://facebook.com/local2localapp/" target="_blank" class="w3-text-white"><i class="fab fa-facebook w3-xlarge"></i> Facebook</a></br>
               <a href="https://www.instagram.com/local2localapp/" class="w3-text-white"><i class="fab fa-instagram w3-xlarge"></i> Instagram</a> </br>
            </p>
            <br>
            <p class="w3-margin w3-center w3-tiny">&copy;2020 Local2Local Pty. Ltd. ABN 67 625 654 613 </p>
         </div>
      </div>
   </div>
</div>
@endsection