<?php 
	session_start();
	include_once "connection.php";
	if(!mysqli_connect_errno())
	{
		$user_info = array();
		$query1 = "SELECT * FROM user_core WHERE user_id = '$_SESSION[user_id]';";
		$query2 = "SELECT * FROM user_basic_info WHERE user_id = '$_SESSION[user_id]';";
		$query3 = "SELECT * FROM friends_info WHERE user_id = '$_SESSION[user_id]';";
		$query = $query1 . $query2 . $query3;
		if (mysqli_multi_query($con, $query)) 
		{
		    do 
		    {
		        /* store first result set */
		        if ($result = mysqli_store_result($con)) 
		        {

		            while ($ar = mysqli_fetch_row($result))
		            {
		            	$user_info = array_merge($user_info,$ar);
		                //echo count($user_info);
		            }
		            mysqli_free_result($result);
		        }
		        /* print divider */
		        if (mysqli_more_results($con)) 
		        {
		            //printf("-----------------\n");
		        }
		    
		    } while (mysqli_next_result($con));

		    //echo nl2br("New queries were successfull\n");
		}
		else 
		{
		    echo "Error: " . $sql_user_core . "<br>" . mysqli_error($con);
		}



		$user_result = mysqli_query($con, $query1);
		//$user_info = mysqli_fetch_array($user_result);
		mysqli_close($con);
	}
	
	$count=mysqli_num_rows($user_result);
	if($count == 0)
	{
		echo "ERROR OCURRED !!!";
	}
	
?>

<?php
	$row = $user_info;
	$propic =   $row[13] ; /*"images/cover_image2.jpg";*/
	$_SESSION['user_info'] = $row;
	if(isset($row[15])){
		$_SESSION['friends_list'] = $row[15];
	}
	
	//echo count($row);
	//print_r(array_values($row));
?>




<!DOCTYPE html>
<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" href="assets/css/nav_header_footer.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/profile.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/droping_box.css">
	<link rel="stylesheet" type="text/css" href="assets/css/notification.css">
	<link rel="stylesheet" type="text/css" href="assets/css/search_in_profile.css">

	<script src ="assets/scripts/jqlib/jquery-1.11.3.min.js"></script>
	<script src ="assets/scripts/jqlib/jquery-2.1.4.min.js"></script>
	<script src ="assets/scripts/jqlib/1.11.4-jquery-ui.js"></script>



	
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
						<a href="#" class="icon-user"></a>
					</li>
					<li class="notif">
						<a  class="icon-bell"></a>
					</li>
					
				</ul>
			</nav>
		</div>

		<!--  It handles searching for friends   -->
		<div id="search_for_friend" >
			<div class="icon-search" id="search_icon" ></div>
			<input id="search_input" type="text" placeholder="Search for your friends!">
			<div id="search_res" ></div>
		</div>
		<!--  It handles searching for friends   -->
		<!--  -->


		<!-- It handles The notification part -->
		<div id="notif_bar">
			<p style="margin-left:10px">Notifications</p>	
		</div>
		<!-- It handles The notification part -->
		<!--  -->


		<div id="upright">


<!-- 			<div id="im_container">
				  <div id="navi">afdsfdsfsdf</div>
				  <div id="infoi">
				    <img src="upload/shakil_propic.jpg" height="250" width="250" />b
				 </div>
			 </div>
 -->

<!-- 			 <div class="dropzone" id="dropzone"><h2>Drop Files Here to upload</h2></div> -->
			<div id="im"  style="background-image:url( <?php echo $propic ?> )">	<!-- style="background-image:url( <?php echo $propic ?> )" -->
			 </div>


			<P id = "phone_no" ><a  class="icon-phone"></a> 	<?php echo $row[7]; ?> </P>
			<div id="para1" style="display:none">
				<form class="hidden_edits" name = "phone_form" method = "post" action = "update_info.php">   <!--  -->
					<!-- <a href="#" class="icon-phone"></a> -->
					<input class="edit_info" id="edit_phone" name="edit_phone" type="text" placeholder="edit your phone no." required="required">
					<input class="edit_button" id="submit_phone" type="submit" value="edit">
				</form>
			</div>
			
			<P id = "address" ><a class="icon-map-marker"></a> 	<?php echo $row[8]; ?> </P>
			<div id="para2" style="display:none">
				<form class="hidden_edits" name = "address_form" method = "post" action = "update_info.php">   <!--  -->
					<!-- <a href="#" class="icon-phone"></a> -->
					<input class="edit_info" id="edit_address" name="edit_address" type="text" placeholder="edit your address." required="required">
					<input class="edit_button" id="submit_address" type="submit" value="edit">
				</form>
			</div>
			
			<P id = "facebook" ><a class="icon-facebook"></a> <?php echo $row[9]; ?> </P>
			<div id="para3" style="display:none">
				<form class="hidden_edits" name = "facebook_form" method = "post" action = "update_info.php">   <!--  -->
					<!-- <a href="#" class="icon-phone"></a> -->
					<input class="edit_info" id="edit_facebook" name="edit_facebook" type="text" placeholder="your FB link." required="required">
					<input class="edit_button" id="submit_facebook" type="submit" value="edit">
				</form>
			</div>
			
			<P id = "twitter" ><a class="icon-twitter"></a> 	<?php echo $row[10]; ?> </P>
			<div id="para4" style="display:none">
				<form class="hidden_edits" name = "twitter_form" method = "post" action = "update_info.php">   <!--  -->
					<!-- <a href="#" class="icon-phone"></a> -->
					<input class="edit_info" id="edit_twitter" name="edit_twitter" type="text" placeholder="your twitter link." required="required">
					<input class="edit_button" id="submit_twitter" type="submit" value="edit">
				</form>
			</div>

			<P><a href="" class="icon-envelope"></a> 	<?php echo $row[3]; ?> </P>

			<P id="website" ><a class="icon-globe"></a> 	<?php echo $row[11]; ?> </P>
			<div id="para5" style="display:none">
				<form class="hidden_edits" name = "website_form" method = "post" action = "update_info.php">   <!--  -->
					<!-- <a href="#" class="icon-phone"></a> -->
					<input class="edit_info" id="edit_website" name="edit_website" type="text" placeholder="your website link." required="required">
					<input class="edit_button" id="submit_website" type="submit" value="edit">
				</form>
			</div>


		</div>
		<div id="upleft">
			<div id="taskbar">
				<h2>Task Bar</h2><br><br>
				<p>1. CSE 482 Project</p>
			</div>
			
		</div>
		<div id="below">
			<h2> 	<?php echo $row[1]; ?> </h2>
			<h3>Senior</h3>
		</div>
		
		<footer>
	        <h2><i>CSE 482 Project:</i> A Student Utility System</h2>
            <a class="tzine" href="#">Shakil Ahmed(#121 0499 042)</a>
        </footer>

        <script src ="assets/scripts/profile.js"></script>
        <script src = "assets/scripts/upload_pro_pic.js"></script>
        <script src = "assets/scripts/notification.js"></script>
        <script src = "assets/scripts/search_in_profile.js"></script>
        /*<!-- <script src = "assets/scripts/test.js"></script> -->*/
</body>
</html>