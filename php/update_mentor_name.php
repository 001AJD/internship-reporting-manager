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

	$mentor_name = $_POST["mentor_name"];
	$student_id = $_SESSION["student_id"];

	$sql_update_mentor_name = "update tbl_student set company_mentor_name = '$mentor_name' where id = $student_id" ;
	
	$query_update_mentor_name = mysqli_query($conn,$sql_update_mentor_name);
	
	if($query_update_mentor_name)
	{?>
		<script type="text/javascript">
			alert("Mentor's name updated successfully!");
			window.location.href = "../update-profile.php";
		</script>


	<?php }
	else
	{?>
			<script type="text/javascript">
				alert("Mentor's name cannot be updated! Try again later!");
				window.location.href = "../update-profile.php";
			</script>
	<?}
}?>