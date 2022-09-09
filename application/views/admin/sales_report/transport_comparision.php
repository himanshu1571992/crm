<?php init_head(); ?>
<div id="wrapper" class="customer_profile">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
         <div class="panel_s">
            <div class="panel-body">
              <div class="col-md-12">
                <h4 class="bold"><?php echo $title; ?></h4><hr>
                <div id="container">
                  <div class="col-md-11">
                    <canvas id="canvas"></canvas>
                  </div>
                  <div class="col-md-11">
                    <hr>
                    <div class="col-md-6">
                      <a target="_blank" href="<?php echo admin_url("sales_report/freight_collected_report?from_date=".$from_date."&to_date=".$to_date); ?>" class="col-md-12 btn btn-success">TRANSPORT COLLECTED</a>
                    </div>
                    <div class="col-md-6">
                      <a target="_blank" href="<?php echo admin_url("sales_report/transport_paid?from_date=".$from_date."&to_date=".$to_date); ?>" class="col-md-12 btn btn-danger">TRANSPORT PAID</a> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
         </div>
      </div>
    </div>
  </div>
</div>

<?php init_tail(); ?>
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script> -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js'></script> -->
<script src="<?php echo base_url('assets/js/chart.min.js'); ?>"></script>
<script id="rendered-js" >
var barChartData = {
  // labels: ["Apr-2022","May-2022","Jun-2022","July-2022","Aug-2022","Sep-2022"],
  labels: [<?php echo $month_arr; ?>],

  datasets: [
  		// {
    // 		label: '処方箋枚数(前年)',
    // 		yAxisID: "line",
    // 		backgroundColor: "pink",
    // 		borderColor: "red",
    // 		type: 'line',
    // 		fill: false,
    // 		data: [0, 0, 0, 0, 0, 0, 0, 0]
  		// },

  		// {
    // 		label: '処方箋枚数',
    // 		yAxisID: "line",
    // 		backgroundColor: "lightgreen",
    // 		borderColor: "green",
    // 		type: 'line',
    // 		fill: false,
    // 		data: [0, 0, 0, 0, 0, 0]
    // 	},
  		// {
    // 		label: "TRANSPORT PAID THROUGH SYSTEM",
    // 		yAxisID: 'bar-stack',
    // 		backgroundColor: "pink",
    // 		borderColor: "red",
    // 		borderWidth: 1,
    // 		stack: 'bef',
    // 		data: [0, 0, 0, 0, 0, 0, 0, 0]
    // 	},
  		{
    		label: "TRANSPORT COLLECTED",
    		yAxisID: 'bar-stack',
    		backgroundColor: "lightgreen",
    		borderColor: "green",
    		borderWidth: 1,
    		stack: 'bef',
    		// data: [250, 120, 180, 200, 165, 100]
    		data: [<?php echo $ttltransfer_collected; ?>]
    	},
      {
		    label: "TRANSPORT PAID THROUGH SYSTEM",
		    yAxisID: "bar-stack",
		    backgroundColor: "pink",
		    borderColor: "red",
		    borderWidth: 1,
		    stack: 'now',
		    data: [<?php echo $ttlpaidthroughsystem; ?>] 
		  },
      {
		    label: "TRANSPORT PAID THROUGH WORK ADVANCE",
		    yAxisID: "bar-stack",
		    backgroundColor: "yellow",
		    borderColor: "orange",
		    borderWidth: 1,
		    stack: 'now',
		    data: [<?php echo $ttlpaidworkadvanced; ?>] 
		  },
  		{
    		label: "TRANSPORT OVERHEAD ADDED",
    		yAxisID: 'bar-stack',
    		backgroundColor: "lightblue",
    		borderColor: "blue",
    		borderWidth: 1,
    		stack: 'now',
    		data: [<?php echo $ttloverheadamt; ?>]
    	}
	  ]
  };




var chartOptions = {
  responsive: true,
  scales: {
    yAxes: [
    {
      id: "bar-stack",
      position: "left",
      stacked: true,
      ticks: {
        beginAtZero: true } },



    {
      id: "line",
      position: "right",
      stacked: false,
      ticks: {
        beginAtZero: true },

      gridLines: {
        drawOnChartArea: false } }] } };





window.onload = function () {
  var ctx = document.getElementById("canvas").getContext("2d");
  window.myBar = new Chart(ctx, {
    type: "bar",
    data: barChartData,
    options: chartOptions });

};
//# sourceURL=pen.js
    </script>

</body>
</html>

