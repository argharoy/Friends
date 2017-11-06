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
	if(isset($_POST['query']))
		{
				$data = $_POST['query'];
				$src = "SELECT * FROM members WHERE (firstname='".$data."')";
				$query_src = mysqli_query($conn,$src);
				/*if($query_src == true)
					echo "ok"; else echo "jj";*/
				while($results = mysqli_fetch_array($query_src))
					{
						if($results['id'] != $_SESSION['id'])
							{
								$users = ''.$results['firstname'].' '.$results['lastname'].'';
								$users_id = $results['id'];			
?>
								<div class="row">
									<div class="4u">
										<article class="item">
											<?php	
												if($results['avatar'] == '0')
													{
														echo '<a href="profile.php?id='.$users_id.'"><img width="230" height="210" src="images/pic04.jpg" alt="" />';	
													}
												else
													{
														echo '<a href="profile.php?id='.$users_id.'"><img width="230" height="210" src="'.$results['avatar'].'" /></a>';
													}
											?>
										</article>
									</div>
									<div class="4u">
										<article class="item">
											<?php echo '<a href="profile.php?id='.$users_id.'">'.$users.'</a>' ?>
                                            <?php
												$chk_rqst1 = "SELECT * FROM friend_requests WHERE(sender='".$_SESSION['id']."' AND receiver='".$users_id."')";
												$chk_rqst2 = "SELECT * FROM friend_requests WHERE(sender='".$users_id."' AND receiver='".$_SESSION['id']."')";
												$query_chk_rqst1 = mysqli_query($conn,$chk_rqst1);
												$query_chk_rqst2 = mysqli_query($conn,$chk_rqst2);
												$res_rqst1 = mysqli_fetch_array($query_chk_rqst1);
												$res_rqst2 = mysqli_fetch_array($query_chk_rqst2);
												$count1 = mysqli_num_rows($query_chk_rqst1);
												$count2 = mysqli_num_rows($query_chk_rqst2);
												if(!($count1 > 0 || $count2 > 0))
													{
											?>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            	<input type="hidden" name="users_id" value="<?php echo $users_id ?>" />
												<input type="submit" value="Add As Friend" name="addasfriend" />
                                            </form>
                                            <?php
													}
												else if($res_rqst1['acception'] == 1)
													{
											?>
                                             <h4>Waiting For Request Conformation ... </h4>
                                            <?php
													}
												else if($res_rqst2['acception'] == 1)
													{
											?>
                                           <h4>Pending Request For Approval...</h4>
                                            <?php
													}
											?>
										</article>
                                        <article class="item">
                                        	<form action="messege.php" method="post">
												<input type="hidden" name="receiver" value="<?php echo $users_id; ?>">
                                        		<input type="submit" value="Messege" name="messege" />
                                            </form>
                                        </article>
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
	if(isset($_POST['addasfriend']))
		{
			$sender = $_SESSION['id'];
			$receiver = $_POST['users_id'];
			$ins_frnds = "INSERT INTO friend_requests VALUES(SL,'".$sender."','".$receiver."',now(),'1')";
			$query_request = mysqli_query($conn,$ins_frnds);
			if($query_request == true)
				{
					header('location:profile.php?id='.$_SESSION['id'].'');
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