<?php
	session_start();
	require_once("php/db.php");
	$_SESSION['id'];
	$_GET['u'];
	$i=0;$j=0;
	$query_user = mysqli_query($conn,"SELECT * FROM members WHERE(id='".$_SESSION['id']."')");
	$query_opuser = mysqli_query($conn,"SELECT friends_array FROM members WHERE(id='".$_GET['u']."')");
	
	while($row = mysqli_fetch_array($query_user))
		{ 
			$get_friends = $row['friends_array'];
		}
	$opo_users = explode(",",$get_friends);
	foreach($opo_users as $key=>$value)
		{
			if($value != $_GET['u'])
				{ $ar[$i] = $value; $i++; }
		}
	if($ar[0] != NULL){
		$user_array = implode(",",$ar);
		$update_user_friends = "UPDATE members SET friends_array='$user_array' WHERE(id='".$_SESSION['id']."')";
		$query_u_f_a = mysqli_query($conn,$update_user_friends);
	}
	else	{
		$update_user_friends = "UPDATE members SET friends_array='' WHERE(id='".$_SESSION['id']."')";
		$query_u_f_a = mysqli_query($conn,$update_user_friends);
	}
	
	while($row = mysqli_fetch_array($query_opuser))
		{
			$get_friends = $row['friends_array'];
		}
	$rev_users = explode(",",$get_friends);
	foreach($rev_users as $key=>$value)
		{
				if($value != $_SESSION['id'])
					{	$aro[$j] = $value;  $j++; }
		}
		if($aro[0] != NULL)	{
			$opouser_array = implode(",",$aro);	
			$update_opouser_friends	= "UPDATE members SET friends_array='$opouser_array' WHERE(id='".$_GET['u']."')";
			$query_opou_f_a = mysqli_query($conn,$update_opouser_friends);
		}
		else	{
			$update_opouser_friends	= "UPDATE members SET friends_array='' WHERE(id='".$_GET['u']."')";
			$query_opou_f_a = mysqli_query($conn,$update_opouser_friends);
		}
	header('location:index.php');
?>