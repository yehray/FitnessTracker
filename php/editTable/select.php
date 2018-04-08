<?php  
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
$output = '';
session_start();
$username = $_SESSION['username']; 
$result = mysqli_query($connection, "SELECT * FROM FitnessData WHERE username = '$username'");
// $result = mysqli_query($connection, "SELECT * FROM FitnessData");

$output .= 
        '<div class="table-responsive">  
        <table class="table table-bordered">  
            <tr> 
                <th width="10%">ID</th>  
                <th width="40%">Date</th>  
                <th width="40%">Calories</th>  
                <th width="40%">Weight</th>  
                <th width="10%">Add/Delete</th>  
            </tr>';  
 if(mysqli_num_rows($result) > 0){  
      while($row = mysqli_fetch_array($result)){  
           $output .=  
                '<tr>  
                    <td class="idClass" id="idNum">'.$row[4].'</td>    
                    <td class="dateClass" contenteditable id="'.$row[0].'" data-id="'.$row[4].'">'.$row['Dates'].'</td>  
                    <td class="caloriesClass" contenteditable id="'.$row[1].'" data-id="'.$row[4].'">'.$row['Calories'].'</td>  
                    <td class="weightClass" contenteditable id="'.$row[2].'" data-id="'.$row[4].'"> '.$row['Weight'].'</td>
                    <td><button type="button" class="deleteButton" id ="'.$row[4].'">x</button></td>  
                </tr>';  
      }  
      $output .=   
           '<tr>
                <th width="10%">id</th>  
                <td id="Date" contenteditable><input id=addDate  name = "pick date" type="text"></td>  
                <td id="Calories" contenteditable></td>  
                <td id="Weight" contenteditable></td>  
                <td><button type="button" name="addButton" id="addButton">+</button></td>  
           </tr> ';  
 }  
 else  
 {  
      $output .='<tr>  
                    <td colspan="3">Data not Found</td>
                </tr>';  
 }  
 $output .= '</table>  
             </div>';  
 echo $output;  
 ?>