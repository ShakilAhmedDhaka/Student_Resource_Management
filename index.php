<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Home</title>
        <link rel="stylesheet" href="assets/css/nav_header_footer.css" />
        <link rel="stylesheet" href="assets/css/index.css" />
		<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css" />

	<script src ="assets/scripts/jqlib/jquery-1.11.3.min.js"></script>
	<script src ="assets/scripts/jqlib/jquery-2.1.4.min.js"></script>
	<script src ="assets/scripts/jqlib/1.11.4-jquery-ui.js"></script>
		
		<style>
		

		</style>

    </head>
    
    <body>
    	<div style="background-image:url('images/home_image2.jpg');height:700px">
	    	<nav id="colorNav">
				<ul>
					<li class="green">
						<a href="#" class="icon-home"></a>
					</li>
					<li class="red">
						<a href="#" class="icon-file"></a>
						<ul>
							<li><a href="#">Upload</a></li>
							<li><a href="#">Download</a></li>
						</ul>
					</li>
					<li class="blue">
						<a href="#" class="icon-calendar"></a>
					</li>
					<li class="yellow">
						<a href="#" class="icon-comment"></a>
						<ul>
							<li><a href="#">Inbox</a></li>
							<li><a href="#">ChatBox</a></li>
						</ul>
					</li>
					<li class="purple">
						<a href="#" class="icon-user"></a>
					</li>
				</ul>
			</nav>
		</div>
		<div style="background-color:#FFD700;height:300px;text-align:center;color:#2F4F4F">
			<h2 style="padding-top:40px">Welcome to NSU Connect</h2><br><br>
			<button class="btn" name = "btn1" value="btn1" onclick="location.href='form.php'">Registration</button>
			<button class="btn" name = "btn2" value="btn2">Log in</button>
			<br><br><br>
			<div id="para" style=" display:none">
				<form name = "log_in" method = "post"  action = "check_login.php">
					Email: <input class="form_input" type="text" name="email" id="email" required="required">
					Password: <input  class="form_input" type="password" name="password" id="password" required="required">
					<input  id="form_input_submit" type="submit" value="Submit">
				</form>
			</div>
			<script src = "assets/scripts/index.js" ></script>
		</div>

        <footer>
	        <h2><i>CSE 482 Project:</i> A Student Utility System</h2>
            <a class="tzine" href="#">Shakil Ahmed(#121 0499 042)</a>
        </footer>
    </body>
</html>
