<?php 
	session_start();
	include_once "connection.php";
	include "ChromePhp.php";


	ChromePhp::log("send_frnd_req.php starts");

	$u_core_info = $_SESSION['user_core_info_frnd'];
	$u_basic_info = $_SESSION['user_basic_info_frnd'];
	$message = $_SESSION['user_info'][1] . " send you a friend request!";

	$sql =
	"INSERT into notif_info (notif_message,notif_type,from_id,to_id)
	values('$message','friend_request',$_SESSION[user_id],$u_core_info[0]);";

	if (mysqli_multi_query($con, $sql)) {
	    
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($con);
	}

	header("location:see_profile.php");


?>