<?php
require ("connection.php");
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$sql_login = "select id from tbl_students_login where email = '$username' and password = '$password'";
	$query_sql_login = mysqli_query($conn,$sql_login);
	
	try
	{
		if(mysqli_num_rows($query_sql_login) > 0)
		{
			$rs_login = mysqli_fetch_assoc($query_sql_login);
			$_SESSION["student_id"] = $rs_login["id"];
			session_write_close();
			?>
				<script type = "text/javascript">
					window.location.href = "../home.php";
				</script>
		<?php }
		else
		{?>
			<script type="text/javascript">
				alert("Wrong Credentials. Try again!");
				window.location.href = "../login.html";				
			</script>
		<?}
	}
	catch(Exception $e)
	{
		echo "Login Failed!".$e->mysqli_error();
	}
}
else
{
	echo "Invalid Request to server!";
}
?>