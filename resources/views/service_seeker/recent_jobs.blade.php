<style>
   .carousel-indicators li {
   background-color: #399BDB!important;
   }
</style>
<div class="mt-0 fs--1  bg-darks text-center">
   <div id="carouselExampleIndicators" class="carousel slide"  data-ride="carousel">
      <div class="carousel-inner ">
         <div class="carousel-item p-2  fs--1 active p-3">
            <div class="borders p-2 rounded ">
               <div class="d-flexs bd-highlight mb-3">
                  <div class="p-2 bd-highlight"> 
                     <img src="https://i.pravatar.cc/{{rand(300,400)}}" height="45" style="border-radius:50%;" class="mr-2 border" width="45" alt=""> <br>
                     <span class="text-warning">{{(rand(1*10,5*10))/10}} <i class="fas fa-star mt-2"></i></span>
                  </div>
                  <div class="p-2 bd-highlight ">
                     <h5 class=" fs--1 font-weight-bold">Cleaning - Bathroom Cleaning</h5>
                     <p class="fs--2 mt-1 mb-0">
                        Completed a job near you.
                     </p> 
                     <span class="fs--2 text-muted">{{rand(1,60)}} minutes ago.</span>
                  </div>
               </div>
            </div>
         </div>
          @for($i=0;$i<5;$i++)
          <div class="carousel-item p-2  fs--1  p-3">
            <div class="borders p-2 rounded ">
               <div class="d-flexs bd-highlight mb-1">
                  <div class="p-2 bd-highlight"> 
                     <img src="https://i.pravatar.cc/{{rand(300,400)}}" height="45" style="border-radius:50%;" class="mr-2 border" width="45" alt=""> <br>
                     <span class="text-warning">{{(rand(1*10,5*10))/10}} <i class="fas fa-star mt-2"></i></span>
                  </div>
                  <div class="p-2 bd-highlight ">
                     <h5 class=" fs--1 font-weight-bold">Cleaning - Bathroom Cleaning</h5>
                     <p class="fs--2 mt-2 mb-0">
                        Completed a job near you.
                     </p>
                     <span class="fs--2 text-muted">{{rand(1,60)}} minutes ago.</span>
                  </div>
               </div>
            </div>
         </div>
         @endfor
      </div>
      <br>
      <!-- <ol class="carousel-indicators m-0">
         <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
         <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      </ol> -->
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
      </a>
   </div>
</div>