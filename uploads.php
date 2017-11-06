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
	if(isset($_SESSION['id']) || isset($_SESSION['email']))
		{
		if(isset($_POST['avatar_upload']))
			{
				$name = $_FILES['avatar']['name'];
				$size = $_FILES['avatar']['size'];
				$type = $_FILES['avatar']['type'];
				$temp = $_FILES['avatar']['tmp_name'];
			
				$dim = getimagesize($temp);
				$width = $dim[0];
				$height = $dim[1];
				
				$path = "users/".$des_email."/avatar/".md5(rand(0,1000) . rand(0,1000) . rand(0,1000) . rand(0,1000)).".jpg";
			
				$allowed = array('image/jpeg' , 'image/jpg' , 'image/png');

				if(in_array($type,$allowed))
					{
						$update_avatar = "UPDATE members SET avatar='$path' WHERE(email='".$des_email."')";
						$query_ava = mysqli_query($conn,$update_avatar);
						switch($type)
							{
								case 'image/jpeg' :
									$img = imagecreatefromjpeg($temp);
									$ava_img = imagecreatetruecolor(460,420);
									imagecopyresized($ava_img , $img , 0 , 0 , 0 , 0 , 460 , 420 , $width , $height);
									imagejpeg($ava_img,$path);
									
								break;
								case 'image/png' :
									$img = imagecreatefrompng($temp);
									$ava_img = imagecreatetruecolor(460,420);
									imagecopyresized($ava_img , $img , 0 , 0 , 0 , 0 , 460 , 420 , $width , $height);
									imagepng($ava_img,$path);
									
								break;
							}
					}
				else
					{
						echo "Error !";
					}
			}
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
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">&laquo; <?php echo ''.$res_loc['firstname'].' '.$res_loc['lastname'].'' ?> </span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Albums</span></a></li>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Avatar</span></a></li>
								<li><a href="#contact" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Contact</span></a></li>
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
                            <div class="row">
                              <div class="4u">
                                <article class="item">
								<?php	
									if($res_loc['avatar'] == '0')
										{
								?>
								<img class="image fit" src="images/pic04.jpg" alt="" />
								<?php	
										}
									else
										{
								?>
								<img class="image fit" src="<?php echo $res_loc['avatar']; ?>" alt="<?php echo $res_loc['firstname']; ?>" />
								<?php	
										}
								?>
										
											<h3><?php echo ''.$res_loc['firstname'].' '.$res_loc['lastname'].'' ?></h3>
										
								</article>
                              </div>
                            <div class="4u">
                              	<article class="item">
                              		info.....
                                </article>
                            </div>
							</div>
							</header>
					</section>
					
				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">
					
							<header>
								<h2>Create Albums</h2>
							</header>
							
							<p><a href="create_albums.php?id=<?php echo $_SESSION['id']; ?>" class="button scrolly">Create Album</a></p>
						
							

						</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">

							<header>
								<h2>Update Your Profile Photo</h2>
							</header>

							<div class="row">
                              <div class="4u">
                                <article class="item">
								<?php	
									if($res_loc['avatar'] == '0')
										{
								?>
								<img class="image fit" src="images/pic04.jpg" alt="" />
								<?php	
										}
									else
										{
								?>
								<img class="image fit" src="<?php echo $res_loc['avatar']; ?>" alt="<?php echo $res_loc['firstname']; ?>" />
								<?php	
										}
								?>										
								</article>
                              </div>
								<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                	<input type="file" name="avatar">
                                    <input type="submit" name="avatar_upload" value="Upload" />
                                </form>
							</div>

						</div>
					</section>
			
				<!-- Contact -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Contact</h2>
							</header>

							<p>Elementum sem parturient nulla quam placerat viverra 
							mauris non cum elit tempus ullamcorper dolor. Libero rutrum ut lacinia 
							donec curae mus. Eleifend id porttitor ac ultricies lobortis sem nunc 
							orci ridiculus faucibus a consectetur. Porttitor curae mauris urna mi dolor.</p>
							
							<form method="post" action="#">
								<div class="row half">
									<div class="6u"><input type="text" name="name" placeholder="Name" /></div>
									<div class="6u"><input type="text" name="email" placeholder="Email" /></div>
								</div>
								<div class="row half">
									<div class="12u">
										<textarea name="message" placeholder="Message"></textarea>
									</div>
								</div>
								<div class="row">
									<div class="12u">
										<input type="submit" value="Send Message" />
									</div>
								</div>
							</form>

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