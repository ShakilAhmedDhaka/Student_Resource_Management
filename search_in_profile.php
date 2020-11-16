<?php
session_start();
include_once "connection.php";
include "ChromePhp.php";


$fd_arary = array();
if($_POST['femail'] == $_SESSION['user_info'][3]){
	array_push($fd_arary, "self#hello");
	echo json_encode($fd_arary);
}
else{


	ChromePhp::log("search_in_profile.php starts");

	$uid="";

	$url_query = "SELECT user_id,name from user_core where email = '$_POST[femail]'";
	if($get_query = mysqli_query($con,$url_query))
	{
	    while($row = mysqli_fetch_array($get_query)){
	    	$file_info = $row[1];
	    	$uid = $row[0];
	    }

	    if(!isset($file_info)){
	    	ChromePhp::log("wrong email");

	    	array_push($fd_arary, "wrong#email");
	    	echo json_encode($fd_arary);
	    }
	}
	else
	{
	    echo "Error: ".$url_query."<br>".mysqli_error($con);
	}
	if(isset($file_info)){

		$url_query2 = "SELECT propic from user_basic_info where  user_id = '$uid'";
		if($get_query2 = mysqli_query($con,$url_query2))
		{
		    while($row2 = mysqli_fetch_array($get_query2)){
		    	$file_info .= "#". $row2[0];
		    }
		}
		else
		{
		    echo "Error: ".$url_query2."<br>".mysqli_error($con);
		}

		//$file_info = $row2[0] . "#". $row[1];
		array_push($fd_arary, $file_info);
		#print_r($fd_arary);

		echo json_encode($fd_arary);
	}

}




?>