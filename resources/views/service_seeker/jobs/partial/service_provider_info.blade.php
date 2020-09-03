<div class="mt-2 fs--1">
   <div class="m-2 p-2 rounded shadow-sm-d shadow-sm">
      @if($conversation->json != null)
      <div class="d-flex bd-highlight mb-2">
         <div class="p-0 bd-highlight">
            <span class="text-success fs--1">{{$user->first}} {{$user->last}} has offered to do this job for: <span class="fs--1">$</span>{{number_format($conversation->json['offer'],2)}}</span> <br>
         </div>
      </div>
      <div class="text-muted bg-light p-2 mb-1 fs--1rounded">
         <span>Offer Description:</span><br>
         <i>{{$conversation->json['offer_description']}}</i>
      </div>
      @else
      <div class="d-flex bd-highlight mb-2">
         <div class="p-0 bd-highlight">
            <span class="text-secondary fs--1"> Service Provider {{$user->first}} {{$user->last}} hasn't made any offer yet. If you have any questions by tapping the View Messages button below to discuss about the job pricing. <br>
         </div>
      </div>
      @endif
   <span class="text-muted font-weight-normal fs--2 p-1">{{count($conversation->conversation_messages)}} messages</span>
   <div class="row m-1">
      <div class="col-6 p-1">
         <a type="button" class="btn btn-block theme-background-color btn-sm fs--1  text-white shadow" href="{{route('service_seeker_job_conversation', [$conversation->job_id, $conversation->service_provider_id])}}" onclick="toggle_animation(true);">View Messages</a>
      </div>
      <div class="col-6 p-1">
         <button type="button" class="btn btn-block btn-secondary fs--1 btn-sm text-success-d text-white shadow"  data-dismiss="modal">Close View</button>
      </div>
   </div>
</div>
<div class="d-flex rounded bd-highlight m-2 sticky-top shadow-d shadow-sm">
   <div class="p-2 bd-highlight">
      <img src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/{{$user->profile_image_path}}" class="bg-white p-1 shadow-sm" height="50" width="50"  style="border-radius:50%;" alt="Service Provider profile image" onerror="this.src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMQAAADECAMAAAD3eH5ZAAAAYFBMVEVmZmb///9jY2NdXV1gYGBaWlpVVVX29vZ2dnaCgoKkpKTi4uJUVFSVlZXf399tbW3y8vKzs7Obm5uIiIjY2Njs7Oy/v7/Kysrt7e24uLjV1dV6enpubm7ExMSRkZGLi4sh2BX/AAAGEUlEQVR4nO2c6YKqOgyAIV0ANxwFFXX0/d/yoJBS5uhIa2177s331y2haZI2iUlCEARBEARBEARBEARBEARBEARBEARBEAThEeBMCHlHCMYhtDzGABcs38521TxrmVe72TZn4p9SBAQUzTxLR2TzXdG+EFq2iXCZNOv0IesmkTy0fBOARVE91qCjKhaxrwaI/PibCjeOedxGBezrlQo3vljEWrCknqJDmtbtW+MExHIs6mq3KUq5WMiy2OxW49eWcZrUD1OqNq1WfYi7hT1INqMNH6VJgdhpIjYnwWAkJQATp0Z7yy6+tQChrcO+fCwgiHKvrUV0WojhIdcn+VQ6kKdh7zfCp4SvETMl2jf7NSZzNpjdLCoteKEJ9sJIQFO4iCgHAaHEukx4uOKi3h7RthBqu+aTDETkygVEY1Bsq0LYxEDMVFjcRhK6AdDhfE1+rsoh1xCHQbFNL1A13cJBYPjeRLEUwPAIlxg8VEj6D2VRpB9qIcyeqeXHPoScd8KsDR2N6I+wtfyMXCZAaeiZEOWhyvD2xBq7hRiWogluTwC9Nc2MRWF9+jEP7mWVNeXGkkAeiz2hk1lZ2ARbReKfMG36slHiK5IECp+mTVKNCfw88EpAeTCP1urDfdQ+BN4UkHc5R22nRJc5ZuZOwSn81D3Mo9URjfdXnqewBzzeHyX2VmbNeq+wDazEtRNjZ+Vg8KrqGsdKvKcErcT7/Df2RO+dKjvvVEXhnTBOHOzixCGKOOEkYteh01ixsjdr3FA2GbBTxHefxVq4J7x8+g6dxfL+pDw37xYA3h8Kl6GvldX9kbmHQc9mtZ+cAtBvCvOKCdZlVsHP2Op4lpnaE/D+5tDmUOgYZU+mJ2V1BRjcmlokVqjNCiaqMLOK4AZQ+SdDs1BV7+C+6Y7A8kRuIA7HS6c6dJDoUJeqBrFCxQjjK9xPgdc26X6yeUus8gVPORAVtSYnH0P7QeAsXGNoTZlSAdZrwBHECASkalrcPG+JGN6NESLNXr/bH/yMYr1untHbcc7RGNMNNjQJrJLfSonAkqF96xKPMd3RGjay5fMWFc6WQ7tsXP0pNzQt0ip/3P3KZa51n8WnQ+v6NS3S41X8aKoGLsRVbzedxZAz/QUb9TGum6K897m33Drfy2LcthxLpP4JK8bt4Yeq2Wzzssy3m6Y6jF7Kikh1aLXgPxpHn7Hi0epwaxS/PGl1H1naJep2ceCL/OViVGXUOnBeHLNXOrR7pTn/3uwYELa4TtwSbdL+JJIEhsvlhO2gGVUeU/J3B9jpwSpk63petczr9QMr25VxuSjO/5qbqL+XRV4Cl0JIDue82Ox/ziWsl1F0nfWI89iSst21lF207t7QRW15Xu7HauxFLDtDbzm+m8lp8WQYrc2f5HWsRxFHFghcF6ueJa96xfNG3yAv27J9MFy+3Oxok7yWCcRZn6NowmvBE207NDBtp8LoXLEPrQXLB9Oonox+PILLi/bBsE6KazoYDqYwGE5Ix5BaDM3JaXY1NQp9kOoYLnqDUFH6YBF9QVy1ZfyAfJPAymmazu3SuWGOIt0E0mKIcdY2zYZQH+a8Olwjr+yHxQfvdghSflxgPreGNxIgpkaq9gt3sk3+deVb3tGhNUqlxdW7Qaly1du/rWoVa+9lVOy3Spu3L/LUZI5vP6umA+v3/wFiqAt47nvC8RWjiukzVF1ges3PBdi/6GiAgx1DLIXqInCTuSmD8tm/ryY/XG1FVRH2mM6yPmky7qx5BuBS+KumQpK5XYhhlsTfFCdHb+JuHyqX7W1CGy346HAbst5n2/VrmwOYP7vsjsZamVWXsAXYzpq5/D3l8DzZkxrKcupJcKrFfOjQCvmR8Ticf6y8pB6qc9Gt9Sp78rKz0Rtmjk9iC5+bAhsXXTrYG3isuPhQAve16wzhU9/7EMwQXLeCYrOvlx5++ca06W+oaQovSmSuE6cOHM9e+/CxqITr/ABdd+ZDid4VZs73H16x+7hEQyWc/9bCoxIyvf1nZ3ZwvurycP/i1Eve0f176gd+6mNfTBAEQRAEQRAEQRAEQRAEQRAEQRAEQRDE/5E/uag0Dy41gk8AAAAASUVORK5CYII='" >
   </div>
   <div class="p-3 bd-highlight">
      <span>{{$user->first}} {{$user->last}}</span> <br>
      <span class="fs--1">Member Since: {{date('Y', strtotime($user->created_at))}}</span>
   </div>
</div>
<div class="d-flex bd-highlight rounded m-2 shadow-sm-d shadow-sm">
   <div class="p-3 bd-highlight">
      <span class="fs-2">{{$stats->percentage}}%</span> <br>
      Completion Rate
   </div>
   <div class="p-3 bd-highlight">
      <span class="fs-2">{{$stats->rating}}   </span> <br>
      @for($i=0;$i<intval($stats->rating);$i++)
         <i class="fas fa-star text-warning"></i> 
      @endfor
   </div>
</div>
@if($user->user_bio != null)
<div class="m-2 p-2 rounded shadow-sm-d shadow-sm">
   <div class="d-flex bd-highlight rounded">
      <div class="p-1 bd-highlight">
         <span>About {{$user->first}} {{$user->last}}:</span>
      </div>
   </div>
   <p class="p-1 pr-1">
      {{$user->user_bio}}
   </p>
</div>
@endif
<div class="m-2 p-2 rounded shadow-sm-d shadow-sm">
   <div class="d-flex bd-highlight rounded">
      <div class="p-1 bd-highlight">
         <span>Services offered by {{$user->first}}</span>
      </div>
   </div>
   @foreach($user_services as $user_service)
   <span class="badge bg-white theme-color  m-1  fs--1 shadow-sm rounded-pill "  >
   {{$user_service->service_sub_cat->service_category->service_name}} - {{$user_service->service_sub_cat->service_subname}}
   </span>
   @endforeach  
</div>
<div class="m-2 p-2 shadow-sm-d shadow-sm rounded">
   <div class="d-flex bd-highlight rounded">
      <div class="p-1 bd-highlight">
         <span>Education & Certifications</span>
      </div>
   </div>
   <br>
   @foreach($certificates as $certificate)
   <li class="list-group-item fs--2">
      <div class="d-flex p-0 bd-highlight">
         <div class="p-1 flex-grow-1 bd-highlight"> {{$certificate->certificate_name}}</div>
         <div class="p-1 bd-highlight">{{ date('d/m/Y', strtotime($certificate->certificate_expiry)) }}</div>
      </div>
   </li>
   @endforeach
</div>
<div class="m-2 p-2 shadow-sm-d shadow-sm rounded">
   <div class="d-flex bd-highlight rounded">
      <div class="p-1 bd-highlight">
         <span>Languages</span>
      </div>
   </div>
   <div>
      @foreach($current_languages as $language)
      <span class="badge bg-white theme-color  m-1  fs--1 shadow-sm rounded-pill "  > {{$language->language_name}} </span>
      @endforeach  
      <span class="badge bg-white theme-color  m-1  fs--1 shadow-sm rounded-pill "  > English (Default) </span>
   </div>
</div>
</div>