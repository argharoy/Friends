<?php
	session_start();
	require_once('php/db.php');
	$_SESSION['id'];
	$id = $_GET['id'];
	if($id == $_SESSION['id'])
		{
			$useen = "UPDATE messege SET seen='1' WHERE(receiver='".$_SESSION['id']."')";
			$q_useen = mysqli_query($conn,$useen);
		}
	if(isset($_SESSION['id']))
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
		<title>Message</title>
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
							<ul>
								<li><a href="view_msg.php">View Message</a></li>
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
			
				<!-- Contact -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Message's</h2>
								<?php
									$msg = "SELECT * FROM messege WHERE(receiver='".$_SESSION['id']."') ORDER BY SL DESC";
									$query_msg = mysqli_query($conn,$msg);
									$count = mysqli_num_rows($query_msg);
									if($count > 0)
										{
											while($results  = mysqli_fetch_array($query_msg))
												{
													$src = "SELECT firstname,lastname FROM members WHERE(id='".$results['sender']."')";
													$q_src = mysqli_query($conn,$src);
													$data = mysqli_fetch_array($q_src);
								?>
								<div class="row">
                                    	<div class="4u">
                                        	<article class="item">
												<?php echo "".$data['firstname']." ".$data['lastname'].""; ?>
											</article>
										</div>
										<div class="4u">
											<article class="item">
												<?php echo $results['message']; ?>
											</article>
										</div>
										<div class="4u">
											<article class="item">
												<?php echo $results['date']; ?>
											</article>
										</div>
								</div>
								<?php
												}
												echo "<br><hr><br>";
										}
								?>
							</header>
							

						</div>
					</section>
			
			</div>

		<!-- Footer -->
			<div id="footer">
				
				<!-- Copyright -->
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				
			</div>

	</body>
</html>