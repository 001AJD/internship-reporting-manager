<?php 
/**
 * @author - Ajinkya Dhomne
 * @copyright 2018
 **/
require 'connection.php';
require '../lib/Classes/PHPExcel.php';
require '../PHPMailer/PHPMailerAutoload.php';

//smtp config
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "dev.ajinkya0@gmail.com";
$mail->Password = "12340nlydev!@#";
$mail->SetFrom("IMS@gmail.com");

$year1 = $_POST['year'];
$year2 = $_POST['year2'];
$session = $year1."-".$year2;
$batch = $_POST["optradio"];

//array
$arr_name = array();
$arr_enrollment = array();
$arr_student_email = array();
$arr_company = array();
$arr_college_mentor_email = array();
$arr_session = array();
$arr_batch = array();



$filePath = "../uploads/sessions/$session/$batch/$session$batch.xlsx";

//code to upload files goes here...
require("uploadExcel.php");


//code to read excel file
try
{
	$excelReader = PHPExcel_IOFactory::createReaderForFile($filePath);
	$excelObj = $excelReader->load($filePath);
	$worksheet = $excelObj->getActiveSheet();
	$lastRow = $worksheet->getHighestRow();
	$index = 0;
	for($row = 2; $row <= $lastRow; $row++)
	{
	//loading students data to db
		$name = $worksheet->getCell('D'.$row)->getValue();
		$enrollment = $worksheet->getCell('B'.$row)->getValue();
		$student_email = $worksheet->getCell('C'.$row)->getValue();
		$company = $worksheet->getCell('E'.$row)->getValue();
		$college_mentor_email = $worksheet->getCell('F'.$row)->getValue();
		$session = $worksheet->getCell('G'.$row)->getValue();
		$batch = $worksheet->getCell('H'.$row)->getValue();

		$query = "insert into tbl_student(name,enrollment,student_email,company,college_mentor_email,session,batch) values('$name','$enrollment','$student_email','$company','$college_mentor_email','$session','$batch')";
		// echo $query;
		$val = mysqli_query($conn,$query);
		// echo "val = ".$val."<br>";
		if($val)
		{
			// echo "data loaded successfully!";
		}
		else
		{
			 // die("<br>error in loading data! Try again later!". mysqli_error($conn)."<br>");
			$arr_name[$index] = $name;
			$arr_enrollment[$index] = $enrollment;
			$arr_student_email[$index] = $student_email;
			$arr_company[$index] = $company;
			$arr_college_mentor_email[$index] = $college_mentor_email;
			$arr_session[$index] = $session;
			$arr_batch[$index] = $batch;
			$index++;
			// echo "<br>error in loading data! Try again later!". mysqli_error($conn)."<br>";
		}
	}
	
if(count($arr_name) == 0)
{
	
	//code to generate password for students to log in...
	require("generatePassword.php");

	$email = array();
	$pass = array();
	$id = array();
	$queryStudentsOfCurrentSession = "select id,student_email from tbl_student where session = '$session' and batch = '$batch'";
	// echo "students emails".$queryStudentsOfCurrentSession;
	$rs = mysqli_query($conn,$queryStudentsOfCurrentSession);

	if(mysqli_num_rows($rs))
	{
		$index = 0;
		
		while($data = mysqli_fetch_assoc($rs))
		{
			
			$email[$index] = $data["student_email"];
			$pass[$index] = generatePassword();
			$id[$index] = $data["id"];
			$index++;
		}
		
	}
	else
	{
		echo "<br>failed to load the emails of students";
	}

	//loading username and password
	for($index = 0; $index < count($email); $index++)
	{
		$sqlUsernamePass = "insert into tbl_students_login(id,email,password) values($id[$index],'$email[$index]','$pass[$index]')";
		$rsUsernamePass = mysqli_query($conn,$sqlUsernamePass);
		
		$msg = "The username is same as your email id and password is ".$pass[$index];
		// mail($email[$index],"Username and password for IMS YCCE.",$msg);
		$mail->Subject = "Username and password for IMS YCCE.";
		$mail->Body = $msg;
		$mail->AddAddress($email[$index]);

		if(!$mail->Send()) {
			echo "Mailer Error: " . $mail->ErrorInfo;
	 } else {
			// echo "Message has been sent";
	
	 }
	 $mail->ClearAllRecipients();
	}
}
	//code to load username and password to tbl_student_login?>
	<!DOCTYPE html>
	<html>
	<head>
		<title>Acknowledgement!</title>
		<link rel="stylesheet" type="text/css" href="../css/lib/bootstrap.min.css">
	</head>
	<body>
		<!-- Navigation Bar -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
	  <a class="navbar-brand" href="../admin-dashboard.php">Internship Management System</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
   	 	<span class="navbar-toggler-icon"></span>
  	  </button>

  		<div class="collapse navbar-collapse" id="navbarSupportedContent">
    		<ul class="navbar-nav mr-auto">
      			<li class="nav-item">
        			<a class="nav-link" href="../admin-dashboard.php">Home</a>
      			</li>
      	
      			<li class="nav-item active">
        			<a class="nav-link" href="../new-session.php">New session<span class="sr-only">(current)</span></a>
      			</li>
      			<li class="nav-item">
        			<a class="nav-link" href="../feedback.php">Feedback</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../view-report.php">View Report</a>
            </li>
    		</ul>
     		 <a href="logout.php" class="nav-link btn btn-outline-danger my-2 my-sm-0">Logout</a>
  		</div>
	</nav>
	<!-- Navigation Bar Ends here -->
	<div class="container">
		
	
	
	<?php if(count($arr_enrollment) > 0)
	{
		?><h1 class="form-group">The following students data cannot be uploaded!</h1><?
		echo "
		<table class = 'table' border = '1'>
		<thead>
			<td>Name</td>
			<td>enrollment</td>
			<td>student email</td>
			<td>company</td>
			<td>college mentor email</td>
			<td>session</td>
			<td>batch</td>
		</thead>";
		for($index = 0; $index < 8; $index++)
		{
			echo"
			<tr>
				<td>$arr_name[$index]</td>
				<td>$arr_enrollment[$index]</td>
				<td>$arr_student_email[$index]</td>
				<td>$arr_company[$index]</td>
				<td>$arr_college_mentor_email[$index]</td>
				<td>$arr_session[$index]</td>
				<td>$arr_batch[$index]</td>
			</tr>
			";
		}
		echo "</table>
		<a href = '../new-session.php' class = 'btn btn-danger'>Go Back</a>
		</div>
		</body>
	</html>
		";
	}
	else
	{?>
			<script>
			alert("Students Data uploaded successfully!");
			window.location.href = "../admin-dashboard.php";
			</script>	
	<?}
}
catch(Exception $e)
{
	// echo "Error ". $e;
}
?>