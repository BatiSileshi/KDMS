<?php 


$servername = "localhost";
$username = "baty";
$password = "baty0393";
$dbname = "kdms";  

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!$conn){
    echo "Connection error: " . mysqli_connect_error();
}



?>