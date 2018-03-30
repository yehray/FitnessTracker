<?php
$password2 = $_POST['password1'];
$username2 = $_POST['username1'];
$email2 = $_POST['email1'];
$connection = mysqli_connect("localhost", "root", "7UPdrinker", "fitness_database") or die("Unable to connect to MySQL");  
$query = mysqli_query($connection, "INSERT INTO USERS (username, password, email) VALUES ('$users2', '$password2' , '$email2')");
echo mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n";
echo "Form Submitted succesfully";
mysqli_close($connection);
?>