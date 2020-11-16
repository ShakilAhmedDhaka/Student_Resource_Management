<?php
session_start();
include_once "connection.php";
include "ChromePhp.php";


$mode = $_POST['mode'];
$not_idd =  $_POST['notif_idd'];

ChromePhp::log($mode . $not_idd);
$url_query = "SELECT * from notif_info where notif_id = '$not_idd'";
if($get_query = mysqli_query($con,$url_query))
{
    while($row = mysqli_fetch_array($get_query)){
    	$from_id = $row[3];
    	$to_id = $row[4];
    }
}
else
{
    echo "Error: ".$notif_query."<br>".mysqli_error($con);
}

ChromePhp::log($from_id . $to_id);


$q_from = "SELECT name from user_core where user_id = '$from_id' ;";
$q_from .= "SELECT name from user_core where user_id = '$to_id' ;";
$names = array();
if (mysqli_multi_query($con, $q_from)){
    do{
       
        if ($result = mysqli_store_result($con)){
            while ($row = mysqli_fetch_row($result)){
                array_push($names, $row[0]);
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


ChromePhp::log($names);




$fd_arary = array();

if($mode == "accept"){

	$msg1 = "You and " . $names[0] . " are now friends!";
	$msg2 = "You and " . $names[1] . " are now friends!";


	$notif_enter = 	'insert into notif_info (notif_message,notif_type,from_id,to_id)
					values("'.$msg1.'","frnd_req_res","'.$from_id.'","'.$to_id.'");';
	$notif_enter .= 	'insert into notif_info (notif_message,notif_type,from_id,to_id)
						values("'.$msg2.'","frnd_req_res","'.$to_id.'","'.$from_id.'");';

	if (mysqli_multi_query($con, $notif_enter)){
    do{
       
        if ($result = mysqli_store_result($con)){
            while ($row = mysqli_fetch_row($result)){
            }
            mysqli_free_result($result);
        }
       
        if (mysqli_more_results($con)){
        }
    } while (mysqli_next_result($con));
	}
	else{
	    echo "Error: " . $notif_enter . "<br>" . mysqli_error($con);
	}



    /* Getting both of their friends_list*/

    $msg = array();

    $q_from = "SELECT friends_list from friends_info where user_id = '$from_id' ;";
    $q_from .= "SELECT friends_list from friends_info where user_id = '$to_id' ;";

    if (mysqli_multi_query($con, $q_from)){
        do{
           
            if ($result = mysqli_store_result($con)){
                while ($row = mysqli_fetch_row($result)){
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




    /* Entry Friends */

    $msg1 = $msg[0] . "#" . $to_id;
    $msg2 = $msg[1] . "#" . $from_id;


    $url_query =  "UPDATE friends_info SET friends_list = '$msg1'
                   WHERE user_id = '$from_id';";

    $url_query .=  "UPDATE friends_info SET friends_list = '$msg2'
                   WHERE user_id = '$to_id';";



    if (mysqli_multi_query($con, $url_query)){
    do{
       
        if ($result = mysqli_store_result($con)){
            while ($row = mysqli_fetch_row($result)){
            }
            mysqli_free_result($result);
        }
       
        if (mysqli_more_results($con)){
        }
    } while (mysqli_next_result($con));
    }
    else{
        echo "Error: " . $url_query . "<br>" . mysqli_error($con);
    }
		
}


ChromePhp::log($names);

/*Delete part*/
$url_query = "DELETE from notif_info where notif_id = '$not_idd'";
if($get_query = mysqli_query($con,$url_query))
{
    
}
else
{
    echo "Error: ".$url_query."<br>".mysqli_error($con);
}


ChromePhp::log($names);



echo json_encode("heloo#hello");

?>