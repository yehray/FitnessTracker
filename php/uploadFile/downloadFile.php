<?php  
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
$output = '';
session_start();
$username = $_SESSION['username']; 
$result = mysqli_query($connection, "SELECT Food, Calories, Weight, Protein, Carbohydrates, Sugars, Dates
FROM DailyFoodData WHERE username = '$username'")or die("Unable to connect to MySQL");

$numFields = mysqli_num_fields ($result);

$fieldCount = 0;
for ($i = 0; $i < $numFields; $i++){
    $fieldCount++;
    if($fieldCount  == $numFields){
        $header .= mysqli_fetch_field_direct($result,$i)->name . "\t";
    }
    else{
    $header .= mysqli_fetch_field_direct($result,$i)->name . "," . "\t";
    }
}

while($row = mysqli_fetch_row($result)){
    $line = '';
    $fieldCount = 0;
    foreach($row as $value){   
        $fieldCount++;
        if($fieldCount  == $numFields){
            $value = $value . "\t";
            $line .= $value;
        }
        else{
            $value = $value . "," ."\t";
            $line .= $value;
        }

    }
    $data .= trim($line) . "\n";
}
$data = str_replace("\r", "", $data);

if ($data == ""){
    $data = "\n(0) Records Found!\n";                        
}

// Save data from MySQL query into a file
$target_dir = "/Users/yehray/Sites/fitness_tracker/downloads/";
$final_dir = $target_dir . $username . date("Y-m-d H:i:s") . '.csv';
$fileName = $username . date("Y-m-d H:i:s") . '.csv';
$file = fopen($final_dir, 'w');
$txt = "$header\n$data";
fwrite($file, $txt);

// Allow user to download the saved file
header('Content-Transfer-Encoding: binary');  // For Gecko browsers mainly
header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($final_dir)) . ' GMT');
header('Accept-Ranges: bytes');  // Allow support for download resume
header('Content-Length: ' . filesize($final_dir));  // File size
header('Content-Encoding: none');
header('Content-Type: application/csv');  // Use csv file
header('Content-Disposition: attachment; filename= "'.$fileName.'"');  // Make the browser display the Save As dialog
readfile($final_dir);  

fclose($file);
?>