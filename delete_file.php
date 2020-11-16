<?php
    session_start();
    include_once "connection.php";

    header('Content-Type: application/json');

    $uploaded = "not succesfull";

    if( isset($_POST['fn']) ){
        $sql = "SELECT location from file_info where file_name = '$_POST[fn]'";
        if($get_query = mysqli_query($con,$sql))
        {
            $row = mysqli_fetch_array($get_query);
            $url = $row[0];
            //echo json_encode($url);
        }
        else
        {
            echo "Error: ".$url_query."<br>".mysqli_error($con);
        }

        unlink($url);
        $sql = "DELETE from file_info where file_name = '$_POST[fn]'";
        if($get_query = mysqli_query($con,$sql))
        {
            //echo json_encode($url);
        }
        else
        {
            echo "Error: ".$url_query."<br>".mysqli_error($con);
        }

        echo json_encode($url);

    }
    else{
        echo "didnt work :(";
    }

?>