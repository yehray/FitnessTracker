<?php  
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
$output = '';
session_start();
$username = $_SESSION['username']; 
// $result = mysqli_query($connection, "SELECT * FROM FitnessData WHERE username = '$username'");
$result = mysqli_query($connection, "SELECT * FROM FitnessData");

$output .= 
        '<script>
        $(function() {
            $("#datepicker").datepicker();
        });
        </script>
         <div class="table-responsive">  
        <table class="table table-bordered">  
            <tr> 
                <th width="40%">Date</th>  
                <th width="40%">Calories</th>  
                <th width="40%">Weight</th>  
                <th width="10%">Delete</th>  
            </tr>';  
 if(mysqli_num_rows($result) > 0){  
      while($row = mysqli_fetch_array($result)){  
           $output .=  
                '<tr>  
                    <td class="dateClass" contenteditable>'.$row[0].'</td>  
                    <td class="caloriesClass" contenteditable>'.$row[1].'</td>  
                    <td class="weightClass" contenteditable>'.$row[2].'</td>  
                    <td><button type="button" name="delete_btn" class="btn btn-xs btn-danger btn_delete">x</button></td>  
                </tr>';  
      }  
      $output .=   
           '<tr>  
                <td id="Date" contenteditable><input id="datepicker" type="text" name="pick date"><br>
                </td>  
                <td id="Calories" contenteditable></td>  
                <td id="Weight" contenteditable></td>  
                <td><button type="button" name="btn_add" id="addButton" class="btn btn-xs btn-success">+</button></td>  
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