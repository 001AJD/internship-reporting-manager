<?php
//script to upload excel file 



$dir_session = "../uploads/sessions/$session";
$dir_batch = $dir_session ."/$batch"; 
echo $dir;	


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
 	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
 	$filename = $_FILES["fileToUpload"]["tmp_name"];
 
 	$file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); 
 	// echo "<br><br>File Type".$file_type;
 	if(file_exists($target_file))
 	{
 		echo "file alread exists";
 		$upload_ok = 0;
 	}
 	if($file_type != "xlsx") //checking for file type;
 	{
 		$upload_ok = 0;
 		echo "<h1>File type does not match. Try uploading excel file!(.xlsx)</h1>";
 	}
 	if($upload_ok == 0)
 	{
 		echo "<br>sorry! your file is not uploaded";
 	}
 	else
 	{
 		if(move_uploaded_file($filename, $dir_batch."/".$session.$batch.".xlsx"))
 		{
 			// echo "The $filename is uploaded successfully!";
 		}
 		else
 		{
 			echo "<br>Error code ==>".$_FILES[$filename]["error"];
 			echo "Error in uploading file!";
 		}
 	}
 }
 else
 {
 	die("Failed to load session and batch. Try again later!");
 }

?>