<?php 
require 'php/connection.php';
session_start();

if(is_null($_SESSION["student_id"]))
{?>
  <script type="text/javascript">
    window.location.href = "login.html";
  </script>

<?php }
else
{ ?>
<!DOCTYPE html>
<html>
<head>
	<title>Upload Report</title>
	<link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
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
      
      <li class="nav-item active">
        <a class="nav-link" href="upload-report.php">Upload Report<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="update-profile.php">Update Profile</a>
      </li>
    </ul>
      <a href="php/logout.php" class="nav-link btn btn-outline-danger my-2 my-sm-0">Logout</a>
     
    
  </div>
</nav>

<!-- Navigation Bar Ends here -->

<div class="container" style="margin-top: 25px">
	<div class="jumbotron">
  <h1 class="display-4">Upload Report</h1>
  
  <hr class="my-4">
  <form action="php/uploadReportStudent.php" method="post" enctype="multipart/form-data">
  <div class="form-group">
    <label for="input_title">Enter Title</label>
    <input type="text" class="form-control" id="input_title" name="input_title" aria-describedby="input_title" placeholder="Enter Title (60 characters)" required="true">
    
  </div>
  <div class="form-group">
    <label for="input_description">Enter Description</label>
    <textarea class="form-control" rows="5" id="input_description" name="input_description" placeholder="Enter Description(260 characters)" required="true"></textarea>
  </div>
  
  <div class="form-group">
    <label for="upload_report">Upload Report</label>
   	<input type="file" class="form-control-file" id="report" name="report" required="true">
    <small id="upload_report" class="form-text text-muted">(.pdf format is mandatory!)</small>
    <span id="lblError" style="color: red;"></span>
  </div>



  <button type="submit" class="btn btn-primary btn-block" id="btnUpload">Upload</button>
</form>
  
</div>
</div>
<!-- <script type="text/javascript" src="js/upload-report.js"></script> -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">
	$("body").on("click", "#btnUpload", function () {
        var allowedFiles = [ ".pdf"];
        var fileUpload = $("#upload_report_file");
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