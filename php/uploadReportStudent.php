<?php
session_start();
require 'connection.php';

$session = "2018-19"; //retrieve from session
$batch = "B1"; //retrieve from session
$enrollment = "16030021"; // retrieve the enrollment number from session


$student_id = $_SESSION["student_id"];//retrieve from session
//post variables
$report_title = mysqli_escape_string($conn,$_POST["input_title"]);
$description = mysqli_escape_string($conn,$_POST["input_description"]);


$sql_data = "select enrollment, session, batch from tbl_student where id = $student_id";
$query_data = mysqli_query($conn,$sql_data);
$rs_data = mysqli_fetch_assoc($query_data);

$session = $rs_data["session"];
$batch = $rs_data["batch"];
$enrollment = $rs_data["enrollment"];

$dir_session = "../uploads/studentReport/$session"; 
$dir_batch = $dir_session . "/".$batch;
$dir_enrollment = $dir_batch . "/". $enrollment;

//checking if session exists
if(!is_dir($dir_session))
{
	mkdir($dir_session);
}
else
{
	echo "session exists!";
}


//checking if batch exists
if(!is_dir($dir_batch))
{
	mkdir($dir_batch);
}
else
{
	echo "batch already exists!";
}

//checking if enrollment dir exists
if(!is_dir($dir_enrollment))
{
	mkdir($dir_enrollment);
}
else
{
	echo "enroll dir exists!";
}

if(is_dir($dir_session) && is_dir($dir_batch) && is_dir($dir_enrollment))
{
	$upload_ok = 1;
	$log_student_report = 0;
	$target_dir = $dir_enrollment;
	$target_file = $target_dir. basename($_FILES["report"]["name"]);
	$filename = $_FILES["report"]["tmp_name"];

	$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	echo "<br>filetype = ".$filetype."<br>";
	$date = date("y-m-d");
	echo "Date ==> ".$date;
	$week_obj = new DateTime($date);
	$week_num = $week_obj->format("W");
	echo "<br> week num =>". $week_num;
	echo "<br>file exists or not =>".is_file($dir_enrollment."/$date.pdf");

	if(is_file($dir_enrollment."/$date.pdf"))
	{
		$upload_ok = 0;
		echo "file already exists!";
	}
	if($filetype != "pdf")
	{
		echo "Invalid file type. Try uploading .pdf file.";
		//add danger alert;
		$upload_ok = 0;
	}
	if($upload_ok == 0)
	{
		echo "The file cannot be uploaded!";
		?>
			<script type="text/javascript">
				alert("Report cannot be uploaded!");
				window.location.href = "../upload-report.php";
			</script>
		<?
	}
	else
	{
		$queryLogReport = "insert into tbl_student_report_log (id,report_title, description,date) values($student_id,'$report_title','$description', '$date')";
		echo $queryLogReport;
		if(move_uploaded_file($filename, $dir_enrollment."/$date.pdf"))
		{
			mysqli_query($conn,$queryLogReport);
			echo "file uploaded successfully";
			?>
				<script type="text/javascript">
					alert("Report uploaded successfully");
					window.location.href = "../upload-report.php";
				</script>
			<?
		}
		else
		{
			echo "problem uploading file!";
		}
	}
}
?>