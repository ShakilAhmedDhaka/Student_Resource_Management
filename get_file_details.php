<?php
session_start();
include_once "connection.php";

#$dir =  'upload/';
	#$files = array_diff(scandir($dir), array('..', '.'));
	#print_r($files);
	#print_r(filesize($files[2]));



$url_query = "SELECT file_url from user_core where user_id = '$_SESSION[user_id]'";
if($get_query = mysqli_query($con,$url_query))
{
    $row = mysqli_fetch_array($get_query);
    $url = $row[0];
}
else
{
    echo "Error: ".$url_query."<br>".mysqli_error($con);
}


$dir = $url;
$fd_arary = array();

if (is_dir($dir)) {
    if ($dh = opendir($dir)) {
        while (($file = readdir($dh)) !== false) {
             if ($file == '.' || $file == '..') { 
                continue; 
            } 
        	$mod_date=date("F d Y", filemtime($dir . $file));
            #echo "filename: $file : filetype: " . filetype($dir . $file) . $mod_date .  "<br>" ;;
            #filetype($dir . $file) ." " .
            $file_info = "$file" . "#". $mod_date . "#" ."YOU";
            array_push($fd_arary, $file_info);
        }
        closedir($dh);
    }
}

#print_r($fd_arary);

echo json_encode($fd_arary);

?>