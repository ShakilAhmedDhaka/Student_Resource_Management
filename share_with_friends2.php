<?php
session_start();
include_once "connection.php";
include "ChromePhp.php";

ChromePhp::log("share_with_friends2.php starts");
ChromePhp::log($_POST['ids']);
ChromePhp::log($_POST['file_id']);
$fd_arary = array();
$ar = explode("#", $_POST['ids']);
for($i=0;$i<count($ar);$i++){
    array_push($fd_arary, $ar[$i]);
}


$frnd_query = "UPDATE file_info set shared_friends = '$_POST[ids]' where file_id = '$_POST[file_id]'";
if($get_query = mysqli_query($con,$frnd_query))
{
   
}
else
{
    echo "Error: ".$frnd_query."<br>".mysqli_error($con);
}




echo json_encode($fd_arary);



?>