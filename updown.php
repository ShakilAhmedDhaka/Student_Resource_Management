<?php
	session_start();

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="stylesheet" type="text/css" href="assets/css/nav_header_footer.css">
	<link rel="stylesheet" type="text/css" href="assets/css/updown_style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/customized_menu.css">
	<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/droping_box.css">
	<link rel="stylesheet" type="text/css" href="assets/css/notification.css">
	<link rel="stylesheet" type="text/css" href="assets/css/rename_prompt.css">
	<link rel="stylesheet" type="text/css" href="assets/css/share_prompt.css">

	<script src ="assets/scripts/jqlib/jquery-1.11.3.min.js"></script>
	<script src ="assets/scripts/jqlib/jquery-2.1.4.min.js"></script>

<!-- 	/*<script src="https://code.jquery.com/jquery-1.8.3.js"></script>
	<script src="https://code.jquery.com/jquery-1.10.1.js"></script>
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>*/ -->

	<title>Documents</title>
</head>
<body>

	<div>
    	<nav id="colorNav">
			<ul>
				<li class="green">
					<a href="index.php" class="icon-home"></a>
				</li>
				<li class="red">
					<a href="#" class="icon-file"></a>
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

	<div id="notif_bar">
		<p style="margin-left:10px">Notifications</p>	
	</div>

	<div id="upload"> </div>
	<div class="dropzone" id="dropzone"><h2>Drop Files Here to upload</h2></div>

	
	<div id="file_list1" data-id="1">
		<div class="icon_name" id="icon_name">
			<div style="width:10%;height:45px;line-height: 45px;;float:left;border-radius:100px;margin: 2px 5px 2px 5px;text-align:center;">
				 <!-- <img id="imageForFileList1"  src="images/file_icon2.png" > -->
			</div>
			<div style="width:50%;height:50%;float:left;padding-left:30px;padding-top:15px"><p>Name</p></div>
		</div>
		<div class="file_description">
			<div style="float:left;text-align:center;width:35%;height:100%;padding-top:15px"><p>Owner</p></div>
			<div style="float:right;text-align:center;width:65%;height:100%;padding-top:15px"><p>Last Modified</p></div>
		</div>
	</div>


	<div id="list_container">
		<div class="file_list" id="file_list2" data-id="1">
			<div class="icon_name" id="icon_name">
				<div style="width:10%;height:45px;line-height: 45px;;float:left;border-radius:100px;background-color:#F6F6F6;margin: 2px 5px 2px 5px;text-align:center;">
					<img style="vertical-align:middle" src="images/file_icon2.png" height="35px" width="35px">

				</div>
				<div style="width:50%;height:50%;float:left;padding-left:30px;padding-top:15px"><p>Slide.txt</p></div>
			</div>
			<div class="file_description">
				<div style="float:left;text-align:center;width:40%;height:100%;padding-top:15px"><p>Owner</p></div>
				<div style="float:right;text-align:center;width:60%;height:100%;padding-top:15px"><p>Last Modified</p></div>
			</div>

		</div>
	</div>

	<div id="rename_prompt">
		<h3>Rename</h3>
		<p>Please enter a new name:</p>
		<form>
			<input id="rename_prompt_txt"  name="rename_text" type="text" placeholder="edit your file name" required="required"><br><br>
			<!-- <div style="text-align:right">
				<input id="ok_button" style="width:60px" name="ok_button" type="submit" value="Ok">
				<input id="cancel_button" style="width:60px" name="cancel_button" type="submit" value="Cancel">
			</div> -->
		</form>
		<div class="buttons_holder">
			<button id="ok_button" class="rename_buttons"> Ok </button>
			<button id="cancel_button" class="rename_buttons"> Cancel </button>
		</div>
	</div>


	<div id="share_prompt" >
		<h3>Share with friends!</h3>
		<div id="frinds_list_container"></div>
		<div class="buttons_holder">
			<button id="ok_button_share" class="rename_buttons"> Ok </button>
			<button id="cancel_button_share" class="rename_buttons"> Cancel </button>
		</div>
	</div>



	<nav id="context-menu" class="context-menu">
    <ul class="context-menu__items">
      <li class="context-menu__item">
        <a href="#" download class="context-menu__link" id="download_option" data-action="Download"><i class="fa fa-eye"></i> Download</a>
      </li>
      <li class="context-menu__item" id="rename_option">
        <a href="#" class="context-menu__link"  data-action="rename"><i class="fa fa-edit"></i> Rename </a>
      </li>
      <li class="context-menu__item" id="delete_option">
        <a href="#" class="context-menu__link"  data-action="delete"><i class="fa fa-times"></i> Delete </a>
      </li>
      <li class="context-menu__item" id="share_option">
        <a href="#" class="context-menu__link"  data-action="share"><i class="fa fa-times"></i> Share </a>
      </li>
    </ul>
  </nav>


  	<footer>
        <h2><i>CSE 482 Project:</i> A Student Utility System</h2>
        <a class="tzine" href="#">Shakil Ahmed(#121 0499 042)</a>
   	</footer>

	<script src = "assets/scripts/generate_list.js"></script>
	<script src = "assets/scripts/notification.js"></script>

	<!-- Rest of the scrips are called from test.js -->

</body>
</html>