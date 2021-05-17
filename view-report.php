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
	<title>View Report</title>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/view-report.css">
</head>
<body>
			<!-- Navigation Bar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="admin-dashboard.php">Internship Management System</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   	 	<span class="navbar-toggler-icon"></span>
  	  </button>

  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
    		<ul class="navbar-nav mr-auto">
      			<li class="nav-item">
        			<a class="nav-link" href="admin-dashboard.php">Home </a>
      			</li>
      	
      			<li class="nav-item">
        			<a class="nav-link" href="new-session.php">New session</a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="feedback.php">Feedback</a>
      			</li>
              </a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="view-report.php">View Report<span class="sr-only">(current)</span>
              </a>
            </li>
    		</ul>
     		 <a href="php/logout.php" class="nav-link btn btn-outline-danger my-2 my-sm-0">Logout</a>
    
  		</div>
	</nav>
	<!-- Navigation Bar Ends here -->
	<div class="container" style="margin-top: 25px">
		<div class="jumbotron">
  			<h1 class="display-4">View Report</h1>
  			<hr class="my-4">

  			 <form method="POST" action="view-report.php">
    				<div class="form-group">
      				<label for="input_enroll">Enter Enrollment Number</label>
      				<input type="text" name="enrollment" class="form-control" id="input_title" aria-describedby="input_title" placeholder="Enter Enrollment Number" required>
      			</div>
  				<button type="submit" class="btn btn-primary btn-block" id="btnShowReport">Show Report</button>
			</form>
		</div>
	</div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $enrollment = $_POST['enrollment'];
  $sql_data = "select id, session, batch from tbl_student where enrollment = '$enrollment'";
  $query_data = mysqli_query($conn,$sql_data);
  if(mysqli_num_rows($query_data))
  {
    $rs_data = mysqli_fetch_assoc($query_data); 
    $session = $rs_data['session'];
    $batch = $rs_data['batch'];
    $student_id = $rs_data['id'];

    $dir = "/ims/uploads/studentReport/$session/$batch/$enrollment";
    
    $sql_report_log = "select report_title, description, date from tbl_student_report_log where id = $student_id order by date desc"; 
    $query_report_log = mysqli_query($conn,$sql_report_log);
    if(mysqli_num_rows($query_report_log))
    {
    	while($rs_report_log = mysqli_fetch_assoc($query_report_log))
		    {?>
		      <div class="container">
		        <div class="card">
		        <h5 class="card-header">Date Submitted: <?echo $rs_report_log['date'];?></h5>
		        <div class="card-body">
		          <h5 class="card-title"><?echo $rs_report_log['report_title'];?></h5>
		          <p class="card-text"><?echo $rs_report_log['description'];?></p>
		          <a href="<?echo $dir."/".$rs_report_log['date'].".pdf";?>" target = "_blank">open</a>
		        </div>
		      </div>
		    </div>

		    <?}	
    }
    else
    {
    	?>
    <div class="container">
      <div class="card">
          <h5 class="card-header">No Record Found</h5>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">Student have not submitted the report yet!</p> 
          </div>
      </div>
    </div>
    
  <?	
    }
    

  }
  else
  {?>
    <div class="container">
      <div class="card">
          <h5 class="card-header">No Record Found</h5>
          <div class="card-body">
            <h5 class="card-title"></h5>
            <p class="card-text">Check the enrollment number and try again later</p> 
          </div>
      </div>
    </div>
    
  <?}

}
?>

</body>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type=text/javascript src="js/lib/bootstrap.min.js"></script>
</html>
<?php }
?>
