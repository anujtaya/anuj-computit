@extends('frontend.master')
@section('title')
LocaL2LocaL – Contact Us
@endsection
@section('topnav')
<nav id="mobile-menu" class="main-menu">
    <ul>
        <li>
            <a href="{{route('app_frontend_homepage')}}">Home</a>
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
        <li class="current">
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
                    <h2>Keep in touch with us, <br>we are available 24/7 </h2>
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
<!--contact-page-area-->
<div class="contact-page-area pt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-lg-1">
                <div class="contact_inside_pg">
                    <h4>Contact Us</h4>
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Name" />
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" placeholder="Email" />
                            </div>
                            <div class="col-md-6">
                                <input type="number" class="form-control" placeholder="Phone" />
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" placeholder="Subject" />
                            </div>
                            <div class="col-md-12 mb-4">
                                <textarea rows="4" class="form-control" placeholder="Comment"></textarea>
                                <button class="btn btn-style2" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!--/.contact_inside_pg-->
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="contact_page_sidebar">
                    <ul>
                        <li>
                            <div class="icon"><i class="far fa-envelope"></i></div>
                            <a href="mailto@info@yourmail.com">info@local2local.com.au</a>
                        </li>
                        <li>
                            <div class="icon"><i class="fas fa-phone-alt"></i></div>
                            <a href="tel:123456788">(07) 3871 1222</a>
                        </li>
                        <li>
                            <div class="icon"><i class="fas fa-home"></i></div>
                            <address>
                                166 Wickham Terrace, Spring Hill 4000, QLD
                            </address>
                        </li>
                    </ul>
                </div>
                <!--/.contact_page_sidebar-->
            </div>
            <div class="col-md-12 col-lg-11 offset-lg-1">
                <div class="map-style">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.126345183447!2d153.02236521546905!3d-27.465325682892704!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b915a02ee5f0749%3A0x17696fb0ddd808d0!2s166%20Wickham%20Terrace%2C%20Brisbane%20City%20QLD%204000!5e0!3m2!1sen!2sau!4v1601429825834!5m2!1sen!2sau"
                                width="750" height="450" frameborder="0" style="border:0;" allowfullscreen=""
                                aria-hidden="false" tabindex="0"></iframe></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.container-->
</div>
<!--contact-page-area-->
@endsection
