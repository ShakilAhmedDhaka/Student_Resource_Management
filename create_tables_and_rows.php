<?php 
include_once "connection.php";

mkdir("upload/1");
mkdir("upload/2");
mkdir("upload/3");

//creating table: user_core//

$sql_create_tables = 
"create table user_core
(
user_id int NOT NULL auto_increment,
name varchar(50) not null,
student_id varchar(10) not null,
email varchar(50) not null,
pass varchar(30) not null,
file_url varchar(50) not null,
is_present tinyint null,
primary key(user_id)
);";

$sql_create_tables .= 
"create table user_basic_info
(
phone varchar(20),
address varchar(50),
facebook varchar(50),
twiter varchar(50),
website varchar(50),
user_id int not null,
propic varchar(50),
primary key(user_id),
foreign key (user_id) references user_core(user_id)
);";



$sql_create_tables .= 
"create table file_info
(
file_id int not null auto_increment,
file_name varchar(50),
modif_date varchar(30),
owner int not null,
shared_friends varchar(50),
shared_courses varchar(50),
location varchar(50),
primary key(file_id),
foreign key (owner) references user_core(user_id)
);";

$sql_create_tables .= 
"create table notif_info
(
notif_id int not null auto_increment,
notif_message varchar(100),
notif_type varchar(50),
from_id int not null,
to_id int not null,
primary key(notif_id),
foreign key (from_id) references user_core(user_id),
foreign key (to_id) references user_core(user_id)
);";

$sql_create_tables .= 
"create table friends_info
(
friendship_id int not null auto_increment,
friends_list varchar(1000),
user_id int not null,
primary key(friendship_id),
foreign key (user_id) references user_core(user_id)
);";




#creating the rows for user core
$sql_user_core_rows =
'insert into user_core (name,student_id,email,pass,file_url,is_present)
values("Shakil Ahmed","1210499042","shakilahmed@northsouth.edu","shakil123","upload/1/",1);';

$sql_user_core_rows .=
'insert into user_core (name,student_id,email,pass,file_url,is_present)
values("Rifat Monzur","1210913042","rifatmunzur@northsouth.edu","rifat1234","upload/2/",1);';

$sql_user_core_rows .=
'insert into user_core (name,student_id,email,pass,file_url,is_present)
values("Adnan Shahriar","1210500042","adnanshahriar@northsouth.edu","adnan1234","upload/3/",1);';
#ends the rows for user core

#creating the rows for user basic info
$sql_user_core_rows .=
'insert into user_basic_info (phone,address,facebook,twiter,website,user_id,propic)
values("01678xxxxxxxx","wari,dhaka","www.gk.shakil@facebook.com","www.twiter.com","www.shakil.com",1,"upload/1/shakil_propic.jpg");';

$sql_user_core_rows .=
'insert into user_basic_info (phone,address,facebook,twiter,website,user_id,propic)
values("0178xxxxxxxx","mirpur,dhaka","www.rifat@facebook.com","www.twiter.com","www.rifat.com",2,"upload/2/Koala.jpg");';

$sql_user_core_rows .=
'insert into user_basic_info (phone,address,facebook,twiter,website,user_id,propic)
values("01828xxxxxxxx","bashundhara,dhaka","www.adnan@facebook.com","www.twiter.com","www.adnan.com",3,"upload/3/Penguins.jpg");';


$today = getdate();
$date = $today["mday"] ." " .$today["month"] ." " . $today["year"]; 
$url = "upload/1/shakil_propic.jpg";
$name = "shakil_propic.jpg";

$sql_user_core_rows .=
'insert into file_info (file_name,modif_date,owner,location)
values("'.$name.'","'.$date.'",1,"'.$url.'");';

$url = "upload/2/koala.jpg";
$name = "koala.jpg";
$sql_user_core_rows .=
'insert into file_info (file_name,modif_date,owner,location)
values("'.$name.'","'.$date.'",2,"'.$url.'");';

$url = "upload/3/Penguins.jpg";
$name = "Penguins.jpg";
$sql_user_core_rows .=
'insert into file_info (file_name,modif_date,owner,location)
values("'.$name.'","'.$date.'",3,"'.$url.'");';


$sql_user_core_rows .=
'insert into notif_info (notif_message,notif_type,from_id,to_id)
values("Rifat shared a file with you!","share",2,1);';

$sql_user_core_rows .=
'insert into notif_info (notif_message,notif_type,from_id,to_id)
values("Adnan shared a file with you!","share",3,1);';

$sql_user_core_rows .=
'insert into friends_info (friends_list,user_id)
values("",1);';

$sql_user_core_rows .=
'insert into friends_info (friends_list,user_id)
values("",2);';

$sql_user_core_rows .=
'insert into friends_info (friends_list,user_id)
values("",3);';


//if (mysqli_multi_query($con, $sql_user_core)) {
    //echo "New records created successfully";
//} else {
//    echo "Error: " . $sql_user_core . "<br>" . mysqli_error($con);
//}


if (mysqli_multi_query($con, $sql_create_tables)) 
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

    echo nl2br("New tables created successfully\n");
}
else 
{
    echo "Error: " . $sql_create_tables . "<br>" . mysqli_error($con);
}


if (mysqli_multi_query($con, $sql_user_core_rows)) {
    echo "New rows created successfully";
} else {
    echo "Error: " . $sql_user_core_rows . "<br>" . mysqli_error($con);
}



mysqli_close($con);

 ?>