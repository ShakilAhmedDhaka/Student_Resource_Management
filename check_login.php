<?php
	session_start();
	include_once "connection.php";
	
	// username and password sent from form


	if(isset($_SESSION['email']) && isset($_SESSION['password'])  ){

		$myemail=$_SESSION['email'];
		$mypassword=$_SESSION['password'];
	}

	if(isset($_POST['email']) && isset($_POST['password'])  ){

		$myemail=$_POST['email'];
		$mypassword=$_POST['password'];
	}
	
	
	if(!mysqli_connect_errno())
	{
		$result = mysqli_query($con, "SELECT * FROM user_core WHERE email='$myemail' AND pass='$mypassword' ");
		$row = mysqli_fetch_array($result);
		mysqli_close($con);
	}
	
	// Mysql_num_row is counting table row
	$count=mysqli_num_rows($result);

	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1)
	{	
		$_SESSION['user_id'] = $row['user_id'];
		echo "SUCCESSFULLY LOGIN TO USER PROFILE PAGE...";
		header("location:login_success.php");
	}
	else 
	{
		echo "Wrong Username or Password";
	}
?>