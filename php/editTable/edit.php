<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
session_start();
$username = $_SESSION['username'];
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  

// $date2 = $_POST['calories'];
$idNum2 = $_POST['idNum1'];
$date2 = $_POST['date1'];
$calories2 = $_POST['calories1'];
$weight2 = $_POST['weight1'];
$editItem2 = $_POST['editItem1'];
if($editItem2 == 'date'){
    $query = mysqli_query($connection, "UPDATE FitnessData SET Dates = '$date2' WHERE id = $idNum2") or die("Unable to connect to MySQL");
    echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";

}
if($editItem2 == 'calories'){
    $query = mysqli_query($connection, "UPDATE FitnessData SET Calories = '$calories2' WHERE id = $idNum2") or die("Unable to connect to MySQL");
}
if($editItem2 == 'weight'){
    echo "UPDATE FitnessData SET Weight = '$weight2' WHERE id = $idNum2";
    $query = mysqli_query($connection, "UPDATE FitnessData SET Weight = '$weight2' WHERE id = $idNum2") or die("Unable to connect to MySQL");
}

echo "Form Submitted succesfully";
mysqli_close($connection);
?>