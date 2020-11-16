<?php
session_start();
include_once "connection.php";
include "ChromePhp.php";

if( !isset($_SESSION['user_core_info_frnd'][0] )){
    ChromePhp::log("Something is wrong");
}
else{
    ChromePhp::log($_SESSION['user_core_info_frnd'][0]);
}


$visiting_person_id = $_SESSION['user_core_info_frnd'][0];
//ChromePhp::log($visiting_person_id);
$status = "False";
/*if( !isset($_SESSION['friends_list'] )){
    ChromePhp::log("This guy is forever alone :(");
}*/


/* Getting both of their friends_list*/

$msg = array();

$q_from = "SELECT friends_list from friends_info where user_id = '$visiting_person_id' ;";
$q_from .= "SELECT friends_list from friends_info where user_id = '$_SESSION[user_id]' ;";

if (mysqli_multi_query($con, $q_from)){
    do{
        if ($result = mysqli_store_result($con)){
            while ($row = mysqli_fetch_row($result)){
                ChromePhp::log($row);
                array_push($msg, $row[0]);
            }
            mysqli_free_result($result);
        }
        if (mysqli_more_results($con)){
        }
    } while (mysqli_next_result($con));
}
else{
    echo "Error: " . $q_from . "<br>" . mysqli_error($con);
}


ChromePhp::log($msg);






if($status == "False" && count($msg) > 0){

    $friends_list = split("#", $msg[0] );
    ChromePhp::log($friends_list);
    $size = count($friends_list);
    for($i=0;$i<$size;$i++){
        if( $friends_list[$i] ==  $_SESSION['user_id']){
            $status = "2";
            ChromePhp::log("These guys are buddies");
        }
    }
}


ChromePhp::log($_SESSION['user_id']);
ChromePhp::log($visiting_person_id);


if($status == "False"){
    $query1 = "SELECT notif_id FROM notif_info WHERE from_id = '$_SESSION[user_id]' AND to_id = '$visiting_person_id' AND notif_type = 'friend_request'";
    if($get_query = mysqli_query($con,$query1))
    {
        while($row = mysqli_fetch_array($get_query)){
            $checked = $row[0];
        }
        if(isset($checked)){
            $status = "3"; 
        }
        else{
            ChromePhp::log("you did not send any request");
        }
    }
    else
    {
        echo "Error: ".$query1."<br>".mysqli_error($con);
        ChromePhp::log("Error in query1");
    }
}

if($status == "False"){
    $query2 = "SELECT notif_id FROM notif_info WHERE to_id = '$_SESSION[user_id]' AND from_id = '$visiting_person_id' AND notif_type = 'friend_request'";
    if($get_query = mysqli_query($con,$query2))
    {
        while($row = mysqli_fetch_array($get_query)){
            $checked = $row[0];
        }
        if(isset($checked)){
            $status = "4"; 
        }
        else{
            ChromePhp::log("He also did not send any request");
        }
    }
    else
    {
        echo "Error: ".$query2."<br>".mysqli_error($con);
        ChromePhp::log("Error in query2");
    }
}



if($status == "False"){
    $status = "1";
}




ChromePhp::log($status);

echo json_encode($status);

?>