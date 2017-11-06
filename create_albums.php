<?php
	session_start();
	require_once("php/db.php");
	$_SESSION['id'];
	if(isset($_SESSION['id']))
		{
			$loc = "SELECT * FROM members WHERE(id='".$_SESSION['id']."')";
			$query_loc = mysqli_query($conn,$loc);
			$res_loc = mysqli_fetch_array($query_loc);
			$des_email = $res_loc['email'];
		}
	if(isset($_POST['create_album']))
		{
			$album = $_POST['album_name'];
			$ck_album = "SELECT member_id,album_name FROM album_names WHERE(member_id='".$_SESSION['id']."' AND album_name='".$album."')";
			$qu_ck = mysqli_query($conn,$ck_album);
			$c_ck = mysqli_num_rows($qu_ck);
			if($album == "")
				{ $err = "Place An Album Name "; }
			else
				{
					if($c_ck > 0)
						{
							$flag = false;
						}
					else	
						{
							$flag = true;
						}
					if($flag == true)
						{
							mkdir('users/'.$des_email.'/albums/'.$album.'');
							$db_album_name = "INSERT INTO album_names VALUES(SL,'".$_SESSION['id']."','".$album."',0)";
							$query_db_album_name = mysqli_query($conn,$db_album_name); 
							$err = 'Album Named <u>'.$album.'</u> Created';
						}
					else
						{
							$err = "Album Already Exists .";
						}
				}
		}
	if(isset($_POST['upload_pic']))
		{
			$albumname = $_POST['album_select'];
			$name = $_FILES['image']['name'];
			$size = $_FILES['image']['size'];
			$type = $_FILES['image']['type'];
			$temp = $_FILES['image']['tmp_name'];	
			
			$path = "users/".$des_email."/albums/".$albumname."/".md5(rand(0,1000) . rand(0,1000) . rand(0,1000)).".jpg";
			if($albumname == "")
				{
					$notify = "Select An Album To Upload Your Image";
				}
			else {
			$update_album_images = "INSERT INTO album_images VALUES(SL,'".$_SESSION['id']."','".$albumname."','".$path."')"; 
			$query_album_images = mysqli_query($conn,$update_album_images);
			if($query_album_images == true)
				{
					$notify = "".$name." uploaded to ".$albumname."";
					move_uploaded_file($temp,$path);
				}
			}
		}
	if(isset($_SESSION['id']) && isset($albumname))
		{
			$c_album_images = "SELECT * FROM album_images WHERE(album_name='".$albumname."')";
			$query_c = mysqli_query($conn,$c_album_images);
			$count_images = mysqli_num_rows($query_c);
			$update_image_count = "UPDATE album_names SET image_count='$count_images' WHERE(album_name='".$albumname."' AND member_id='".$_SESSION['id']."')";
			$query_update_image_count = mysqli_query($conn,$update_image_count);
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
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Upload Albums</span></a></li>
								<li><a href="#about" id="about-link" class="skel-layers-ignoreHref"><span class="icon fa-user">View Albums</span></a></li>
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
					
				<!-- Portfolio -->
					<section id="portfolio" class="two">
						<div class="container">
							<?php if(isset($err)) {echo $err;} ?>
							<header>
								<h2>
                                	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                                		<input type="text" name="album_name" placeholder="Album Name" />
                                        <input type="submit" name="create_album" value="Create" />
                                    </form>
                                </h2>
							</header>
                            <p><?php if(isset($notify)) { echo $notify; } ?></p>
							<form enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<p>Upload Photo's To : <select name="album_select">
                            <option value="">Select An Album To Upload Your Photo</option>
                            <?php
								if(isset($_SESSION['id']))
									{
										$src_album_name = "SELECT * FROM album_names WHERE(member_id='".$_SESSION['id']."')";
										$query_src_album_name = mysqli_query($conn,$src_album_name);
										while($results_album_name = mysqli_fetch_array($query_src_album_name))
											{
												$name = $results_album_name['album_name'];
							?>
                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                            <?php
											}
									}
							?>
												</select>	
                            </p>
                            <p>
                            	<input type="file" name="image" >
                                <input type="submit" name="upload_pic" value="&laquo; UPLOAD &raquo;" />
							</p>
                            </form>
							<div class="row">
								<div class="4u">
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic02.jpg" alt="" /></a>
										<header>
											<h3>Ipsum Feugiat</h3>
										</header>
									</article>
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic03.jpg" alt="" /></a>
										<header>
											<h3>Rhoncus Semper</h3>
										</header>
									</article>
								</div>
								<div class="4u">
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic04.jpg" alt="" /></a>
										<header>
											<h3>Magna Nullam</h3>
										</header>
									</article>
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic05.jpg" alt="" /></a>
										<header>
											<h3>Natoque Vitae</h3>
										</header>
									</article>
								</div>
								<div class="4u">
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic06.jpg" alt="" /></a>
										<header>
											<h3>Dolor Penatibus</h3>
										</header>
									</article>
									<article class="item">
										<a href="#" class="image fit"><img src="images/pic07.jpg" alt="" /></a>
										<header>
											<h3>Orci Convallis</h3>
										</header>
									</article>
								</div>
							</div>

						</div>
					</section>

				<!-- About Me -->
					<section id="about" class="three">
						<div class="container">

							<header>
                            	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
								<h2>
                                	View Photos Of : - <select name="album_select">
                                 <option value="">Select An Album To View Its Photos</option>
                            <?php
								if(isset($_SESSION['id']))
									{
										$src_album_name = "SELECT * FROM album_names WHERE(member_id='".$_SESSION['id']."')";
										$query_src_album_name = mysqli_query($conn,$src_album_name);
										while($results_album_name = mysqli_fetch_array($query_src_album_name))
											{
												$name = $results_album_name['album_name'];
							?>
                            <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                            <?php
											}
									}
							?>
												</select>   <input type="submit" name="view_images" value="&laquo; View Images &raquo;" />
                                </form>
                                </h2>
							</header>
                            <?php 
								if(isset($_POST['view_images']))
									{
										$album = $_POST['album_select'];
										if($album == "")
											{
												$ntfy = "Select An Album";
											}
										else
											{
												$src_img = "SELECT image FROM album_images WHERE(album_name='".$album."' AND member_id='".$_SESSION['id']."')";
												$query_src_img = mysqli_query($conn,$src_img);
												while($img_results = mysqli_fetch_array($query_src_img))
													{
							?>
                            <img src="<?php echo $img_results['image']; ?>" width="420" height="360">
                            <?php
								echo "<br>";
													}
											}
									}
							?>
                            

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