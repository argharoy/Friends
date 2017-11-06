<?php
	session_start();
	require_once("php/db.php");
	$_GET['id'];
	$_SESSION['id'];
	$_GET['album'];
	$album_name = base64_decode($_GET['album']);
	if(isset($_GET['id']))
		{
			$details = "SELECT * FROM members WHERE(id='".$_GET['id']."')";
			$query_details = mysqli_query($conn,$details);
			$results = mysqli_fetch_array($query_details);
		}
	if(isset($_SESSION['id']))
		{
			$details = "SELECT * FROM members WHERE(id='".$_SESSION['id']."')";
			$query_details = mysqli_query($conn,$details);
			$res = mysqli_fetch_array($query_details);
		}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title><?php echo $album_name; ?></title>
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
		<style>
		.frame img{
				height:180px;
				width:320px;
				float:left;
				border : 4px solid #fff;
		}
		</style>
	</head>
	<body>

		<!-- Header -->
			<div id="header" class="skel-layers-fixed">

				<div class="top">

					<!-- Logo -->
						<div id="logo">
							<span class="image avatar48">
								<?php	
									if($results['avatar'] == '0')
										{
								?>
								<img src="images/avatar.jpg" alt="" />
								<?php	
										}
									else
										{
								?>
								<img src="<?php echo $results['avatar']; ?>" alt="<?php echo $results['firstname']; ?>" />
								<?php	
										}
								?>
							</span>
							<h1 id="title"><?php echo $results['firstname']; ?></h1>
							<p><?php echo $results['lastname']; ?></p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">Intro</span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Portfolio</span></a></li>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">About Me</span></a></li>
								<li><a href="#contact" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Contact</span></a></li>
							</ul>
						</nav>
						
				</div>
				
				<div class="bottom">

					<!-- Social Icons -->
						<nav id="nav">
							<ul>
								<li><a href="profile.php?id=<?php echo $_SESSION['id']; ?>"><span class="icon fa-user">&laquo; <?php echo ''.$res['firstname'].' '.$res['lastname'].'' ?> &raquo;</span></a></li>
							</ul>
						</nav>
				
				</div>
			
			</div>

		<!-- Main -->
			<div id="main">
				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">
							<header>
								<h2><?php echo $album_name; ?></h2>
							</header>
							<?php	
								$src_img = "SELECT image FROM album_images WHERE(album_name = '".$album_name."')";
								$query_src_img = mysqli_query($conn,$src_img);
								while($data = mysqli_fetch_array($query_src_img))
									{
							?>
								<div class="frame">
									<img src="<?php echo $data['image']; ?>" />
								<div>
							<?php
									}
							?>
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