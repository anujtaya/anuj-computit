
<div id="anim-1" style="background:rgba(255, 252, 252, 0.68);position:fixed;top:0;left:0;z-index:10000!important;height:100%;width:100%;display:none!important;">
   <div class="text-center" style="margin-top:250px;">
      <img src="{{asset('images/svg/eclipse_loader.svg')}}?v=12" height="60" width="60" alt="">
   </div>
   <div class="text-center ml-4 mr-4 d-none" style="margin-top:20px;" id="anim-2">
   </div>
</div>
<script>
    function toggle_animation(a,m){
       var e = document.getElementById("anim-1");
       if(a == true) {
          e.style.display = "block";
       } else {
         e.style.display = "none";
       }
       if(m != null) {
         document.getElementById("anim-2").innerHTML = m;
       }
    }
 </script>
