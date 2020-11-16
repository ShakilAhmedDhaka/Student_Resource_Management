<?php

include 'test2.php';


	$file = 'upload/422305_3449014665268_66924467_n.jpg';


	if(isset($_POST['source1'])  ){
        //echo 'ok';

        //$uploaded = $_POST['dir'] . $_POST['file_name'];
        //$file = $_myKeyVals['url'];

        $file =  $_POST['source1'];
    	//echo $file;
    }
    else
    {
    	//echo "Failed";
    }

 	

 	readF($file);


?>