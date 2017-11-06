<?php
	session_start();
	require_once("php/db.php");
	isset($_SESSION['email']);
	$_SESSION['id'];
	if(!isset($_SESSION['email']) || isset($_SESSION['email']))
		{
			$loc = "SELECT * FROM members WHERE(id='".$_SESSION['id']."')";
			$query_loc = mysqli_query($conn,$loc);
			$res_loc = mysqli_fetch_array($query_loc);
			$des_email = $res_loc['email'];
		}
?>
<!DOCTYPE HTML>
<html>
<head>
		<title>Friends</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.scrolly.min.js"></script>
		<script src="js/jquery.scrollzer.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-wide.css" />
		</noscript>
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
<body>
		<!-- Header -->
			<div id="header" class="skel-layers-fixed">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48">
								<?php	
									if($res_loc['avatar'] == '0')
										{
								?>
								<img src="images/avatar.jpg" alt="" />
								<?php	
										}
									else
										{
								?>
								<img src="<?php echo $res_loc['avatar']; ?>" alt="<?php echo $res_loc['firstname']; ?>" />
								<?php	
										}
								?>
							</span>
							<h1 id="title"><?php echo $res_loc['firstname']; ?></h1>
							<p><?php echo $res_loc['lastname']; ?></p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<!--
							
								Prologue's nav expects links in one of two formats:
								
								1. Hash link (scrolls to a different section within the page)
								
								   <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

								2. Standard link (sends the user to another page/site)

								   <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>
							
							-->
							<ul>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Pending Requests</span></a></li>
							</ul>
						</nav>
						
				</div>
				
				<div class="bottom">

					<!-- Social Icons -->
						<nav id="nav">
							<ul>
								<li><a href="profile.php?id=<?php echo $_SESSION['id']; ?>"><span class="icon fa-user">&laquo; <?php echo ''.$res_loc['firstname'].' '.$res_loc['lastname'].'' ?> &raquo;</span></a></li>
							</ul>
						</nav>
				
				</div>
			
			</div>

		<!-- Main -->
			<div id="main">

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">

							<header>
<?php
	if(isset($_SESSION['id']))
		{
			$search_rqst = "SELECT * FROM friend_requests WHERE(receiver='".$_SESSION['id']."' AND acception = '1') ORDER BY SL ASC";
			$query_src_rqst = mysqli_query($conn,$search_rqst);
			$count_rqst = mysqli_num_rows($query_src_rqst);
			if($count_rqst == 0)
				{
					echo "No Pending Requests ...";
				}
			else {
			while($sender = mysqli_fetch_array($query_src_rqst))
				{
					$sender_id = $sender['sender'];
					$look_id = "SELECT * FROM members WHERE(id='".$sender_id."')";
					$query_look_id = mysqli_query($conn,$look_id);
					$sender_datas = mysqli_fetch_array($query_look_id);
					$sender_datas['avatar'];
?>
				<div class="row">
                	<div class="4u">
                    	<article class="item">
                        	<?php	
								if($sender_datas['avatar'] == '0')
									{
							?>
										<img width="230" height="210" src="images/pic04.jpg" alt="" />
							<?php	
									}
								else
									{
							?>
										<img width="230" height="210" src="<?php echo $sender_datas['avatar'];?>" alt="" />
							<?php
									}
							?>
                        </article>
					</div>
                    <div class="4u">
                    	<article class="item">
                        	<?php echo ''.$sender_datas['firstname'].' '.$sender_datas['lastname'].''; ?>
                        </article>
                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <article class="item">
                        		<input type="hidden" name="sender_id" value="<?php echo $sender_id; ?>" />
                            	<input type="submit" name="accept" value="Accept" />
                        </article> 
                        <article class="item">
                        	<input type="hidden" name="sender_id" value="<?php echo $sender_id; ?>" />
                        	<input type="submit" name="deny" value="Deny" />
                        </article>
                        </form> 
                    </div>
                    <div class="4u">
                    	<article class="item">
                        	info...
                        </article>
                    </div>
                </div>
<?php	
					echo "<br><hr><br>";
				}
				
				}	
		}
?>	
							</header>
						</div>
					</section>				
			</div>
<?php
	if(isset($_POST['accept']))
		{
			$sender = $_POST['sender_id'];
			$data = "SELECT * FROM friend_requests WHERE(sender='".$sender."' AND receiver='".$_SESSION['id']."')";
			$query_data = mysqli_query($conn,$data);
			$fetch_data = mysqli_fetch_array($query_data);
			$receiver = $fetch_data['receiver'];
			
			$query_sender = mysqli_query($conn,"SELECT friends_array FROM members WHERE(id='$sender')");
			$query_receiver = mysqli_query($conn,"SELECT friends_array FROM members WHERE(id='$receiver')");
			
			while($row = mysqli_fetch_array($query_sender))
				{ 
					$frnd_array_sender = $row['friends_array']; 
				}
				
			while($row = mysqli_fetch_array($query_receiver))
				{
					 $frnd_array_receiver = $row['friends_array']; 
				}
			
				
			$frndsarraysender = explode("," , $frnd_array_sender);
			$frndsarrayreceiver = explode("," , $frnd_array_receiver);
			
			if(in_array($receiver,$frndsarraysender))
				{
					echo "Friends Already ";
				}
			if(in_array($sender,$frndsarrayreceiver))
				{
					echo "Friends Already ";
				}
			
			if($frnd_array_sender != "")
				{
					 $frnd_array_sender = "$frnd_array_sender,$receiver"; 
				} 
			else
				{
					$frnd_array_sender = "$receiver"; 
				}
				
			if($frnd_array_receiver != "")
				{ 
					$frnd_array_receiver = "$frnd_array_receiver,$sender";
				}
			else
				{
					 $frnd_array_receiver = "$sender";
				}
				
			$update_sender = mysqli_query($conn , "UPDATE members SET friends_array='$frnd_array_sender' WHERE id='$sender'");
			$update_receiver = mysqli_query($conn , "UPDATE members SET friends_array='$frnd_array_receiver' WHERE id='$receiver'");
			$update_requests = mysqli_query($conn, "UPDATE friend_requests SET acception='2' WHERE sender='".$sender."' AND receiver='".$receiver."'");
			if($update_requests == true){
			header('location:view_requests.php');
			}
		}
	if(isset($_POST['deny']))
		{
			$sender = $_POST['sender_id'];
			$del_rqst = "DELETE FROM friend_requests WHERE(sender='".$sender."')";
			$query_rqst = mysqli_query($conn,$del_rqst);
			if($query_rqst == true)
				{
					header('location:view_requests.php');
				}
		}
?>
		<!-- Footer -->
			<div id="footer">
				
				<!-- Copyright -->
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				
			</div>

</body>
</html>