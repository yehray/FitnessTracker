<?php
session_start();
$username = $_SESSION['username']; 
$fileName2 = $_POST['fileName1'];
$directory = '/Users/yehray/Sites/fitness_tracker/python/plots/';
$fileName2= basename($fileName2); 
unlink($directory . $fileName2);
?>


