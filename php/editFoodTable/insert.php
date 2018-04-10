<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
session_start();
$username = $_SESSION['username'];
$date2 = $_POST['date1'];
$food2 = $_POST['food1'];
$calories2 = $_POST['calories1'];
$protein2 = $_POST['protein1'];
$carbohydrates2 = $_POST['carbohydrates1'];
$sugars2 = $_POST['sugars1'];
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
$query = mysqli_query($connection, "INSERT INTO DailyFoodData(Food, Calories, Protein, Carbohydrates, Sugars, Username, Dates) VALUES ('$food2', '$calories2', '$protein2', '$carbohydrates2', '$sugars2', '$username', '$date2')");
echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";
echo "Form Submitted succesfully";
mysqli_close($connection);
?>
