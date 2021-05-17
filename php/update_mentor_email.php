<?php 
require 'connection.php';
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

	$mentor_email = $_POST["mentor_email"];
	$student_id = $_SESSION["student_id"];

	$sql_update_mentor_email = "update tbl_student set company_mentor_email = '$mentor_email' where id = $student_id" ;
	
	$query_update_mentor_email = mysqli_query($conn,$sql_update_mentor_email);
	
	if($query_update_mentor_email)
	{?>
		<script type="text/javascript">
			alert("Mentor's email updated successfully!");
			window.location.href = "../update-profile.php";
		</script>


	<?php }
	else
	{
		?>
		<script type="text/javascript">
			alert("Mentor's email cannot be updated! Try again later.");
			window.location.href = "../update-profile.php";
		</script>


	<?
	}
}?>