<?php
$directory = '/Users/yehray/Sites/fitness_tracker/uploads/';
$fileName2 = $_POST['fileName1'];

$fileToOpen = $directory . $fileName2;
$row = 1;
if (($handle = fopen($fileToOpen, "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    for ($c=0; $c < $num; $c++) {
        echo $data[$c] . "<br />\n";
    }
  }
  fclose($handle);
}



// // connecting dB
// $mysqli = new mysqli('localhost','root','','testdB');

// // opening csv
// $fp = fopen('data.csv','r');

// // creating a blank string to store values of fields of first row, to be used in query
// $col_ins = '';

// // creating a blank string to store values of fields after first row, to be used in query
// $data_ins = '';

// // read first line and get the name of fields
// $data = fgetcsv($fp);
// for($field=0;$field< count($data);$field++){
//     $col_ins = "'" . $col[$field] . "' , " . $col_ins;
// }

// // reading next lines and insert into dB
// while($data=fgetcsv($fp)){
//     for($field=0;$field<count($data);$field++){
//         $data_ins = "'" . $data[$field] . "' , " . $data_ins;
//     }
//     $query = "INSERT INTO `table_name` (".$col_ins.") VALUES(".$data_ins.")";
//     $mysqli->query($query);
// }    
// echo 'Imported...';


?>

