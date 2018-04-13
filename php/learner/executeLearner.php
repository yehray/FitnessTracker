<?php
session_start();
$username = $_SESSION['username']; 
$output = shell_exec("python /Users/yehray/Sites/fitness_tracker/python/test.py $username");
echo $output;

?>