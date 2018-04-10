<?php  
$foodName2 = $_POST['foodName1'];
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
session_start();
$username = $_SESSION['username']; 
$query = mysqli_query($connection, "SELECT * FROM FoodData WHERE FoodName = '$foodName2'") or die("Unable to connect to MySQL");
$row = mysqli_fetch_array($query);
$foodDataArray =  array();
array_push($foodDataArray, $row['Calories']);
array_push($foodDataArray, $row['Protein']);
array_push($foodDataArray, $row['Carbohydrates']);
array_push($foodDataArray, $row['Sugars']);
echo json_encode($foodDataArray);
?>



