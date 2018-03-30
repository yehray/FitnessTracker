<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
$date2 = $_POST['date1'];
$calories2 = $_POST['calories1'];
$weight2 = $_POST['weight1'];
$action = $_POST['action1'];
$connection = mysqli_connect("localhost", "root", "7UPdrinker", "fitness_database") or die("Unable to connect to MySQL");  
if ($action ==  "add") {
    $query = mysqli_query($connection, "INSERT INTO FitnessData(Dates, Calories, Weight) VALUES ('$date2', '$calories2', '$weight2')");
}
if ($action ==  "delete") {
    $query = mysqli_query($connection, "DELETE FROM FitnessData WHERE Dates = '$date2'");
}

echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";
echo "Form Submitted succesfully";
mysqli_close($connection);
?>

