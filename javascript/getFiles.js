function get_files(){
    $.ajax({  
        type: "POST",
        url: "php/upLoadFile/displayUploads.php",
        cache: false,
        crossDomain : true,   
         success:function(result){  
              $('#live_data').html(result);  
         }  
    });  
}

function delete_file(idCLicked){
   var fileName = idCLicked;
   var r = confirm("Are you sure you want to delete this file?")
   var dataString = "fileName1=" + fileName;
   if(r == true){
        $.ajax({  
            type: "POST",
            url: "php/uploadFile/deleteFile.php",
            data: dataString,
            cache: false,
            crossDomain : true, 
            success:function(data){
                get_files();  
                alert("File deleted.");
            }  
        });
    }
  return false;

}


