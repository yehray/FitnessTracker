<?php
session_start();
$username = $_SESSION['username']; 
$directory = '/Users/yehray/Sites/fitness_tracker/uploads/';
$files = glob($directory . $username. '*.csv');

$output .= 
        '<h3 align="center" id="tableTitle">List of Files Uploaded</h3>
        <div class="table-responsive">  
        <table class="table table-bordered">  
            <tr> 
                <th width="60%">File Name</th>  
                <th width="20%" style="text-align:center">Delete</th> 
                <th width="20%" style="text-align:center">Use this File</th>   
            </tr>'; 
 if(count($files) > 0){  
    foreach($files as $file)
           $output .=  
                '<tr class = dataRows>  
                    <td class="fileClass" id="files">'.basename($file).'</td>    
                    <td style="text-align:center"><button type="button" class="deleteButton" id="'.basename($file).'">x</button></td>  
                    <td style="text-align:center"><button type="button" class="useFileButton" id="'.basename($file).'">Use this file</button></td>  
                </tr>';    
 }  
 else  
 {  
      $output .='<tr class = dataRows>  
                    <td colspan="3">No files uploaded</td>
                </tr>';  
 }  
 $output .= '</table>  
             </div>';  
 echo $output;  

?>


