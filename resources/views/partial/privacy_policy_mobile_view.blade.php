@extends('layouts.app')
@section('title')
LocaL2LocaL – Mobile Privacy Policy
@endsection
@section('content')
<div class="p-2 sticky-top">
<a href="{{ url()->previous() }}" class="btn btn-primary btn-block text-white shadow-lg" onclick="toggle_animation(true);"><i class="fas fa-arrow-left"></i> Go Back</a>
</div>
<div class="container">

    
    @include('partial.termsOfUse') 
</div>
@endsection