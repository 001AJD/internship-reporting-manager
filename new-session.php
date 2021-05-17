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
	<title>Add New Session</title>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/new-session.css">
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
        			<a class="nav-link" href="admin-dashboard.php">Home</a>
      			</li>
      	
      			<li class="nav-item active">
        			<a class="nav-link" href="new-session.php">New session<span class="sr-only">(current)</span></a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="feedback.php">Feedback</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="view-report.php">View Report</a>
            </li>
    		</ul>
     		 <a href="php/logout.php" class="nav-link btn btn-outline-danger my-2 my-sm-0">Logout</a>
  		</div>
	</nav>
	<!-- Navigation Bar Ends here -->

	<div class="container">
		<!-- JumboTron -->
		<div class="jumbotron" style="margin-top: 25px;">
  			
  			<center><h3 style="color: black;">Start New Session.</h3>
  			<hr class="my-4">
  		<form action="php/loadStudents.php" method="POST" enctype="multipart/form-data">
  			
    			<h4 style="color: black;">Select Session : </h4>
    			<table>
    				<tr>
    					<td>From</td>
    					<td>To</td>
    				</tr>

    				<tr>
    					<td>
							<select name="year" id="year" required>
                <option value="" selected disabled>Select year</option>
                <?php
                
                
                $current_year1 = date('Y'); 
                ?>
    							<option value="<?echo $current_year1; ?>"><?echo $current_year1;?></option>
                
							</select>
						</td>
            
						<td>
							<select name="year2" id="year2" required>
                  <option value="" disabled selected>Select Year</option>
                  <?php 
                  
                  $current_year2 = date('Y') + 1; 
                ?>
                  <option value="<?echo $current_year2 ;?>"><?echo $current_year2; ?></option>
                 
              </select>
						</td>
    				</tr>
    			</table>

    			<div class="form-group" style="margin-top: 15px;">
    				<label for="session">Batch :</label><br>
    				<label class="radio-inline"><input type="radio" name="optradio" value="B1" required>B1</label>
					   <label class="radio-inline"><input type="radio" name="optradio" value="B2" required>B2</label><br>

    				<label for="exampleFormControlFile1">Upload File : </label>
    				<input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" style="align-self: center; margin-left: 40%;" required><br>

    				<button class="btn btn-success" id="btnUpload" type="submit">Submit</button><br><br>
    				<span id="lblError" style="color: red;"></span>


    			</div>
  
  			
		</form>
  			</center>
  
		</div>
		<!-- Jumbotron Ends here -->
	</div>
	<!-- Container Closed -->


<!-- <script type="text/javascript" src="js/new-session.js"></script> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
    $("body").on("click", "#btnUpload", function () {
        var allowedFiles = [ ".xlsx"];
        var fileUpload = $("#fileUpload");
        var lblError = $("#lblError");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + allowedFiles.join('|') + ")$");
        if (!regex.test(fileUpload.val().toLowerCase())) {
            lblError.html("Please upload files having extensions: <b>" + allowedFiles.join(', ') + "</b> only.");
            return false;
        }
        lblError.html('');
        return true;
    });
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