<?php
$password2 = $_POST['password1'];
$username2 = $_POST['username1'];
$connection = mysqli_connect("localhost", "root", "7UPdrinker", "fitness_database") or die("Unable to connect to MySQL");  
$query = mysqli_query($connection, "SELECT * FROM users where username = '$username2' AND password = '$password2'") or die(mysqli_error($connection));
$row = mysqli_fetch_array($query, MYSQLI_BOTH) or die(mysqli_error($connection));
if(!empty($row['username']) AND !empty($row['password'])) {
    // session_start();
    // $_SESSION['username'] = $username2;
    header('Location: http://localhost/fitness_tracker/site.html');
    echo "Successful Login"; 
    exit;
}
// else{
//     echo "The password or username you have entered is not valid";
// }
// mysqli_close($connection);

?>