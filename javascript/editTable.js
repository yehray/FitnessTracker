function fetch_data(){
     $.ajax({  
          url:"php/editTable/select.php",  
          method:"POST",  
          success:function(data){  
               $('#live_data').html(data);  
          }  
     });  
}

function edit_data(id, text, column_name){ 
     $.ajax({  
          url:"php/editTable/edit.php",  
          method:"POST",  
          data:{id:id, text:text, column_name:column_name},  
          dataType:"text",  
          success:function(data){  
          }  
     });  
}


function delete_data(id, text, column_name){
    $.ajax({  
        url:"php/editTable/delete.php",  
        method:"POST",  
        data:{id:id},  
        dataType:"text",  
        success:function(data){  
             fetch_data();  
        }  
   });
}