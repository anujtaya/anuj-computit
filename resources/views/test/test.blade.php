@extends('layouts.service_seeker_master')
@section('content')

<h1>Test Page</h1>
<label for="dateselector">Select Date:</label>
<input  type='date'    class="form-control form-control-sm"  id="service_job_date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" >
<label for="timeselector">Select Time:</label>
<input  type='time'    class="form-control form-control-sm"  id="service_job_time" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" >

<form action="">
<input  type='datetime-local'    class="form-control form-control-sm"  id="service_job_datetime" value="{{\Carbon\Carbon::now()->format('Y-m-d\TH:i')}}" required >
<button type="submit">Test</button>
</form>
@endsection