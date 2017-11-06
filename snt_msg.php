<?php
	session_start();
	require_once("php/db.php");
	echo $_SESSION['id'];
	echo $_SESSION['receiver'];
	if(isset($_POST['sndmsg']))
		{
			$sender = $_SESSION['id'];
			$message = $_POST['message'];
			$indata = "INSERT INTO messege VALUES(SL,'".$sender."','".$_SESSION['receiver']."','".$message."',now(),now(),'0')";
			$query_indata = mysqli_query($conn,$indata);
			if($query_indata == true)
				echo "MEssege Sent";
			else
				echo "Failed";
		}
?>