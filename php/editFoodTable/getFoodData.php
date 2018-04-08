<?php  
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
$output = '';
session_start();
$username = $_SESSION['username']; 
$result = mysqli_query($connection, "SELECT * FROM FoodData");
$foodArray =  array();
 
if(mysqli_num_rows($result) > 0){  
    while($row = mysqli_fetch_array($result)){ 
        array_push($foodArray, $row[1]);
    }
} 

echo json_encode($foodArray);
?>