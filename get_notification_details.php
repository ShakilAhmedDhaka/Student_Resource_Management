<?php
session_start();
include_once "connection.php";


$fd_arary = array();
$url_query = "SELECT * from notif_info where to_id = '$_SESSION[user_id]'";
if($get_query = mysqli_query($con,$url_query))
{
    while($row = mysqli_fetch_array($get_query)){
    	$imq = "SELECT propic from user_basic_info where user_id = '$row[3]'";

    	if($get_query2 = mysqli_query($con,$imq))
		{
		    while($row1 = mysqli_fetch_array($get_query2)){
		        $url = $row1[0];
		    }
		}
		else
		{
		    echo "Error: ".$imq."<br>".mysqli_error($con);
		}



        $file_info = $row[0] . "#". $row[1] . "#". $row[2] . "#". $row[3] . "#". $row[4] . "#" . $url;
        array_push($fd_arary, $file_info);
    }
}
else
{
    echo "Error: ".$url_query."<br>".mysqli_error($con);
}



#print_r($fd_arary);

echo json_encode($fd_arary);


?>