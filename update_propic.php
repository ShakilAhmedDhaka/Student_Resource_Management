<?php
session_start();
include_once "connection.php";

header('Content-Type: application/json');


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



$uploaded = array();

if(!empty($_FILES['file']['name'][0])){
    //echo 'ok';

  foreach ($_FILES['file']['name'] as $position => $name) {
    //echo $name , '<br>';
    while(file_exists($url . $name)){
        echo $name . '<br>';
        $ar = explode('.', $name);
        echo $ar[0];
        echo $ar[1];
        //print_r($ar);
        $name = $ar[0] . '1.' . $ar[1];
        echo $name;
        //$name = $name . "1";
    }
    if(move_uploaded_file($_FILES['file']['tmp_name'][$position], $url . $name)){
        $uploaded[] = array(
            'name' => $name,
            'file' => $url . $name
        );

        $filename = $url . $name;
    }
  }
}



//echo json_encode($uploaded);



    
    if( isset( $filename ) ){
        $sql = "UPDATE user_basic_info 
            set propic = '$filename'
            where user_id = '$_SESSION[user_id]';";

        $today = getdate();
        $date = $today["mday"] ." " .$today["month"] ." " . $today["year"]; 
        $sql .= 
        'insert into file_info (file_name,modif_date,owner,location)
        values("'.$_FILES['file']['name'][0].'","'.$date.'","'.$_SESSION['user_id'].'","'.$filename.'");';
    }




    if (mysqli_multi_query($con, $sql)) {
        echo "New rows created successfully";
    } else {
        echo "Error: " . $sql_user_core_rows . "<br>" . mysqli_error($con);
    }



    mysqli_close($con);
    header("location:profile.php");

?>