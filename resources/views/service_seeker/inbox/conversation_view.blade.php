@extends('layouts.service_seeker_master')
@section('content')
<script src="{{asset('/js/third/pulltorefresh.umd.js')}}"></script>

<style>
    .friend-list {
        list-style: none;
        margin-left: -40px;
    }

    .friend-list li {
        border-bottom: 1px solid #eee;
    }

    .friend-list li a img {
        float: left;
        width: 45px;
        height: 45px;
        margin-right: 10px;
    }

    .friend-list li a {
        position: relative;
        display: block;
        text-decoration: none !important;
        padding: 10px;
        transition: all .2s ease;
        -webkit-transition: all .2s ease;
        -moz-transition: all .2s ease;
        -ms-transition: all .2s ease;
        -o-transition: all .2s ease;
    }

    .friend-list li.active a {
        background-color: #f1f5fc;
    }

    .friend-list li a .friend-name,
    .friend-list li a .friend-name:hover {
        color: #777;
        width: 55%;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .friend-list li a .last-message {
        width: 60%;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }

    .friend-list li a .time {
        position: absolute;
        top: 10px;
        right: 8px;
    }

    small,
    .small {
        font-size: 65%;
    }

    .friend-list li a .chat-alert {
        position: absolute;
        right: 8px;
        top: 27px;
        font-size: 10px;
        padding: 3px 5px;

    }
</style>


<div class="container">
    <div class="row  justify-content-center">
        <div class="col-lg-12 sticky-top bg-white p-3 border-d">
            <div class="row">
                <div class="col-2">
                    <a href='{{ route("service_provider_home") }}' onclick="toggle_animation(true);">
                        <i class="fas fa-arrow-left fs-1 theme-color"></i> </a>
                </div>
                <div class="col-8 font-size-bolder text-center font-weight-bold theme-color">
                    <strong>Inbox</strong><br><span class="fs--2 text-muted font-weight-normal"> Message history</span>
                </div>
                <div class="col-2 text-right">

                </div>
            </div>
        </div>

        <div class="card mx-auto col-12">

            <ul class="friend-list" id="conversation_list">
                @if(!empty($conversation))
                @foreach ($conversation as $item)
                <li>
                    <a href="{{route('service_provider_job_conversation',[$item->job_id, $item->service_provider_id])}}"
                        class="clearfix">
                        <img style="border-radius:50%;"
                            src="https://s3-ap-southeast-2.amazonaws.com/l2l-resources/{{$item->job->service_seeker_profile->profile_image_path}}"
                            onerror="this.src='data:image/png;base64,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'"
                            alt="" class="img-circle">
                        <div class="friend-name">
                            {{$item->job->title}}
                        </div>
                        <?php
                        $latest_text = $item->conversation_messages()->latest()->first();
                        if($latest_text != null){
                          if(date('d/m/Y', strtotime($latest_text->created_at)) == date('d/m/Y')){
                            $date = date('h:i a', strtotime($latest_text->created_at));
                          }else{
                            $date = date('d/m/Y', strtotime($latest_text->created_at));
                          }

                        ?>
                        <div class="last-message text-muted"><small>{{ $latest_text->text }}</small></div>
                        <small class="time text-muted">{{ ($latest_text->text != null) ? $date : " " }}</small>
                        <?php
                            }
                        ?>
                    </a>
                </li>
                @endforeach
                @else
                <div class="text-center p-3">
                    <img src="{{asset('images/svg/l2l_empty.svg')}}" alt="" style="opacity:0.4;height:150px;"
                        class="img-fluid" alt="Service provider empty jobs image art">
                    <br>
                    <br>
                    <span>Looks like you haven’t communicate anybody.</span>
                    <br><br>
                </div>
                @endif
            </ul>


        </div>
    </div>
</div>

@include('service_seeker.bottom_navigation_bar')

<script>
    PullToRefresh.init({
   mainElement: '#conversation_list', // above which element?
   onRefresh: function (done) {
      done(); 
      location.reload();
      toggle_animation(true);
   }
   });
</script>