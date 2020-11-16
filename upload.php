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

$file_query = "";
$today = getdate();
$date = $today["mday"] ." " .$today["month"] ." " . $today["year"]; 

$uploaded = array();

if(!empty($_FILES['file']['name'][0])){
    //echo 'ok';

  foreach ($_FILES['file']['name'] as $position => $name) {
    //echo $name , '<br>';
    if(move_uploaded_file($_FILES['file']['tmp_name'][$position], $url . $name)){
        $uploaded[] = array(
            'name' => $name,
            'file' => $url . $name
        );
    }

    $file_loc = $url . $name;
    $file_query .= 
    'insert into file_info (file_name,modif_date,owner,location)
    values("'.$name.'","'.$date.'", "'.$_SESSION['user_id'].'"  ,"'.$file_loc.'");';

  }
}


if (mysqli_multi_query($con, $file_query)) 
{
    do 
    {
        /* store first result set */
        if ($result = mysqli_store_result($con)) 
        {
            while ($row = mysqli_fetch_row($result)) 
            {
                //printf("%s\n", $row[0]);
            }
            mysqli_free_result($result);
        }
        /* print divider */
        if (mysqli_more_results($con)) 
        {
            //printf("-----------------\n");
        }
    } while (mysqli_next_result($con));

    //echo nl2br("file rows created successfully\n");
}
else 
{
    echo "Error: " . $file_query . "<br>" . mysqli_error($con);
}


mysqli_close($con);


//$uploaded = array("Dog","Cat","Horse","Bee","Fly","Pig","Monkey","Worm","Slug");
echo json_encode($uploaded);

?>