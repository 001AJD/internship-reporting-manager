<?php
require 'connection.php';
$feedback_link = $_POST['google_link_feedback'];

$msg = "Please provide feedback for interns using the following link ".$feedback_link;

$sql_session = "select session, batch from tbl_student order by id desc limit 1";
$query_session = mysqli_query($conn,$sql_session);
$rs_session = mysqli_fetch_assoc($query_session);

$session = $rs_session['session'];
$batch = $rs_session['batch'];

$sql_data = "select distinct(company_mentor_email) from tbl_student where session = '$session' and batch = '$batch'";
$query_data = mysqli_query($conn,$sql_data);

while($rs_data = mysqli_fetch_assoc($query_data))
{
	$email = $rs_data['company_mentor_email'];
	echo $email."<br>";
	// mail($email,"YCCE interns feedback link",$msg);	
}
?>