<?php
	session_start();
	require_once("php/db.php");
	$_GET['id'];
	$_SESSION['id'];
	
	if(isset($_SESSION['id']))
		{
			$details = "SELECT * FROM members WHERE(id='".$_SESSION['id']."')";
			$query_details = mysqli_query($conn,$details);
			$res = mysqli_fetch_array($query_details);
		}
	if(isset($_POST['update_info']))
		{
			$schclg = $_POST['education'];
			$work = $_POST['work'];
			$about = $_POST['about'];
			$quote = $_POST['quote'];
			$bday = $_POST['bday'];
			$bmonth = $_POST['bmonth'];
			$byear = $_POST['byear'];
			$gender = $_POST['gender'];
			$relation = $_POST['relationship_status'];
			$interested = $_POST['interested_in'];
			$religion = $_POST['religion'];
			$hometown = $_POST['hometown'];
			$current_city = $_POST['current_City'];
			$mobile = $_POST['mobile'];
			$email = $_POST['email'];
			
			if($schclg != "")
				{ 
					$update = "UPDATE members_info SET schclg='$schclg' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($work != "")
				{ 
					$update = "UPDATE members_info SET work='$work' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($about != "")
				{ 
					$update = "UPDATE members_info SET about='$about' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($quote != "")
				{ 
					$update = "UPDATE members_info SET quote='$quote' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($bday != "")
				{ 
					$update = "UPDATE members_info SET b_day='$bday' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($bmonth != "")
				{ 
					$update = "UPDATE members_info SET b_month='$bmonth' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($byear != "")
				{ 
					$update = "UPDATE members_info SET b_year='$byear' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($gender != "")
				{ 
					$update = "UPDATE members_info SET gender='$gender' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($relation != "")
				{ 
					$update = "UPDATE members_info SET relationship='$relation' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($interested != "")
				{ 
					$update = "UPDATE members_info SET interested_in='$interested' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($relegion != "")
				{ 
					$update = "UPDATE members_info SET relegion='$relegion' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($hometown != "")
				{ 
					$update = "UPDATE members_info SET hometown='$hometown' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($current_city != "")
				{ 
					$update = "UPDATE members_info SET current_city='$current_city' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($mobile != "")
				{ 
					$update = "UPDATE members_info SET mobile='$mobile' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
			if($email != "")
				{ 
					$update = "UPDATE members_info SET email='$email' WHERE(member_id='".$_SESSION['id']."')";
					$query = mysqli_query($conn,$update);
				}
		}
	
?>
<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Prologue by HTML5 UP</title>
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
									if($res['avatar'] == '0')
										{
								?>
								<img src="images/avatar.jpg" alt="" />
								<?php	
										}
									else
										{
								?>
								<img src="<?php echo $res['avatar']; ?>" alt="<?php echo $results['firstname']; ?>" />
								<?php	
										}
								?>
							</span>
							<h1 id="title"><?php echo $res['firstname']; ?></h1>
							<p><?php echo $res['lastname']; ?></p>
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
								<li><a href="#portfolio" id="portfolio-link" class="skel-layers-ignoreHref"><span class="icon fa-th">Update Intro</span></a></li>
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

				<!-- Intro -->
					<section id="top" class="one dark cover">
						<div class="container">
                        
							<header>
                            <div class="row">
                              <div class="4u">
                                <article class="item">
								<?php	
									if($res['avatar'] == '0')
										{
								?>
								<img class="image fit" src="images/pic04.jpg" alt="" />
								<?php	
										}
									else
										{
								?>
								<img class="image fit" src="<?php echo $res['avatar']; ?>" alt="<?php echo $res['firstname']; ?>" />
								<?php	
										}
								?>
										
											<h3><?php echo ''.$res['firstname'].' '.$res['lastname'].'' ?></h3>
										
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
						<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
							<header>
								<h2>Portfolio</h2>
							</header>
						
							<div class="row">
								<div class="4u">
									<article class="item">
										<header>
											<h2>Education</h2>
										</header>
									</article>
									<article class="item">
										<input type="text" name="education" placeholder="School/College" size="22" />
										<header>
											<h3>School / College</h3>
										</header>
									</article>
                                    <article class="item">
										<header>
											<h2>Work</h2>
										</header>
									</article>
									<article class="item">
										<input type="text" name="work" placeholder="Work" size="22" />
										<header>
											<h3>Work</h3>
										</header>
									</article>
                                    <article class="item">
										<header>
											<h2>About You</h2>
										</header>
									</article>
                                    <article class="item">
                                   		 <textarea rows="1" cols="25" style="resize:none;" name="about"></textarea>
                                     </article>
                                     <article class="item">
										<header>
											<h2>Favorite Quotes</h2>
										</header>
									</article>
                                    <article class="item">
                                   		 <textarea rows="2" cols="25" style="resize:none;" name="quote"></textarea>
                                     </article>
								</div>
								<div class="4u">
									<article class="item">
										<header>
											<h2>Basic Info</h2>
										</header>
									</article>
									<article class="item">
										<select name="bday">
                                        	<option value="">Day</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                            <option value="13">13</option>
                                            <option value="14">14</option>
                                            <option value="15">15</option>
                                            <option value="16">16</option>
                                            <option value="17">17</option>
                                            <option value="18">18</option>
                                            <option value="19">19</option>
                                            <option value="20">20</option>
                                            <option value="21">21</option>
                                            <option value="22">22</option>
                                            <option value="23">23</option>
                                            <option value="24">24</option>
                                            <option value="25">25</option>
                                            <option value="26">26</option>
                                            <option value="27">27</option>
                                            <option value="28">28</option>
                                            <option value="29">29</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                         </select>
                                         <select name="bmonth">
                                        	<option value="">Month</option>
											<option value="January">January</option>
											<option value="Feburary">Feburary</option>
											<option value="March">March</option>
											<option value="April">April</option>
											<option value="May">May</option>
											<option value="June">June</option>
											<option value="July">July</option>
											<option value="August">August</option>
											<option value="September">September</option>
											<option value="October">October</option>
											<option value="November">November</option>
											<option value="December">December</option>
                                         </select>
                                         <select name="byear">
                                        	<option value="">Year</option>
											<option value="1990">1990</option>
											<option value="1991">1991</option>
											<option value="1992">1992</option>
											<option value="1993">1993</option>
											<option value="1994">1994</option>
											<option value="1995">1995</option>
											<option value="1996">1996</option>
											<option value="1997">1997</option>
											<option value="1998">1998</option>
											<option value="1999">1999</option>
											<option value="2000">2000</option>
											<option value="2001">2001</option>
											<option value="2002">2002</option>
											<option value="2003">2003</option>
											<option value="2004">2004</option>
                                         </select>
										<header>
											<h3>Birthday</h3>
										</header>
									</article>
                                    <article class="item">
                                    	<select name="gender">
                                        	<option value="">Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <header>
											<h3>Gender</h3>
										</header>
                                     </article>
                                    <article class="item">
                                    	<select name="relationship_status">
                                        	<option value="">Relationship status</option>
                                            <option value="Single">Single</option>
                                            <option value="In A Relation">In A Relation</option>
                                            <option value="Engaged">Engaged</option>
                                            <option value="Married">Married</option>
                                            <option value="In A Civil Union">In A Civil Union</option>
                                            <option value="In A Domestic Partnership">In A Domestic Partnership</option>
                                            <option value="In A Open Relation">In A Open Relation</option>
                                            <option value="Its Complicated">It's Complicated</option>
                                            <option value="Seperated">Seperated</option>
                                            <option value="Divorced">Divorced</option>
                                            <option value="Widowed">Widowed</option>
                                        </select>
                                        <header>
											<h3>Relationship Status</h3>
										</header>
                                     </article>
                                     <article class="item">
                                    	<select name="intrested_in">
                                        	<option value="">Intrested In</option>
                                            <option value="Men">Men</option>
                                            <option value="Women">Women</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <header>
											<h3>Intrested In</h3>
										</header>
                                     </article>
                                     <atricle class="item">
                                     	<input type="text" name="religion" placeholder="Relegious Views" />
                                       <header>
                                       	<h3>Religion</h3>
                                       </header>
                                    </article>
								</div>
								<div class="4u">
									<article class="item">
										<header>
											<h2>Places You've Lived</h2>
										</header>
									</article>
									<article class="item">
										<input type="text" name="hometown" placeholder="Hometown" />
										<header>
											<h3>Hometown</h3>
										</header>
									</article>
                                    <article class="item">
										<input type="text" name="current_City" placeholder="Current City" />
										<header>
											<h3>Current City</h3>
										</header>
									</article>
                                    <article class="item">
										<header>
											<h2>Contact Info :</h2>
										</header>
									</article>
                                    <article class="item">
										<input type="text" name="mobile" placeholder="Mobile No." />
										<header>
											<h3>Mobile Number</h3>
										</header>
									</article>
                                    <article class="item">
										<input type="email" name="email" placeholder="E-Mail Address" />
										<header>
											<h3>E-Mail Address</h3>
										</header>
									</article>
								</div>
							</div>
                            <input type="submit" name="update_info" value="&laquo Update Info &raquo;" />
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