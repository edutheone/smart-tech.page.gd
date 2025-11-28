<?php 
$db_server="localhost";
$db_user = "root";
$db_pass = "";
$db_name = "smart technology";
$conn = "";


    $conn = mysqli_connect($db_server, 
$db_user,
$db_pass,
$db_name );

if($conn) {
    echo"";
}
else{
   echo"error occured somewhere please try later";
}


?>