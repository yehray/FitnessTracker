<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
$password2 = $_POST['password1'];
$username2 = $_POST['username1'];
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
$query = mysqli_query($connection, "SELECT * FROM users where username = '$username2' AND password = '$password2'") or die(mysqli_error($connection));
$row = mysqli_fetch_array($query, MYSQLI_BOTH) or die(mysqli_error($connection));
if(!empty($row['username']) AND !empty($row['password'])) {
    session_start();
    $_SESSION['username'] = $username2;
    http_response_code(200);
    echo $_SESSION['username'];
    exit;
}
else{
    http_response_code(403);
    echo "The password or username you have entered is not valid";
}
mysqli_close($connection);
?>