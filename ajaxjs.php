<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
$calories2 = $_POST['calories1'];
$weight2 = $_POST['weight1'];
$connection = mysqli_connect("localhost", "root", "7UPdrinker", "fitness_database") or die("Unable to connect to MySQL");  
$query = mysqli_query($connection, "insert into FitnessData(calories, weight) values ('$calories2', '$weight2')");
echo "Form Submitted succesfully";
mysqli_close($connection);
?>