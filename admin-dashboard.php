<?php 
require 'php/connection.php';
session_start();
if($_SESSION["account_type"] != "admin")
{?>
	<script type="text/javascript">
		window.location.href = "login.html";
	</script>
<?php }
	else
	{?>
		<!DOCTYPE html>
<html>
<head>
	<title>Admin Pannel</title>
	<script type="text/javascript" src="lib/googlechart/googlechartloader.js"></script>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/admin-dashboard.css">
	
</head>
<body>
<?php
	$date = date("y-m-d");
	$sql_uploaded_report = "select count(*) as uploaded_count from tbl_student_report_log where date = '$date'";
	$query_uploaded_report = mysqli_query($conn,$sql_uploaded_report);
	$rs_count = mysqli_fetch_assoc($query_uploaded_report);
	$upload_count = $rs_count['uploaded_count'];


	$sql_data = "select session, batch from tbl_student order by id desc limit 1";
	$query_data = mysqli_query($conn,$sql_data);
	$rs_data = mysqli_fetch_assoc($query_data);

	$session = $rs_data['session'];
	$batch = $rs_data['batch'];

	$sql_student_count = "select count(DISTINCT(enrollment)) as total_student from tbl_student where session = '$session' and batch = '$batch'";
	$query_student_count = mysqli_query($conn,$sql_student_count);
	$rs_student_count = mysqli_fetch_assoc($query_student_count);

	$total_student = $rs_student_count['total_student'];
	$not_upload_count = intval($total_student) - intval($upload_count);
?>

	<!-- Navigation Bar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="admin-dashboard.php">Internship Management System</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   	 	<span class="navbar-toggler-icon"></span>
  	  </button>

  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
    		<ul class="navbar-nav mr-auto">
      			<li class="nav-item active">
        			<a class="nav-link" href="admin-dashboard.php">Home <span class="sr-only">(current)</span></a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="new-session.php">New session</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="feedback.php">Feedback</span></a>
        		</li>
        		<li class="nav-item">
        			<a class="nav-link" href="view-report.php">View Report</span></a>
        		</li>
    		</ul>
     		<a href="php/logout.php" class="nav-link btn btn-outline-danger my-2 my-sm-0">Logout</a>
  		</div>
	</nav>
	<!-- Navigation Bar Ends here -->

	<div class="container">
		<!-- JumboTron -->
		<!-- <div class="jumbotron"> -->
  			<!-- <h1 class="display-4">Hello, Admin!</h1> -->
  			<!-- <hr class="my-4"> -->
  			<!-- <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  			<hr class="my-4">
  			<p>It uses utility classes for typography and spacing to space content out within the larger container.</p> -->
  
		<!-- </div> -->
		<!-- Jumbotron Ends here -->
		<div class="row">

			 <div class="col-lg-8">
			 	<!-- Pie Chart -->

				<div id="piechart" ></div>

			 </div>

			 <div class="col-lg-4">
			 	<!-- Notice Board -->
<?php

$sql_session = "select DISTINCT(session) from tbl_student order by session DESC limit 5";
$query_session = mysqli_query($conn,$sql_session);
$arr_session = array();

while($rs_session = mysqli_fetch_assoc($query_session))
{
	$arr_session[] = $rs_session['session'];
}

?>
			 	<form method="POST" action="php/post_notice_text.php" enctype="multipart/form-data">
				 	<div class="form-group post-box">
	 					 <STRONG><label for="comment">Send Notice:</label></STRONG>
	  					 <textarea name="notice_text" class="form-control" rows="5" id="comment" required="true"></textarea>
	  					 <input  type="file" class="form-control-file" name="noticeToUpload" id="noticeToUpload">
	  					 <input name="notice_by" type="text" class="form-control"placeholder="Notice By:" style="margin-top: 15px;" required="true">
	  					 <select required="true" name="session">
	  					 	<option value="" disabled selected>Session</option>
	  					 	<? foreach ($arr_session as $session) {?>
	  					 		<option value="<?echo $session;?>" required><?echo $session;?></option>
	  					 	<?}?>
	  					 </select>
	  					 <select required="true" name="batch">
	  					 	<option value = "" disabled selected>Batch</option>
	  					 	<option value = "B1">B1</option>
	  					 	<option value = "B2">B2</option>
	  					 </select>
	  					 <span><button type="submit" class="btn btn-primary post-button float-right">Post</button></span>
					</div>
			 </div>
		</div>
	</div>
	
<script type="text/javascript">
   					
   					google.charts.load('current', {'packages':['corechart']});
					google.charts.setOnLoadCallback(drawChart);

					var upload_count = <?echo $upload_count?>;
					var total_count = <?echo $not_upload_count;?>;
					 function drawChart() {
					    var data = google.visualization.arrayToDataTable([
					      ['Task', 'Hours per Day'],
					      ['Uploaded',   upload_count],
					      ['Not uploaded',total_count]
					    ]);

					    var options = {
					      title: 'Report upload status from php'
					    };
					    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
					    chart.draw(data, options);
			  		
			  			}
			  			
					
				</script>
	
</body>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type=text/javascript src="js/lib/bootstrap.min.js"></script>
</html>

	<?php }
?>
