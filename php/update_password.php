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
	$updated_password = $_POST["update_password"];
	$student_id = $_SESSION["student_id"];

	if(!is_null($updated_password))
	{
		$sql_update_password = "update tbl_students_login set password = '$updated_password' where id = $student_id";
	$query_update_password = mysqli_query($conn,$sql_update_password);
	if($query_update_password)
	{?>
		<script type="text/javascript">
			alert("Password updated sucessfully!");
			window.location.href = "../update-profile.php";
			
		</script>

	<?php }
	else
	{?>
			<script type="text/javascript">
				alert("Password cannot be updated! Try again later!");
				window.location.href = "../update-profile.php";
				
			</script>
	<?}
	}
}?>