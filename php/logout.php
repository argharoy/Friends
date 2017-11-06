<?php
	session_start();
	require_once("db.php");
	isset($_SESSION['id']);
	isset($_SESSION['email']);
	
	$up_flag = "UPDATE flag SET flag='0',logout=now() WHERE(id='".$_SESSION['id']."')";

	$query = mysqli_query($conn,$up_flag);

	if($query == true)
		{ 
			session_destroy();
			header('location:http://localhost/Friends/');
		}
	else
		{
			echo "FALSE";
		}
?>