<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
session_start();
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  

$username = $_SESSION['username']; 
$date2 = $_POST['getDate'];

$result = mysqli_query($connection, "SELECT  WEIGHT FROM DailyFoodData WHERE username = '$username' AND Dates = '$date2'") or die("Unable to connect to MySQL");
// echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";
$count = 0;
$sum = 0;
if(mysqli_num_rows($result) > 0){  
    while($row = mysqli_fetch_array($result)){ 
        $sum += $row[0];
        $count++;
    }
    echo $sum/$count;
}
else{
    echo 0;
}
?>