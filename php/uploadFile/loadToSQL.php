<?php
session_start();
$username = $_SESSION['username'];
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
$query = mysqli_query($connection, "DELETE FROM DailyFoodData WHERE Username = '$username'");

// Allow line terminators for Windows and UNIX
ini_set("auto_detect_line_endings", true);
$directory = '/Users/yehray/Sites/fitness_tracker/uploads/';
$fileName2 = $_POST['fileName1'];
$fileToOpen = $directory . $fileName2;
$fileHandle = fopen($fileToOpen, "rb");

fgetcsv($fileHandle);
while(!feof($fileHandle)) {
    $data = fgetcsv($fileHandle);
    $food = $data[0];
    $calories = $data[1];
    $weight = $data[2];
    $protein = $data[3];
    $carbohydrates = $data[4];
    $sugars = $data[5];
    $date = $data[6];
    // Change date format to YYYY-MM-DD;
    $newDate = date('Y-m-d', strtotime($date));
    $query2 = mysqli_query($connection, "INSERT INTO DailyFoodData(Food, Calories, Weight, Protein, Carbohydrates, Sugars, Username, Dates) VALUES ('$food', '$calories', '$weight', '$protein', '$carbohydrates', '$sugars', '$username', '$newDate')")
    or die("Unable to connect to MySQL");
}

echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";
echo "Form Submitted succesfully";
mysqli_close($connection);

?>

