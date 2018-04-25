<?php
session_start();
$username = $_SESSION['username']; 
$imgName = shell_exec("/anaconda3/bin/python3.6 /Users/yehray/Sites/fitness_tracker/python/graphs.py yehray");
$output = '';
$output .= '<img src="'.$imgName.'" id="plottedData" style="margin-left: 12%">'; 
echo $output;
?>


