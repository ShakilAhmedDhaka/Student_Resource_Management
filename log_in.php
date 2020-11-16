<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/log_in.css">
</head>

<body background= "images/sign_in.jpg">
<div class=container>
	<h1> Welcome To Museum Management System!</h1>
    <form name = "log_in" method = "post"  action = "check_login.php">
	<table>
	<tr>
		<td> User Name</td>
		<td><input type = "text" name = "user_name" id = "user_name" size = "40" required = "required"></td>
	</tr>
	<tr>
		<td> Password:</td>
		<td><input type = "password" name = "password" id = "password" size = "40" required = "required"></td>
	</tr>
	<tr>
		<td class = "hel"><input type = "submit" name = "submit" value = "Save"></td>
	</tr>
</table>
</form>
</div>

</body>
</html>