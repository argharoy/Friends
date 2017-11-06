<?php
	session_start();
	require_once("php/db.php");
	$_GET['id'];
	$_SESSION['id'];
	isset($_SESSION['email']);
	if(isset($_SESSION['id']))
		{
			$details = "SELECT * FROM members WHERE(id='".$_SESSION['id']."')";
			$query_details = mysqli_query($conn,$details);
			$res = mysqli_fetch_array($query_details);
		}
	if(isset($_GET['id']))
		{
			$details = "SELECT * FROM members WHERE(id='".$_GET['id']."')";
			$query_details = mysqli_query($conn,$details);
			$results = mysqli_fetch_array($query_details);
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
							<!--
							
								Prologue's nav expects links in one of two formats:
								
								1. Hash link (scrolls to a different section within the page)
								
								   <li><a href="#foobar" id="foobar-link" class="icon fa-whatever-icon-you-want skel-layers-ignoreHref"><span class="label">Foobar</span></a></li>

								2. Standard link (sends the user to another page/site)

								   <li><a href="http://foobar.tld" id="foobar-link" class="icon fa-whatever-icon-you-want"><span class="label">Foobar</span></a></li>
							
							-->
							<ul>
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Friend List</span></a></li>
							</ul>
						</nav>
						
				</div>
				
				<div class="bottom">

					<!-- Social Icons -->
						<nav id="nav">
							<ul>
								<li><a href="profile.php?id=<?php echo $_SESSION['id']; ?>"><span class="icon fa-user">&laquo; <?php echo ''.$res['firstname'] . ' ' .$res['lastname'].''; ?> &raquo;</span></a></li>
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
								<p><h2>-\- Friend List -/-</h2></p>
                                <?php
									if(isset($_GET['id']))
											$var = $_GET['id'];
									else
											$var = $_SESSION['id'];
									$src_frnd = "SELECT * FROM members WHERE(id='".$var."')";
									$query_src_frnds = mysqli_query($conn,$src_frnd);
									$data = mysqli_fetch_array($query_src_frnds);
									$frnds = $data['friends_array'];
									$frnds_array = explode(",",$frnds);
									$count = count($frnds_array);
									$i=0;
									foreach($frnds_array as $key => $value)
										{
											$i++;
											$name = mysqli_query($conn,"SELECT * FROM members WHERE id='$value'");
											while($results = mysqli_fetch_array($name))
												{
								?>
                                	<div class="row">
                                    	<div class="4u">
                                        	<article class="item">
                                            	<?php	
													if($results['avatar'] != '0')
														{
															echo '<a href="profile.php?id='.$value.'"><img width="230" height="210" src="'.$results['avatar'].'" /></a>';
														}
													else
														{
															echo '<a href="profile.php?id='.$value.'"><img width="230" height="210" src="images/pic04.jpg" /></a>';
														}
												?>
                                            </article>
                                          </div>
                                     	<div class="4u">
                                        	<article class="item">
                                            	<?php echo '<a href="profile.php?id='.$value.'">'.$results['firstname'] . ' ' .$results['lastname'].'</a>'; ?>
                                            </article>
											<article class="item">
												<form action="messege.php" method="post">
													<input type="hidden" name="receiver" value="<?php echo $value; ?>">
													<input type="submit" value="Messege" name="messege">
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