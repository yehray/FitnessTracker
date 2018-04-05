<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
session_start();
$id2 = $_POST['id1'];
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
echo $id2;
$query = mysqli_query($connection, "DELETE FROM FitnessData WHERE id = '$id2'");
echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";
echo "Form Submitted succesfully";
mysqli_close($connection);
?>

