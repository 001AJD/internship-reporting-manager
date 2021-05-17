<?php 
require 'connection.php';
session_start();
$notice_path;
if($_SESSION["account_type"] != "admin")
{?>
	<script type="text/javascript">
		window.location.href = "../login.html";
	</script>

<?php }
	else
	{
		$session = $_POST['session'];
		$batch = $_POST['batch'];
		$notice_text = $_POST['notice_text'];
		$notice_by = $_POST['notice_by'];

		if(file_exists($_FILES['noticeToUpload']['tmp_name']))
		{
			require ('upload_notice.php');
			$notice_path = uploadNotice($session,$batch);
			
		}
		else
		{
			// echo "file not selected";
		}
		$sql_notice = "insert into tbl_notices (session, batch, posted_by, notice_text,notice_path) values('$session','$batch','$notice_by','$notice_text','$notice_path')";
		$query_notice = mysqli_query($conn,$sql_notice);
		if($query_notice)
		{?>
				<script type="text/javascript">
					alert("notice sent successfully!");
					 window.location.href = "../admin-dashboard.php";
				</script>
		<?}
		else
		{?>
				<script type="text/javascript">
					alert("Problem in sending notice to students. Try again after sometime!");
					window.location.href = "../admin-dashboard.php";
				</script>
		<?}
		echo $sql_notice;

	}		
?>