<?php
session_start();
include_once "connection.php";
include "ChromePhp.php";


$fd_arary = array();
$uid="";

$url_query = "SELECT * from user_core where email = '$_POST[femail]'";
if($get_query = mysqli_query($con,$url_query))
{
    while($row = mysqli_fetch_array($get_query)){
    	$file_info = $row[1];
    	$uid = $row[0];
    	$_SESSION['user_core_info_frnd'] = $row;
    }
    ChromePhp::log($_SESSION['user_core_info_frnd']);
}
else
{
    echo "Error: ".$url_query."<br>".mysqli_error($con);
}

$url_query2 = "SELECT * from user_basic_info where  user_id = '$uid'";
if($get_query2 = mysqli_query($con,$url_query2))
{
    while($row2 = mysqli_fetch_array($get_query2)){
    	$file_info .= "#". $row2[0];
    	$_SESSION['user_basic_info_frnd'] = $row2;
    }
    ChromePhp::log($_SESSION['user_basic_info_frnd']);
}
else
{
    echo "Error: ".$url_query2."<br>".mysqli_error($con);
}



//$file_info = $row2[0] . "#". $row[1];
//array_push($fd_arary, $file_info);

//echo json_encode($_SESSION['user_core_info'][0]);

#print_r($fd_arary);
echo json_encode($file_info);
//header("location:see_profile.php");

?>



