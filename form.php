<!DOCTYPE html>
<html>
<head>
<title>NSU Connect</title>
	<meta content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/css/style_form.css" media="all" />
    <link rel="stylesheet" type="text/css" href="assets/css/demo.css" media="all" />
</head>
<body>
	<div class="container">
		<!--Top bar -->
        <div class="signup-top">
            <a href="index.html" target="_blank">Home</a>
            <div class="clr"></div>
        </div><!--/ signup-top top bar -->
		<header>
			<h1><span>Nsu Connect</span>Sign Up</h1>
  		</header>       
  		<div  class="form">
			<form id="contactform" name = "member_registration" method = "post"  action = "entry_member.php"> 
				<p class="contact"><label for="name">Name</label></p> 
				<input id="name" name="name" placeholder="Full Name" required="" tabindex="1" type="text"> 
				 
				<p class="contact"><label for="sid">Student ID Number</label></p> 
				<input id="sid" name="sid" placeholder="10 Digit ID number" required="" type="text"> 
				<p class="contact"><label for="email">Student Email ID</label></p> 
				<input id="email" name="email" placeholder="......@northsouth.edu" required="" type="text"> 
	            
	          <!--  <p class="contact"><label for="username">Create a username</label></p> 
				<input id="username" name="username" placeholder="username" required="" tabindex="2" type="text"> -->
				 
	            <p class="contact"><label for="password">Create a password</label></p> 
				<input type="password" id="password" name="password" required=""> 
	            <p class="contact"><label for="repassword">Confirm your password</label></p> 
				<input type="password" id="repassword" name="repassword" required=""> 
		        <p class="contact"><label for="phone">Mobile phone</label></p> 
		        <input id="phone" name="phone" placeholder="phone number" required="" type="text"> <br>

		        <input class="buttom" name="submit" id="submit" tabindex="5" value="Sign me up!" type="submit"> 	 
		   </form> 
		</div>      
	</div>

</body>
</html>
