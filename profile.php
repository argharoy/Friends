<?php
	session_start();
	require_once("php/db.php");
	$_GET['id'];
	$_SESSION['id'];
	isset($_SESSION['email']);
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
		
	if(isset($_POST['chngpwd']))
		{
			$oldpwd = md5($_POST['oldpwd']);
			$newpwd = $_POST['newpwd'];
			$hash_newpwd = md5($newpwd);
			
			$chkpwd = "SELECT password FROM members WHERE(id='".$_SESSION['id']."')";
			$query_chkpwd = mysqli_query($conn,$chkpwd);
			$results = mysqli_fetch_array($query_chkpwd);
			$dbpwd = $results['password'];
			if($dbpwd != $oldpwd)
				{
					$flag = "Previous Password Did Not Match !";
				}
			else if(strlen($newpwd) < 5)
				{
					$flag = "New Password Length Too Short !";
				}
			else
				{
					$update_pwd = "UPDATE members SET password = '$hash_newpwd' WHERE(id='".$_SESSION['id']."')";
				
					$query_pwd = mysqli_query($conn,$update_pwd);
					if($query_pwd == true)
						{
							$flag = "Password Has Been Changed Successfully !";
							header("location:http://localhost/Friends/profile.php?id=".$_SESSION['id']."");
						}
					else
						{
							$flag = "Try Again Later !";
						}
				}
		}
	if(isset($_SESSION['id']))
		{
			$src_rqst = "SELECT * FROM friend_requests WHERE(receiver='".$_SESSION['id']."' AND acception = '1')";
			$query_rqst = mysqli_query($conn,$src_rqst);
			$count_rqst = mysqli_num_rows($query_rqst);
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
							<ul>
								<li><a href="#top" id="top-link" class="skel-layers-ignoreHref"><span class="icon fa-home">HOME</span></a></li>
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Albums & Pic's</span></a></li>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-envelope">Message</span></a></li>
                                <?php
									if($_SESSION['id'] == $_GET['id'])
										{
								?>
                                <li><a href="#settings" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Settings</span></a></li>
                                <?php
										}
								?>
								<li><a href="#contact" id="contact-link" class="skel-layers-ignoreHref"><span class="icon fa-user">Friends</span></a></li>
                                <?php
									if($_SESSION['id'] == $_GET['id'])
										{
								?>
                                <li><a href="php/logout.php"><span class="icon fa-home">Log Out</span></a></li>
                                <?php
										}
									else
										{
								?>
                                <li><a href="unfriend.php?id=<?php echo $_SESSION['id']; ?>&amp;u=<?php echo $_GET['id']; ?>"><span class="icon fa-user">Unfriend <?php echo $results['firstname']; ?></span></a></li>
                                <?php
										}
								?>
								<form action="search.php" method="post">
								<li style="float:left; padding-left:0.5em;">
									<input type="search" placeholder="search" size="14" name="query" />
									<input type="image" src="images/src.png" name="search" />
								</li>
								</form>
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

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">
                        
							<header>
                            <div class="row">
                              <div class="4u">
                                <article class="item">
								<?php	
									if($results['avatar'] == '0')
										{
								?>
								<img class="image fit" src="images/pic04.jpg" alt="" />
								<?php	
										}
									else
										{
								?>
								<img class="image fit" src="<?php echo $results['avatar']; ?>" alt="<?php echo $results['firstname']; ?>" />
								<?php	
										}
								?>
										
											<h3><?php echo ''.$results['firstname'].' '.$results['lastname'].'' ?></h3>
										
								</article>
                              </div>
                            <div class="4u">
                              	<article class="item">
                              		info.....
                                </article>
                            </div>
							</div>
							</header>
						</div>
					</section>
					
				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">
					
							<header>
								<h2>Albums & Pic's</h2>
							</header>
							<?php
								if($_SESSION['id'] == $_GET['id'])
									{
							?>
							<p>Populate Your Web Sector With Social Media..!
                            <br>Upload You Photo's At A Go...!<br>
                            <a href="uploads.php?id=<?php echo $_SESSION['id']; ?>" class="button scrolly">&laquo; UPLOAD PHOTO'S &raquo;</a></p>
                            <?php
									}
								else
									{
							?>
                            <p>View <?php echo $results['firstname']; ?>'s Albums & Pics ...!
                           	<?php
									}
							?>
                            <?php
								$i=0;$j=0;
								$url_id = $_GET['id'];
								$disp_alb = "SELECT * FROM album_names WHERE(member_id='".$url_id."')";
								$query_disp_alb = mysqli_query($conn,$disp_alb);
								$count_alb = mysqli_num_rows($query_disp_alb);
								while($alb_res = mysqli_fetch_array($query_disp_alb))
									{
										$album_name[$i] = $alb_res['album_name'];
										$img_src = "SELECT image FROM album_images WHERE(album_name = '".$album_name[$i]."') ORDER BY RAND() LIMIT 1";
										$query_img = mysqli_query($conn,$img_src);
										while($rs_img = mysqli_fetch_array($query_img))
											{
												$album_image[$j] = $rs_img['image'];
												$j++;
											}
										$i++;
									}
							?>
							<?php
								if($count_alb > 0)
									{
							?>
							<div class="row">
								<div class="4u">
									<?php if($count_alb == 1 || $count_alb > 0){ $name1 = base64_encode($album_name[0]); ?>
									<article class="item">
										<a href="view_album.php?album=<?php echo $name1; ?>&id=<?php echo $_GET['id']; ?>" class="image fit"><img src="<?php echo $album_image[0]; ?>" alt="" /></a>
										<header>
											<h3><?php echo $album_name[0]; ?></h3>
										</header>
									</article>
									<?php } ?>
									<?php if($count_alb == 4 || $count_alb > 3) { $name4 = base64_encode($album_name[3]); ?>
									<article class="item">
										<a href="view_album.php?album=<?php echo $name4; ?>&id=<?php echo $_GET['id']; ?>" class="image fit"><img src="<?php echo $album_image[3]; ?>" alt="" /></a>
										<header>
											<h3><?php echo $album_name[3]; ?></h3>
										</header>
									</article>
									<?php } ?>
								</div>
								<div class="4u">
									<?php if($count_alb == 2 || $count_alb > 1) { $name2 = base64_encode($album_name[1]);?>
									<article class="item">
										<a href="view_album.php?album=<?php echo $name2; ?>&id=<?php echo $_GET['id']; ?>" class="image fit"><img src="<?php echo $album_image[1]; ?>" alt="" /></a>
										<header>
											<h3><?php echo $album_name[1]; ?></h3>
										</header>
									</article>
									<?php } ?>
									<?php if($count_alb == 5 || $count_alb > 4) { $name5 = base64_encode($album_name[4]);?>
									<article class="item">
										<a href="view_album.php?album=<?php echo $name5; ?>&id=<?php echo $_GET['id']; ?>" class="image fit"><img src="<?php echo $album_image[4]; ?>" alt="" /></a>
										<header>
											<h3><?php echo $album_name[4]; ?></h3>
										</header>
									</article>
									<?php } ?>
								</div>
								<div class="4u">
									<?php if($count_alb == 3 || $count_alb > 2) { $name3 = base64_encode($album_name[2]);?>
									<article class="item">
										<a href="view_album.php?album=<?php echo $name3; ?>&id=<?php echo $_GET['id']; ?>" class="image fit"><img src="<?php echo $album_image[2]; ?>" alt="" /></a>
										<header>
											<h3><?php echo $album_name[2]; ?></h3>
										</header>
									</article>
									<?php } ?>
									<?php if($count_alb == 6 || $count_alb > 5) { $name6 = base64_encode($album_name[5]);?>
									<article class="item">
										<a href="view_album.php?album=<?php echo $name6; ?>&id=<?php echo $_GET['id']; ?>" class="image fit"><img src="<?php echo $album_image[5]; ?>" alt="" /></a>
										<header>
											<h3><?php echo $album_name[5]; ?></h3>
										</header>
									</article>
									<?php } ?>
								</div>
							</div>
							<?php
									}
								else	
									{
							?>
										<p><h3><?php echo ''.$results['firstname'].' Presently Is Out Of Albums...';?></h3></p>
							<?php	
									}
							?>
						</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">

							<header>
								<h2>Message</h2>
							</header>
							<?php
								$msg_user = "SELECT * FROM messege WHERE(receiver='".$_SESSION['id']."' AND seen='0')";
								$query_msg_user = mysqli_query($conn,$msg_user);
								$data = mysqli_fetch_array($query_msg_user);
								$count_msg = mysqli_num_rows($query_msg_user);
							?>
							<h3><?php if($count_msg > 0) { echo $count_msg; ?> Message For You....<?php } else { ?>No Message for You....<?php } ?></h3>
							<a href="view_msg.php?id=<?php echo $_SESSION['id']; ?>" class="button scrolly">View Message</a>
						</div>
					</section>
                    
                    
                <!-- Settings -->
                <?php
					if($_SESSION['id'] == $_GET['id'])
						{
				?>
					<section id="settings" class="four">
						<div class="container">

							<header>
								<h2>Account Settings</h2>
							</header>

							<p>Change Password</p>
							<?php if(isset($flag)) { echo $flag; } ?>
							<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
								<div class="row half">
									<div class="6u"><input type="password" name="oldpwd" placeholder="Old Password" /></div>
									<div class="6u"><input type="password" name="newpwd" placeholder="New Password" /></div>
								</div>
								<div class="row">
									<div class="12u">
										<input type="submit" value="Change Password" name="chngpwd" />
										<a href="settings.php?id=<?php echo $_SESSION['id']; ?>" class="button scrolly">&laquo; More Settings &raquo;</a>
									</div>
								</div>
							</form>
								<!--<div class="row half">
									<div class="12u">
										<a href="" class="button scrolly">&laquo; More Settings &raquo;</a>
									</div>
								</div>-->
						</div>
					</section>
			<?php
						}
			?>
				<!-- Friends -->
					<section id="contact" class="four">
						<div class="container">

							<header>
								<h2>Friends</h2>
							</header>
                            <div class="row">
                            	<?php
									if($_SESSION['id'] == $_GET['id'])
										{
								?>
                            	<div class="6u">
                                	<p>Requests</p>
                                	<article class="item">
                                    	<p><?php
											if($count_rqst > 0)
												{
													echo $count_rqst;
										?>
                                        	requests waiting for your approval !</p> 
                                        <p><?php
											while($requests = mysqli_fetch_array($query_rqst))
										{
											$sender_id = $requests['sender'];
											if($count_rqst < 5)
												{
													$find_user = "SELECT firstname FROM members WHERE(id='".$sender_id."')";
												}
											else
												{
													$find_user = "SELECT firstname FROM members WHERE(id='".$sender_id."') LIMIT 5";
												}
											$query_user = mysqli_query($conn,$find_user);
											if($query_user == true)
											$res_user = mysqli_fetch_array($query_user);
											echo $res_user['firstname'];
											echo " , ";
										}
										?>
                                        <?php
											if($count_rqst == 1)
												{
										?>
                                         is waiting for your approval !
                                         <?php
												}
											else if($count_rqst < 5)
												{
										?>
                                        	are waiting for your approval !
                                         <?php
												}
											else
												{
										?>
                                        	and <u>MORE</u> are waiting for your approval !
                                        <?php
												}
										?></p>
                                		<p><a href="view_requests.php?id=<?php echo $_SESSION['id']; ?>" class="button scrolly">&laquo; View Requests &raquo;</a></p>
                                       <p> <?php
												}
											else
												{
										?>
                                        	No Pending Requests !</p>
                                         <?php
												}
										?>
                                 	</article>
                                </div>
                                <?php
										}
								?>
								<div class="4u">
									<article class="item">
                                    	<?php
											if($_GET['id'] == $_SESSION['id'])
													$var = $_SESSION['id'];
											else
													$var = $_GET['id'];
										?>
										<p><a href="view_friends.php?id=<?php echo $var; ?>" class="button scrolly">View Friends</a></p>
									</article>
								</div>
                            </div>
							<br><hr><br>
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