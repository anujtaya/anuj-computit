@extends('market/marketMaster')
@section('title')
LocaL2LocaL – Current OPerating Cities in Australia
@endsection
@section('scripts')
@endsection
@section('content')
<style>
   .home_back {
   }  
   .super_margin_top {
   margin-top:60px!important;
   }
   .marketing_image {
   background: url("./marketImages/a.jpg");
   min-height:200px!important;
   background-size: cover;
   }
   .font_title {
   font-size: 30px!important;
   }
   .font_title_small {
   font-size: 20px!important;
   }
   .padding_mega {
   padding: 0px 0px 0px 0px !important;
   }
   .icon_font_large {
    font-size: 100px!important;
   }
</style>
<div class=" w3-border-light-grey w3-center   home_back super_margin_top">
   <i class="material-icons icon_font_large ">
      location_city
      </i>
   <p class=" w3-text-grey font_title  padding_mega">Operating Cities</p>
</div>

<div class="w3-border-light-grey w3-black  home_back ">
   <div class="row">
      <div class="col-sm w3-padding w3-margin">
         <div style="font-size:25px;" class="w3-center">
          
             <p>BRISBANE</p>
              <p>GOLD COAST</p>
              <p>IPSWITCH</p>
              <p>SUNSHINE COAST</p>
             <p> LOGAN CITY</p>
             
           </div>
         </div>
      </div>
</div>




@endsection