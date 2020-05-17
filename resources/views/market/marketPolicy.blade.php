@extends('market/marketMaster')
@section('title')
LocaL2LocaL – Policy and Terms of Use
@endsection
@section('scripts')
@endsection
@section('content')
<div class="container bg-white p-4">
   <h5>Terms of use</h5>
   <p>
      @include('service.termsOfUse') 
   </p>
</div>
@endsection