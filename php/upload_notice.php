<?php
//script to upload excel file 




// echo $dir_session."<br>";
// echo $dir_batch."<br>";	



function uploadNotice($session, $batch)
{
	$dir_session = "../uploads/notices/$session";
	$dir_batch = $dir_session ."/$batch"; 
	$date = time();
	$return_value = "uploads/notices/$session/$batch/".$date.".pdf";
	//checking if sessions exists!
	 if(!is_dir($dir_session))
	 {
	 	mkdir($dir_session);
	 }
	 else
	 {
	 	 // echo "Session already exists!";
	 }

	 //checking if batch exists in sessiosn
	 if(!is_dir($dir_batch))
	 {
	 	mkdir($dir_batch);
	 }
	 else
	 {
	 	 // echo "Batch already exists!";
	 }

	 if(is_dir($dir_session) && is_dir($dir_session))
	 {
	 	$upload_ok = 1;
	 	$target_dir = $dir_batch;
	 	$target_file = $target_dir . basename($_FILES["noticeToUpload"]["name"]);
	 	$filename = $_FILES["noticeToUpload"]["tmp_name"];
	 	
	 	
	 
	 	$file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
	 	// echo "<br><br>File Type".$file_type;
	 	
	 	if($file_type != "pdf") //checking for file type;
	 	{
	 		$upload_ok = 0;
	 		// echo "<h1>File type does not match. Try uploading pdf file!(.pdf)</h1>";
	 		?>
	 		 <script type="text/javascript">
	 			alert("File type does not match. Try uploading pdf file!");
	 			window.location.href = "../admin-dashboard.php";
	 		</script>
	 	<?}
	 	if($upload_ok == 0)
	 	{
	 		// echo "<br>sorry! your file is not uploaded";
	 		?>
	 		<script type="text/javascript">
	 			alert("sorry! your file is not uploaded");
	 			window.location.href = "../admin-dashboard.php";
	 		</script>
	 	<?}
	 	else
	 	{
	 		if(move_uploaded_file($filename, $dir_batch."/".$date.".pdf"))
	 		{
	 			// echo "The $filename is uploaded successfully!";
	 			return $return_value;
	 			?>
			 		<script type="text/javascript">
			 			alert("The notice is uploaded successfully!");
			 			// window.location.href = "../admin-dashboard.php";
			 		</script>
	 		<?}
	 		else
	 		{
	 			// echo "<br>Error code ==>".$_FILES[$filename]["error"];
	 			// echo "Error in uploading file!";
	 			return 0;
	 		?>
	 			<script type="text/javascript">
	 				alert("sorry! your file is not uploaded");
	 				window.location.href = "../admin-dashboard.php";
	 			</script>
	 		<?}
	 	}
	 }
	 else
	 {
	 	die("Failed to load session and batch. Try again later!");
	 }

}
?>