<?php
session_start();
$username = $_SESSION['username']; 
$directory = '/Users/yehray/Sites/fitness_tracker/uploads/';
$files = glob($directory . $username. '*.xlsx');

$output .= 
        '<div class="table-responsive">  
        <table class="table table-bordered">  
            <tr> 
                <th width="80%">File Name</th>  
                <th width="20%">Delete</th>  
            </tr>'; 
 if(count($files) > 0){  
    foreach($files as $file)
           $output .=  
                '<tr>  
                    <td class="fileClass" id="files">'.basename($file).'</td>    
                    <td style="text-align:center"><button type="button" class="deleteButton" id="'.basename($file).'">x</button></td>  
                </tr>';    
 }  
 else  
 {  
      $output .='<tr>  
                    <td colspan="2">No files uploaded</td>
                </tr>';  
 }  
 $output .= '</table>  
             </div>';  
 echo $output;  

?>


