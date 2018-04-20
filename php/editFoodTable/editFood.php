<?php  
$connection = mysqli_connect("localhost", "root", "password", "fitness_database") or die("Unable to connect to MySQL");  
$output = '';
session_start();
$username = $_SESSION['username']; 
$date2 = $_POST['date1'];
$result = mysqli_query($connection, "SELECT * FROM DailyFoodData WHERE username = '$username' AND Dates = '$date2'")or die("Unable to connect to MySQL");
// $result = mysqli_query($connection, "SELECT * FROM FitnessData");

$totalCalories = 0;
$totalProtein = 0;
$totalcCarbohydrates = 0;
$totalSugars = 0;

$output .= 
        '
        <h3 align="center" id="tableTitle">FITNESS DATA FOR:   '.date("m-d-Y", strtotime($date2)).'</h3><br />  
        <div class="table-responsive">  
        <table class="table table-bordered">  
            <tr> 
                <th width="25%">Food</th>  
                <th width="20%">Calories</th>  
                <th width="15%">Protein</th>  
                <th width="15%">Carbohydrates</th>  
                <th width="15%">Sugars</th>  
                <th width="10%">Add/Delete</th>  
            </tr>';  

if(mysqli_num_rows($result) >= 0){  
    while($row = mysqli_fetch_array($result)){ 
        $totalCalories += $row['Calories'];
        $totalProtein += $row['Protein'];
        $totalcCarbohydrates += $row['Carbohydrates'];
        $totalSugars += $row['Sugars'];
        $output .=  
            '<tr class = dataRows>  
                <td class="foodClass" contenteditable id="'.$row['Food'].'" data-id="'.$row['id'].'">'.$row['Food'].'</td>  
                <td class="caloriesClass" contenteditable id="'.$row['Calories'].'" data-id="'.$row['id'].'">'.$row['Calories'].'</td>  
                <td class="proteinClass" contenteditable id="'.$row['Protein'].'" data-id="'.$row['id'].'"> '.$row['Protein'].'</td>
                <td class="carbohydratesClass" contenteditable id="'.$row['Carbohydrates'].'" data-id="'.$row['id'].'"> '.$row['Carbohydrates'].'</td>
                <td class="sugarClass" contenteditable id="'.$row['Sugars'].'" data-id="'.$row['id'].'"> '.$row['Sugars'].'</td>
                <td><button type="button" class="deleteButton" id ='.$row['id'].'>x</button></td>  
            </tr>';   
      }  
      $output .=   
                '<tr class = dataRows>
                <th width="10%">
                <div class="ui-widget" id="addFood">
                <input id="tags" class="searchBar">
                </div> </th> 
                    <td id="editCalories" contenteditable></td>  
                    <td id="editProtein" contenteditable></td>
                    <td id="editCarbohydrates" contenteditable></td>  
                    <td id="editSugars" contenteditable></td>    
                    <td><button type="button" name="addButton" id="addButton">+</button></td>  
                </tr> 
                <tr class = dataRows>
                <th></th> 
                <th>TOTAL:</th> 
                <th>'.$totalCalories.'</th> 
                <th>'.$totalProtein.'</th> 
                <th>'.$totalcCarbohydrates.'</th> 
                <th>'.$totalSugars.'</th> 
                </tr>      
                '
                ;  
 }  
 else  
 {  
      $output .='<tr>  
                    <td colspan="7">Data not Found</td>
                </tr>';  
 }  
 $output .= '</table>  
             </div>';  
 echo $output;  
 ?>