<div class="wrapper">
   <canvas id="chart-area-monthly"></canvas>
</div>
<div class="form-group row">
   <label for="staticEmail" class="col-sm-4 col-form-label">Enter Start Date</label>
   <div class="col-sm-6">
      <input type="date" id="start_date_input" value="{{\Carbon\Carbon::now()->subDays(30)->format('Y-m-d')}}" class="form-control forn-control-sm rounded-0">
   </div>
</div>
<div class="form-group row">
   <label for="inputPassword" class="col-sm-4 col-form-label">Enter End Date</label>
   <div class="col-sm-6">
      <input type="date" id="end_date_input" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control forn-control-sm rounded-0">
   </div>
</div>
<div class="form-group row">
   <label for="inputPassword" class="col-sm-4 col-form-label"></label>
   <div class="col-sm-6">
      <button class="btn btn-secondary card-1" onclick="chart_fetch_monthly(document.getElementById('start_date_input').value, document.getElementById('end_date_input').value);">Update Chart</button>
   </div>
</div>
<script>
   var app_url = "{{secure_url('/')}}";
   var csrf_token = "{{csrf_token()}}";
   var s_d_m = "{{\Carbon\Carbon::now()->subDays(30)->format('Y-m-d')}}";
   var e_d_m = "{{\Carbon\Carbon::now()->format('Y-m-d')}}";
   
   
   function chart_fetch_monthly(a,b) {
   $.ajax({
           type: "Post",
           url: "{{route('app_portal_admin_chart_reg_trend_fetch')}}",
           data: {
               'start_date' : a,
               'end_date' : b,
               "_token": csrf_token
           },
           success: function(results) {
   
           console.log(results);
               convert_to_array_monthly(results.data);
           },
           error: function(results, status, err) {
               //console.log(err);
           }
       });
   }
   function convert_to_array_monthly(data){
       var a = [];
       var b = [];
       var c = [];
       var d = [];
       for(var i =0;i<data.length;i++){
           a.push(data[i].count);
           b.push(data[i].date);
           c.push(getRandomColor());
           d.push(data[i].trend);
       }
       populate_user_allocation_chart_monthly(a,b,c,d);
   }
   var chart_monthly;
   
   
   
   function populate_user_allocation_chart_monthly(a,b,c,d) {
   if(chart_monthly != null){
       chart_monthly.destroy();
   }
       var config = {
           type: 'bar',
           data: {
               labels: b,
           datasets: [{
               label: 'User Count',
               data:
                   a,
               backgroundColor:"#007bff",
               pointBackgroundColor: "#fdcb6e",
               fill: true,
               borderColor: "#6c5ce7",
               yAxisID: "y-axis-1",
   
           },
           {
               label: 'User Registration Trend',
               data:  d,
               type: 'line',
               yAxisID: "y-axis-0",
               backgroundColor:"#00b894",
               borderColor:"#00b894",
               fill: false,
               pointRadius: "0.05"
   
           },
   
           ],
           },
           options: {
               responsive: true,
               scales:{
                   yAxes: [{
            position: "right",
            "id": "y-axis-0",
            display: true,
            ticks: {
               // steps: 10,
               // stepValue: 5,
               //max: 100,
               callback: (label, index, labels) => {
                  return label + "";
               }
            }
         }, {
            position: "left",
            "id": "y-axis-1",
            display: true,
            ticks: {
               // steps: 10,
               // stepValue: 5,
               // //max: 100,
               callback: (label, index, labels) => {
                  return label + "";
               }
            }
         }]
               }
           }
       };
       var ctx = document.getElementById('chart-area-monthly').getContext('2d');
       chart_monthly = new Chart(ctx, config);
   }
   
   function getRandomColor() {
       return "#6c5ce7";
   }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>