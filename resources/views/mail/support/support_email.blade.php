@component('mail::message' )
Dear LocaL2LocaL Admin,
<p>A help request is made by <b>{{$user->first}} {{$user->last}}</b> (username: {{$user->email}}). The content of the help request are described below.</p>
<p>
   <b>Support Type:</b>
   <br>
   {{$user->support_type}}
   <br> <br>
   <b>Support Message:</b>
   <br> 
   {{$user->support_message}}
</p>
Thanks,<br>
{{ config('app.name') }}
@endcomponent