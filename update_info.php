<?php
	session_start();
	include_once "connection.php";



	if( isset($_POST['edit_phone']) ){

		$sql = "UPDATE user_basic_info 
			set phone = '$_POST[edit_phone]'
			where user_id = '$_SESSION[user_id]'";
	}

	if( isset($_POST['edit_address'])){
		$sql = "UPDATE user_basic_info 
			set address = '$_POST[edit_address]'
			where user_id = '$_SESSION[user_id]'";
	}
	
	if( isset($_POST['edit_facebook'])){
		$sql = "UPDATE user_basic_info 
			set facebook= '$_POST[edit_facebook]'
			where user_id = '$_SESSION[user_id]'";
	}

	if( isset($_POST['edit_twitter'])){
		$sql = "UPDATE user_basic_info 
			set twiter = '$_POST[edit_twitter]'
			where user_id = '$_SESSION[user_id]'";
	}

	if( isset($_POST['edit_website'])){
		$sql = "UPDATE user_basic_info 
			set website = '$_POST[edit_website]'
			where user_id = '$_SESSION[user_id]'";
	}



	if(mysqli_query($con,$sql))
	{

	}
	else
	{
		echo "Error: ".$sql."<br>".mysqli_error($con);
	}



	mysqli_close($con);
	header("location:profile.php");
?>