<?php
session_start();
include_once "connection.php";
include "ChromePhp.php";

ChromePhp::log("share_with_friends.php starts");
ChromePhp::log($_POST['file_id']);


$fff = "";
$frnd_query = "SELECT shared_friends from file_info where file_id = '$_POST[file_id]'";
if($get_query = mysqli_query($con,$frnd_query))
{
    while($row = mysqli_fetch_array($get_query)){
    	$fff = $row[0];

    }
}
else
{
    echo "Error: ".$frnd_query."<br>".mysqli_error($con);
}

$shared_friends = explode("#", $fff);
ChromePhp::log($shared_friends);



$fd_arary = array();

$frnd_query = "SELECT friends_list from friends_info where user_id = '$_SESSION[user_id]'";
if($get_query = mysqli_query($con,$frnd_query))
{
    while($row = mysqli_fetch_array($get_query)){
    	$frnds_list = $row[0];
    }
}
else
{
    echo "Error: ".$frnd_query."<br>".mysqli_error($con);
}


$frnds_array = explode("#", $frnds_list);
ChromePhp::log($frnds_array);


$cnt = count($frnds_array);

$get_frnds_query = "";
for($i=1;$i<$cnt;$i++){
	$frnd_id = (int) $frnds_array[$i];
	//ChromePhp::log($frnd_id);
	$get_frnds_query .= "SELECT name from user_core where user_id = '$frnd_id';";
	$get_frnds_query .= "SELECT propic from user_basic_info where user_id = '$frnd_id';";
	$get_frnds_query .= "SELECT user_id from user_basic_info where user_id = '$frnd_id';";
}
//ChromePhp::log($get_frnds_query);
$frnd_det = array();
$cnn = 0;
$cxx = 0;
if (mysqli_multi_query($con, $get_frnds_query)) 
{
    do 
    {
        if ($result = mysqli_store_result($con)) 
        {
            while ($row = mysqli_fetch_row($result)) 
            {
                array_push($frnd_det, $row[0]);
                $cnn++;
                $cxx++;
            }
            mysqli_free_result($result);
        }

        if (mysqli_more_results($con)){}
        	if($cnn ==3){
        		$cnn=0;
        		 array_push($frnd_det, "no");
        		for($i=1;$i<count($shared_friends);$i++){
        			if($frnd_det[$cxx-1] ==  (int)$shared_friends[$i] ){
        				$frnd_det[$cxx] = "yes";
        			}
        		}
        		$cxx++;
        	}
        	//ChromePhp::log($cnn);
    } while (mysqli_next_result($con));
}
else 
{
    echo "Error: " . $get_frnds_query . "<br>" . mysqli_error($con);
}

ChromePhp::log($cnn);
ChromePhp::log($frnd_det);

echo json_encode($frnd_det);



?>