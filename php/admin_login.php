<?php
require ("connection.php");
session_start();
//post variables
$username = $_POST["username"];
$password = $_POST["password"];


if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$sql_login = "select id from tbl_admin where email = '$username' and password = '$password'";
	$rs_sql_login = mysqli_query($conn,$sql_login);

	try
	{
		$num_rows = mysqli_num_rows($rs_sql_login);
		if($num_rows == 1)
		{
			$_SESSION["account_type"] = "admin";
			session_write_close();
			?>
			<script type="text/javascript">
				window.location.href = "../admin-dashboard.php";
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
		echo "Error Occured". $e;
	}
}
else
{
	echo "invalid request!";
}
?>