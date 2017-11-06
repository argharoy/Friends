<?php

	session_start();
	require_once("php/db.php");
	$error = "";
	$error1 = "";
	$success = "";
	if(isset($_POST['login']))
		{
			$email = $_POST['email'];
			$password = md5($_POST['password']);
			
			if($email=="" || $password=="")
				{
					$error = "Feilds Are Empty !";
				}
			else
				{
					$lookup = "SELECT * FROM members WHERE(email='".$email."' AND password='".$password."')";
					$query_lookup = mysqli_query($conn,$lookup);
					$results = mysqli_fetch_array($query_lookup);
					if(!$results[0] > 0)
						{
							$error = "Credentials Did Not Match !";
						}
					else
						{
							$flag = "INSERT INTO flag VALUES(SL,'".$results['id']."','1',now(),now())";
							$query_flag = mysqli_query($conn,$flag);
							$_SESSION['id'] = $results['id'];
							header('location:profile.php?id='.$_SESSION['id'].'');
						}
				}
		}
	
	if(isset($_POST['signup']))
		{
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$hashpwd = md5($password);
			
			if($firstname=="" || $lastname=="" || $email=="" || $password=="")
				{
					$error1 = "Feilds Seems To Be Empty !";
				}
			else if(file_exists('users/'.$email.''))
				{
					$error1 = "E-MAIL ID Already Exists . Try A New One !";
				}
			else if(strlen($password) < 5)
				{
					$error1 = "Password Too Short . Should Have More Than 4 Characters !";
				}
			else if(!filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					$error1 = "Entered E-MAIL Is Not Valid !";
				}
			else
				{
					$insert_data = "INSERT INTO members VALUES(id,'".$firstname."','".$lastname."','".$email."','".$hashpwd."',now(),'0','',0)";
					$query_data = mysqli_query($conn,$insert_data);
					if($query_data == true)
						{
							if(!file_exists('users/$email'))
								{
									mkdir('users/'.$email.'');
									mkdir('users/'.$email.'/avatar');
									mkdir('users/'.$email.'/albums');
								}
								/*$flag = "INSERT INTO flag VALUES(SL,'".$email."','1',now(),0)";
								$query_flag = mysqli_query($conn,$flag);
								$_SESSION['email'] = $email;*/
								$success = "Login To continue . ";
						}
					else
						{
							$error1="Network Problem !";
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
							<span class="image avatar48"><img src="images/avatar.jpg" alt="" /></span>
							<h1 id="title">WEB COmM</h1>
							<p>Engineer'd Communication</p>
						</div>

					<!-- Nav -->
						<nav id="nav">
							<ul>
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">HOME</span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">SIGN UP</span></a></li>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">About Me</span></a></li>
								<li><a href="#contact" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Contact</span></a></li>
							</ul>
						</nav>
						
				</div>
				
				<div class="bottom">

					<!-- Social Icons -->
						<ul class="icons">
							<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
							<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
							<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
							<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
							<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
						</ul>
				
				</div>
			
			</div>

		<!-- Main -->
			<div id="main">
				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">
                        <?php echo $success; ?>
						<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
							<header>
								<h2 class="alt">
									&lt;!.\.WEB COmM./.!&gt; <br>Login To Access..!
                                    	<?php if(isset($error)) {echo '<br>' .$error.'';} ?>
										<input type="email" name="email" placeholder="E-MAIL" />
										&nbsp;
										<input type="password" name="password" placeholder="PASSWORD" />
								</h2>
							</header>
							
							<footer>
								<input type="submit" name="login" value="LOGIN" class="button scrolly" />
							</footer>
						</form>
						</div>
					</section>
					
				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">
					
							<header>
								<h2>SIGN UP</h2>
                                <h2><?php if(isset($error)) {echo $error1;} ?></h2>
							</header>
							<header>
							<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
								<input type="text" name="firstname" placeholder="FIRSTNAME" />
								
								<input type="text" name="lastname" placeholder="LASTNAME" />
								&nbsp;
								<input type="email" name="email" placeholder="E-MAIL" />
								
								<input type="password" name="password" placeholder="PASSWORD" /></header>
								
								<footer><input type="submit" name="signup" value="SIGN UP" class="button scrolly" /></footer>
							</form>

						</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">

							<header>
								<h2>About Me</h2>
							</header>

							<a href="#" class="image featured"><img src="images/pic08.jpg" alt="" /></a>
							
							<p>Tincidunt eu elit diam magnis pretium accumsan etiam id urna. Ridiculus 
							ultricies curae quis et rhoncus velit. Lobortis elementum aliquet nec vitae 
							laoreet eget cubilia quam non etiam odio tincidunt montes. Elementum sem 
							parturient nulla quam placerat viverra mauris non cum elit tempus ullamcorper 
							dolor. Libero rutrum ut lacinia donec curae mus vel quisque sociis nec 
							ornare iaculis.</p>

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