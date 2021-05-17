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
	<title>Feedback</title>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
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
        			<a class="nav-link active" href="feedback.php">Feedback<span class="sr-only">(current)</span></a>
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
		<div class="jumbotron" style="margin-top: 25px;">
  			
  			<!-- <hr class="my-4"> -->
  			<form method="POST" action="php/send_feedback.php">
  				<div class="form-group">
    				<label for="link">Google Form Link:</label>
    				<input type="text" name="google_link_feedback" class="form-control" id="google-doc-link" aria-describedby="link-Help" placeholder="Paste the link of Google Form for feedback!" required>
    				<small id="link-Help" class="form-text text-muted">This link will be sent to the respected mentors of students at Internship.</small>
  				</div>
  					<button type="submit" class="btn btn-primary">Send</button>
			</form>
  
		</div>
		<!-- Jumbotron Ends here -->
	</div>

</body>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type=text/javascript src="js/lib/bootstrap.min.js"></script>
</html>
<?php }
?>
