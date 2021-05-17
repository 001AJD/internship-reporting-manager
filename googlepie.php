<?php 
echo "in googlepie.php";
?>
<script type="text/javascript" src="lib/googlechart/googlechartloader.js"></script>
       <div id="piechart" style="width: 900px; height: 500px;"></div>
   
<script type="text/javascript">

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

var upload_count = 100;
var total_count = 200;
  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Hours per Day'],
      ['Uploaded',   upload_count  ],
      ['Not uploaded',total_count]
    ]);

    var options = {
      title: 'Report upload status from php'
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart'));

    chart.draw(data, options);
  }
</script>