<?php 
$directory = '/Users/yehray/Sites/fitness_tracker/uploads/';
$fileName2 = $_POST['fileName1'];
unlink($directory . $fileName2);
?>