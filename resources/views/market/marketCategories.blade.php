@extends('market/marketMaster')
@section('title')
LocaL2LocaL – Service Categories for Jobs
@endsection
@section('scripts')
@endsection
@section('content')
<div class="container bg-white p-4">
   <div class="p-2 m-1">
      <h3>Service Categories</h3>
   </div>
   <div class="">
      <?php
         $serviceList = DB::table("service_categories")->orderBy('service_name', 'asc')->get();
        
       ?>
      <div class="w3-row">
         <?php  foreach($serviceList as $serve) {
            $serviceSubList = DB::table("service_subcategories")->where('service_cat_id',$serve->id)->orderBy('priority', 'asc')->get();
            $serviceSubListPrepare = [];
            
            //this function check if the user has any services already registred for. If the loop found anythihg that is already in the user account the item will be removed from the list. 
            for ($j = 0; $j < count($serviceSubList); $j++) {
               
               
                        //add the services to the list to display them in html file.
                        $serviceSubListPrepare[$j][0] =  $serviceSubList[$j]->id;
                        $serviceSubListPrepare[$j][1] =  $serviceSubList[$j]->service_subname;
                 
            
            } ?>
         <div class="w3-col s12">
            <input class="w3-btn w3-block m-1 w3-large border-bottom" type="button" data-toggle="collapse" href="#hm<?php echo($serve->id); ?>" role="button" aria-expanded="false" aria-controls="<?php echo($serve->id); ?>" style="text-align: left;" id="{{$serve->id}}"  value="{{$serve->service_name}}" >
            </input>
            <!--display="show"  visibility: hidden-->
            <div   class="collapse multi-collapse w3-light-grey" id="hm<?php echo($serve->id);?>">
               <ul class="w3-ul w3-show"id="list<?php echo($serve->id);?>">
                  @foreach($serviceSubListPrepare as $publish)
                  <div class='w3-row '>
                     <div class='w3-col s12  w3-padding w3-margin-top w3-round w3-center '>
                        <p class='w3-left w3-animate-bottom' >{{$publish[1]}}</p>
                     </div>
                  </div>
                  @endforeach  
               </ul>
            </div>
         </div>
         <?php  } ?>          
      </div>
   </div>
</div>
@endsection