<?php
session_start();
$username = $_SESSION['username']; 
$target_dir = "/Users/yehray/Sites/fitness_tracker/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$finalFilePath = $target_dir . $username . date("Y-m-d H:i:s") . '.' . $fileType;

// if (file_exists($target_file)) {
//     echo "The file already exists.";
//     $uploadOk = 0;
// }

if(file_exists("$finalFilePath ")) unlink("$finalFilePath");

if($fileType != "xlsx") {
    echo "Only xlsx files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "\nYour file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $finalFilePath)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "\nThere was an error uploading your file.";
    }
}

?>