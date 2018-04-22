<?php
session_start();
$username = $_SESSION['username']; 
$output = shell_exec("/anaconda3/bin/python3.6 /Users/yehray/Sites/fitness_tracker/python/graphs.py yehray");
echo $output;
?>