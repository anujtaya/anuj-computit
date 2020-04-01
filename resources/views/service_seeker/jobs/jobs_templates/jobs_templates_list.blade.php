<ul id="service_seeker_filter_ul_list" class="list-group fs--1" style="overflow:scroll; height:640px;">
  @foreach($jobs as $job)
   <li class="list-group-item mt-2 border mb-2    ml-2 mr-2 " style="border: 1px solid #89E3E3!important; border-radius: 22px!important;" onclick="location.href='./jobs/job/{{$job->id}}'; toggle_animation(true);">
     <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
        <span class="badge p-2" style="border-radius:20px!important;">
          @if($job->status == "APPROVED")
          <span class="badge badge-success p-2 font-weight-normal" style="border-radius:8px!important;">
           {{$job->status}}
          </span>
          @elseif($job->status == "PENDING")
          <span class="badge badge-success p-2 font-weight-normal" style="border-radius:8px!important; background-color: #EB88A0; color: white;">
           {{$job->status}}
          </span>
          @elseif($job->status == "WORK-IN-PROGRESS")
          <span class="badge p-2 font-weight-normal" style="border-radius:8px!important; background-color: #EBCD88; color: white">
           {{$job->status}}
          </span>
          @endif
        </span>
     </div>
      <div class="d-flex bd-highlight">
         <div class="pb-2 w-100 bd-highlight theme-color font-weight-bold" style="font-size: 0.9rem;">{{$job->title}}</div>
      </div>
      <div class="d-flex flex-column bd-highlight">
         <div class="text-muted bg-light p-2 mb-1 rounded">
           <span id="more_job_{{$job->id}}">
           {{ str_limit($job->description, 41, '') }}
         </span>
         </div>
      </div>

      <div class="p-0 flex-shrink-1 bd-highlight text-secondary">
         <span id="more_link_job_{{$job->id}}" class="font-weight-normal float-right" onclick="job_description_more(event, '{{$job->id}}', '{{$job->description}}' );" style="border-radius:20px!important; color: #5D29BA!important; cursor: pointer">
          <u>More</u>
         </span>
         <span id="less_link_job_{{$job->id}}" class="font-weight-normal float-right" onclick="job_description_less(event, '{{$job->id}}', '{{$job->description}}' );" style="display: none; border-radius:20px!important; color: #5D29BA!important; cursor: pointer">
          <u>Less</u>
         </span>
      </div>
   </li>
   @endforeach
 </ul>

 <script>

 function job_description_more(e, a, b){
   event.stopPropagation();
   $("#more_job_"+a).text(b);
   $("#more_link_job_"+a).css("display", "none");
   $("#less_link_job_"+a).css("display", "block");
 }

 function job_description_less(e, a, b){
   event.stopPropagation();
   $("#more_job_"+a).text(b.substr(0, 41));
   $("#less_link_job_"+a).css("display", "none");
   $("#more_link_job_"+a).css("display", "block");
 }

 </script>
