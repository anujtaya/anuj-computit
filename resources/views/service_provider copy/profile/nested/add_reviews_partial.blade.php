  <!-- reviews -->
  <div class=" m-2 p-3  rounded">
      <span>Customer Reviews</span>
      <br><br>
      <ul class="list-group">
         @for($i=0;$i<5;$i++)
            <li class="list-group-item  mt-1 shadow-sm border  fs--1 animated">
               <div class="d-flex bd-highlight mb-2">
                  <div class="p-0 mt-1 bd-highlight">
                     <img src="https://i.pravatar.cc/{{rand(300,400)}}" height="45" style="border-radius:50%;" class="mr-2 border" width="45" alt=""> 
                  </div>
                  <div class="p-1 bd-highlight">
                     <span style="">John Doe</span> <br>
                     <span class="text-warning"><i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i> <i class="fas fa-star mt-2"></i>  <i class="fas fa-star-half-alt"></i> </span>
                  </div>
                  <div class="ml-auto p-0 bd-highlight">
                  </div>
               </div>
               <p class="bg-light p-3 text-muted bg-light fs--1">
                  It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
               </p>
            </li>
         @endfor
      </ul>
   </div>