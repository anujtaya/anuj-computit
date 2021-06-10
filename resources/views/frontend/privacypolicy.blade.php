@extends('frontend.master')
@section('title')
LocaL2LocaL – Privacy Policy
@endsection
@section('topnav')
<nav id="mobile-menu" class="main-menu">
    <ul>
        <li>
            <a href="{{route('app_frontend_homepage')}}">Home</a>
            <!-- <ul class="sub-menu">
            <li><a href="index.html">home1</a></li>
            <li><a href="index-2.html">Home 02</a></li>
            <li><a href="index-3.html">Home 03</a></li>
            <li><a href="index-4.html">Home 04</a></li>
            </ul> -->
        </li>
        <li>
            <a href="{{route('app_frontend_homepage')}}#features_id">Features</a>
        </li>
        <li>
            <a href="{{route('app_frontend_homepage')}}#overview_id">Overview</a>
        </li>
        <li>
            <a href="{{route('app_frontend_homepage')}}#pricing_id">Service Fee</a>
        </li>
        <li>
            <a href="{{route('app_frontend_homepage')}}#screenshot_id">App</a>
        </li>
        <li>
            <a href="#">More</a>
            <ul class="sub-menu">
                <li><a href="https://blog.local2local.com.au">Blog</a></li>
                <li><a href="{{route('app_frontend_faq')}}">FAQ</a></li>
                <li><a href="{{route('app_frontend_support')}}">Support</a></li>
                <li><a href="{{route('app_frontend_privacypolicy')}}">Privacy Policy</a></li>
            </ul>
        </li>
        <li>
            <a class="btn btn-style1"
                href="https://itunes.apple.com/au/app/local2local-australia/id1367359034?mt=8">Download</a>
        </li>
    </ul>
</nav>
@endsection
@section('content')
<!--hero_section-->
<header class="broadcamp_pages blog">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="broadcamp_inside_co title">
                    <h2>LocaL2LocaL Privacy Policy </h2>
                </div>
            </div>
        </div>
    </div>
    <!--/.container-->
    <div class="shape">
        <img src="{{config('app.frontend_resource_url')}}/img/home2/elements/elem1.png" class="shape1" alt="" />
        <img src="{{config('app.frontend_resource_url')}}/img/home2/elements/elem2.png" class="shape2" alt="" />
        <img src="{{config('app.frontend_resource_url')}}/img/home2/elements/elem3.png" class="shape3" alt="" />
        <img src="{{config('app.frontend_resource_url')}}/img/home2/elements/elem4.png" class="shape4" alt="" />
    </div>
</header>
<!--hero_section-->
<!--blog-content-->
<section class="blog_pages_main pt-5 ">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-7">
                <div class="single_blog_page_in blog_single">
                    <div class="images">
                        <div class="overlay">
                            <ul class="meta">
                                <!-- <li>Novermber 05, 2018</li> -->
                                {{-- <li>By <a href="#">Admin</a></li> --}}
                            </ul>
                            <h4>Privacy Policy</h4>
                        </div>
                    </div>
                </div>
                <!--/.single_blog_page_in-->
            </div>
        </div>
    </div>
    <!--/.container-->
</section>
<!--blog-content-->
<div class="container h1-title">
    <div class="mb-md">
        @include('partial.termsofuse')
    </div>
</div>
@endsection
