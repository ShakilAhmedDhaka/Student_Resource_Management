<?php
session_start();
include_once "connection.php";
include "ChromePhp.php";

ChromePhp::log("get_file_details2.php starts");
#$dir =  'upload/';
	#$files = array_diff(scandir($dir), array('..', '.'));
	#print_r($files);
	#print_r(filesize($files[2]));


$fd_arary = array();
$url_query = "SELECT file_id,file_name,modif_date from file_info where owner = '$_SESSION[user_id]'";
if($get_query = mysqli_query($con,$url_query))
{
    while($row = mysqli_fetch_array($get_query)){
        $file_info = $row[1] . "#". $row[2] . "#" ."YOU" . "#" . $row[0];
        array_push($fd_arary, $file_info);
    }
}
else
{
    echo "Error: ".$url_query."<br>".mysqli_error($con);
}


$url_query = "SELECT friends_list from friends_info where user_id = '$_SESSION[user_id]'";
if($get_query = mysqli_query($con,$url_query))
{
    while($row = mysqli_fetch_array($get_query)){
    	$friends = $row[0];
    }

}
else
{
    echo "Error: ".$url_query."<br>".mysqli_error($con);
}


//ChromePhp::log($friends);
$arf = explode("#", $friends);
$cnt=count($arf);

for($i=1;$i<$cnt;$i++){
	ChromePhp::log($arf[$i]);
	$name_query = "SELECT name from user_core where user_id = '$arf[$i]'";
	if($get_query = mysqli_query($con,$name_query))
	{
	    while($row = mysqli_fetch_array($get_query)){
	    	$fname = $row[0];
	    }
	}
	else
	{
	    echo "Error: ".$name_query."<br>".mysqli_error($con);
	}



	$url_query = "SELECT shared_friends,file_name,modif_date,file_id from file_info where owner = '$arf[$i]'";
	if($get_query = mysqli_query($con,$url_query))
	{
	    while($row = mysqli_fetch_array($get_query)){
	    	ChromePhp::log($row[0]);
	    	$sf = explode("#",$row[0]);
	    	$cnt2 = count($sf);
	    	for($j=1;$j<$cnt2;$j++){
	    		if($sf[$j] == $_SESSION['user_id']){
	    			$file_info = $row[1] . "#". $row[2] . "#" . $fname . "#" . $row[3];
        			array_push($fd_arary, $file_info);
	    		}
	    	}
	    }
	}
	else
	{
	    echo "Error: ".$url_query."<br>".mysqli_error($con);
	}
}




#print_r($fd_arary);

echo json_encode($fd_arary);

?>