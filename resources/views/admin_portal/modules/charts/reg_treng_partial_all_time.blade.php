
  
<div class="wrapper">
    <canvas id="chart-area"></canvas>
</div>
 <script>
    var csrf_token = "{{csrf_token()}}";
    var s_d = "{{\Carbon\Carbon::now()->subYears(3)->format('Y-m-d')}}";
    var e_d = "{{\Carbon\Carbon::now()->format('Y-m-d')}}";

    window.onload = function() {
        chart_fetch(s_d,e_d);
        chart_fetch_monthly(s_d_m,e_d_m);
    };
    function chart_fetch(a,b) {
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
                convert_to_array(results.data);
            },
            error: function(results, status, err) {
                //console.log(err);
            }
        });
    }
    function convert_to_array(data){
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
        populate_user_allocation_chart(a,b,c,d);
    }
    var chart;



    function populate_user_allocation_chart(a,b,c,d) {
    if(chart != null){
        chart.destroy();
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

            },{
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
        var ctx = document.getElementById('chart-area').getContext('2d');
        chart = new Chart(ctx, config);
    }

    function getRandomColor() {
        return "#6c5ce7";
    }
 </script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
