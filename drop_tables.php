<?php 
include_once "connection.php";

$sql_drop_tables = "DROP TABLE friends_info;";
$sql_drop_tables = "DROP TABLE file_info;";
$sql_drop_tables .= "DROP TABLE notif_info;";
$sql_drop_tables .= "DROP TABLE user_basic_info;";
$sql_drop_tables .= "DROP TABLE user_core;";



if (mysqli_multi_query($con, $sql_drop_tables)) 
{
    do 
    {
        /* store first result set */
        if ($result = mysqli_store_result($con)) 
        {
            while ($row = mysqli_fetch_row($result)) 
            {
                printf("%s\n", $row[0]);
            }
            mysqli_free_result($result);
        }
        /* print divider */
        if (mysqli_more_results($con)) 
        {
            printf("-----------------\n");
        }
    } while (mysqli_next_result($con));

    echo nl2br("tables dropped successfully\n");
}
else 
{
    echo "Error: " . $sql_drop_tables . "<br>" . mysqli_error($con);
}


?>