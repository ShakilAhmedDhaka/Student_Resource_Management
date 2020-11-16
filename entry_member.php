<?php 
	session_start();
	include_once "connection.php";

	$_SESSION['email'] = $_POST['email'];
	$_SESSION['password'] = $_POST['password'];	

	$sql = 	"INSERT INTO user_core
			(name,student_id,email,pass,is_present)
			VALUES('$_POST[name]','$_POST[sid]','$_POST[email]','$_POST[password]',1)";


	$id_query = "SELECT user_id from user_core where email = '$_POST[email]'";
	
	

/*	$sql =
		'insert into user_core (name,student_id,email,pass,is_present)
		values("Shakil Ahmed","1210499042","shakilahmed@northsouth.edu","shakil123",1);';*/

	


	if(mysqli_query($con,$sql))
	{

	}
	else
	{
		echo "Error: ".$sql."<br>".mysqli_error($con);
	}


	if($result = mysqli_query($con,$id_query))
	{
		$row = mysqli_fetch_array($result);
		$id = $row[0];
	}
	else
	{
		echo "Error: ".$id_query."<br>".mysqli_error($con);
	}

	$fu =  'upload/' . (string) $id . '/';
	mkdir('upload/' . (string) $id);


	$sql = 	"UPDATE user_core
			SET file_url = '$fu'
			WHERE email = '$_POST[email]'";

	$sql2 = "INSERT INTO user_basic_info 
			(phone,address,facebook,twiter,website,user_id)
			values('update phone no.','add your address','give your FB link','give your twitter link','have a website?','$id')";

	$sql3 = "INSERT INTO friends_info 
			(friends_list,user_id)
			values('','$id')";


	if(mysqli_query($con,$sql2))
	{

	}
	else
	{
		echo "Error: ".$sql2."<br>".mysqli_error($con);
	}

	if(mysqli_query($con,$sql))
	{

	}
	else
	{
		echo "Error: ".$sql."<br>".mysqli_error($con);
	}

	if(mysqli_query($con,$sql3))
	{

	}
	else
	{
		echo "Error: ".$sql3."<br>".mysqli_error($con);
	}



		
	mysqli_close($con);
	header("location:check_login.php");
?>