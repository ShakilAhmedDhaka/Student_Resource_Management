<?php
	session_start();
	if(!isset($_SESSION['user_id']))
	{
		//header("location:log_in.php");
		echo "Didnt work :(";
		exit();
	}
?>

<html>
<body>
	<h1>Login Successful<h1>
</body>
</html>

<?php
	header("location:profile.php");
?>