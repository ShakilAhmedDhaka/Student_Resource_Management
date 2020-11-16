<?php 
	session_start();
	include_once "connection.php";
	$u_core_info = $_SESSION['user_core_info_frnd'];
	$u_basic_info = $_SESSION['user_basic_info_frnd'];
?>





<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" href="assets/css/nav_header_footer.css" />
	<!-- <link rel="stylesheet" type="text/css" href="assets/css/profile.css"> -->
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/droping_box.css">
	<link rel="stylesheet" type="text/css" href="assets/css/notification.css">
	<link rel="stylesheet" type="text/css" href="assets/css/search_in_profile.css">
	<link rel="stylesheet" type="text/css" href="assets/css/see_profile.css">

	<script src ="assets/scripts/jqlib/jquery-1.11.3.min.js"></script>
	<script src ="assets/scripts/jqlib/jquery-2.1.4.min.js"></script>
	<script src ="assets/scripts/jqlib/1.11.4-jquery-ui.js"></script>
	<script src ="assets/scripts/send_frnd_req.js"></script>


	
</head>
<body>
		<div style="margin:0 auto;width:50%">
	    	<nav id="colorNav">
				<ul>
					<li class="green">
						<a href="index.php" class="icon-home"></a>
					</li>
					<li class="red">
						<a href="updown.php" class="icon-file"></a>
					</li>
					<li class="blue">
						<a href="#" class="icon-calendar"></a>
					</li>
					<li class="yellow">
						<a href="#" class="icon-comment"></a>
					</li>
					<li class="purple">
						<a href="profile.php" class="icon-user"></a>
					</li>
					<li class="notif">
						<a  class="icon-bell"></a>
					</li>
					
				</ul>
			</nav>
		</div>


		<div id="add_friend">
			<button id="add_friend_button"> Add Friend </button>
			<button id="already_friends_button"> Friends </button>
			<button id="request_sent_button"> Request Sent </button>
			<button id="accept_request_button"> Accept Request </button>
		</div>

		<div id="notif_bar">
			<p style="margin-left:10px">Notifications</p>	
		</div>


		<div id="upright">

			<div id="im"  style="background-image:url( <?php echo $u_basic_info[6] ?> )">	<!-- style="background-image:url( <?php echo $propic ?> )" -->
			 </div>


			<P id = "phone_no" ><a  class="icon-phone"></a> 	<?php echo $u_basic_info[0]; ?> </P>
			
			<P id = "address" ><a class="icon-map-marker"></a> 	<?php echo $u_basic_info[1]; ?> </P>
			
			<P id = "facebook" ><a class="icon-facebook"></a> <?php echo $u_basic_info[2]; ?> </P>
			
			<P id = "twitter" ><a class="icon-twitter"></a> 	<?php echo $u_basic_info[3]; ?> </P>

			<P><a href="" class="icon-envelope"></a> 	<?php echo $u_core_info[3]; ?> </P>

			<P id="website" ><a class="icon-globe"></a> 	<?php echo $u_basic_info[4]; ?> </P>

		</div>

		<div id="below">
			<h2> 	<?php echo $u_core_info[1]; ?> </h2>
			<h3>Senior</h3>
		</div>
		
		<footer>
	        <h2><i>CSE 482 Project:</i> A Student Utility System</h2>
            <a class="tzine" href="#">Shakil Ahmed(#121 0499 042)</a>
        </footer>
     
        <script src = "assets/scripts/notification.js"></script>
</body>
</html>