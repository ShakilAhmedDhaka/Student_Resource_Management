<?php
    session_start();
    include_once "connection.php";

    header('Content-Type: application/json');

    $uploaded = "not succesfull";

    if( isset($_POST['fn']) && isset($_POST['newName']) ){
        $newName = $_POST['newName'];
        if($_POST['fn'] != $_POST['newName']){
            $ar = explode(".", $_POST['fn']);
            $newName = $newName . "." . $ar[1];
        }
        $sql = "UPDATE file_info set file_name = '$newName' where file_name = '$_POST[fn]'";
        if($get_query = mysqli_query($con,$sql))
        {
            echo json_encode("Rename Done");
        }
        else
        {
            echo "Error: ".$sql."<br>".mysqli_error($con);
        }


    }
    else{
        echo "didnt work :(";
    }

?>