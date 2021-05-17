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
$sql_userName = "select name, session, batch from tbl_student where id = ".$_SESSION["student_id"];
  $query_userName = mysqli_query($conn,$sql_userName);
  $rs_userName = mysqli_fetch_assoc($query_userName);
 ?>
  <!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  
  <!-- <style type="text/css">
    body
    {
      background-image: url("https://images.unsplash.com/photo-1515704089429-fd06e6668458?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=3860371df6121bd9176d5889b487c3e1&auto=format&fit=crop&w=1050&q=80");
      background-size: cover;
      background-repeat: no-repeat;
    }
  </style> -->
  
<body>
  
    <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="home.php">Internship Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="upload-report.php">Upload Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="update-profile.php">Update Profile<span class="sr-only">(current)</span></a>
      </li>
    </ul>
      <a href="php/logout.php" class="nav-link btn btn-outline-danger my-2 my-sm-0">Logout</a>
    
  </div>
</nav>

<!-- Navigation Bar Ends here -->
  <div id="main">
  <div class="container">
    <!-- JumboTron -->
    <!-- <div class="jumbotron">
        <h1 class="display-4">Hello, <span id="userName"><?echo $rs_userName['name']?></span></h1>
        <hr class="my-4">
        <p class="lead">Welcome to the Internship Management System !</p>
         -->
  
    <!-- </div> -->
    <!-- Jumbotron Ends here -->
    
    <?php
    $sql_data = "select report_title, description, date from tbl_student_report_log where id = ".$_SESSION["student_id"]." order by date desc";
    
    $query_data = mysqli_query($conn,$sql_data);
    if(mysqli_num_rows($query_data) > 0)
    {
      while($rs_data = mysqli_fetch_assoc($query_data))
      {?>
         <!-- Card starts here -->
         <div class="card">
        <h5 class="card-header">Date Submitted: <?echo $rs_data["date"]?></h5>
        <div class="card-body">
          <h5 class="card-title"><?echo $rs_data["report_title"]?></h5>
          <p class="card-text"><?echo $rs_data["description"]?></p>
          
        </div>
    </div>
    <!-- Card Ends -->

      <?}

    }
    else
    {?>
    <!-- Card starts here -->
    <div class="card">
        <h5 class="card-header">You have no submissions yet!</h5>
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text">Start submitting your daily report for good grades!</p>
          
        </div>
    </div>
    <!-- Card Ends -->
    <?}?>

    
  </div>

  </div>

  <div id="floatingDiv">
    <button type="button" onclick="toggle()" class="btn btn-warning  bmd-btn-fab" id="floatingBtn">
        <i class="material-icons">Notification</i>
    </button>
  </div>

  <!-- Side bar starts here -->
  <div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="container">
<?php 
$sql_notice = "select posted_by, notice_date, notice_text, notice_path from tbl_notices where session = '".$rs_userName['session']."' and batch = '".$rs_userName['batch']."' order by notice_date DESC";

$query_notice = mysqli_query($conn,$sql_notice);
if(mysqli_num_rows($query_notice) > 0)
{
  while($rs_notice = mysqli_fetch_assoc($query_notice))
    {?>
      <div class="card notice">
          <div class="card-header">
           Notice : <?echo $rs_notice["notice_date"]; ?>
           </div>
          <div class="card-body">
            <blockquote class="blockquote mb-0">
            <p><?echo $rs_notice["notice_text"];?></p>
           <footer class="blockquote-footer">By  <cite title="Source Title"><?echo $rs_notice["posted_by"];?></cite> </footer>
           <?if($rs_notice['notice_path'] != NULL)
           {
            ?><a href="<?echo $rs_notice['notice_path'];?>" target = '_blank'>open</a><?
           }
           ?>
           
            </blockquote>
          </div>
        </div> <!-- card notice ends here-->

    <?}
}
else
{
?>
       <div class="card notice">
          <div class="card-header">
           No Notices yet! 
           </div>
          <div class="card-body">
            <blockquote class="blockquote mb-0">
            <p>Stay tuned for notices!</p>
           <footer class="blockquote-footer">by <cite title="Source Title"> Admin</cite> </footer>
            </blockquote>
          </div>
        </div> <!-- card notice ends here-->
</div><!-- container ends here -->
 <?}?>    

  </div>
  <!-- Side bar ends here -->
<script type="text/javascript" src="js/nav-bar.js"></script>


</head>
</body>
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script type=text/javascript src="js/lib/bootstrap.min.js"></script>
</html>


<?php }
?>
