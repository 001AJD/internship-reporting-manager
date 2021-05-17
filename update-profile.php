<?php 
require 'php/connection.php';
session_start();

if(is_null($_SESSION["student_id"]))
{
?>
  <script type="text/javascript">
    window.location.href = "login.html";
  </script>

<?php }
else
{ 
	$name = "Your data is not uploaded";
	$email = "Your data is not uploaded";
	$sql_data = "select name, student_email from tbl_student where id = ".$_SESSION["student_id"];
	
	$query_data = mysqli_query($conn,$sql_data);
	if(mysqli_num_rows($query_data)  > 0)
	{
		$rs_data = mysqli_fetch_assoc($query_data);
		$name = $rs_data["name"];
		$email = $rs_data["student_email"];
	}

	?>
<!DOCTYPE html>
<html>
<head>
	<title>Update profile</title>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/update-profile.css">
</head>
<body>
	<!-- Navigation Bar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">Internship Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="upload-report.php">Upload Report</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="update-profile.php">Update Profile<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    
     
      <a href="php/logout.php" class="nav-link btn btn-outline-danger my-2 my-sm-0">Logout</a>
    
  </div>
</nav>

<!-- Navigation Bar Ends here -->

<div class="container">
	<div class="jumbotron">
		  <h1 class="display-4">Update profile</h1>
		  <hr class="my-4">
		  <table>
		  	<tr>
		  		<td><input class="form-control fixed" type="text" placeholder="<?echo $name;?>" readonly></td>
		  		
		  	</tr>
		  	<tr>
		  		<td>
		  			<input class="form-control fixed" type="text" placeholder="<?echo $email;?>" readonly>	
		  		</td>
		  	</tr>

		  </table>
		  <form method="POST" action="php/update_password.php">
			  <div class="form-group">
			    <!-- Update password -->
			    <input type="password" class="form-control" name="update_password" id="exampleInputPassword1" placeholder="Update Password" required="true">
			    <button class="btn btn-primary" type="submit">submit</button>
			  </div>
			</form>

		    
		<form method="POST" action="php/update_mentor_name.php">
		   <div class="form-group">
		    <!-- Mentor Name -->
		    <input type="text" class="form-control" name="mentor_name" id="exampleInputText" placeholder="Mentor Name" required="true">
			<button class="btn btn-primary" type="submit">submit</button>
		  </div>
		</form>

		<form method="POST" action="php/update_mentor_email.php">
		   <div class="form-group">
		    <!-- Confirm Password -->

		    <input type="email" class="form-control" name="mentor_email" id="exampleInputEmail" placeholder="Mentor Email" required="true" required="true">
			<button class="btn btn-primary">submit</button>
		  </div>
		</form>
	</div>
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