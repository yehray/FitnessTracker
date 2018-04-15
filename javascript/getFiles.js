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

function uploadFile(){
    var form_data = new FormData($("#fileToUpload")[0]);
    $.ajax({  
        type: "POST",   
        url: "php/uploadFile/upload.php", 
        data: form_data,                         
        dataType: "text",  
        cache: false,
        contentType: false,
        processData: false,
         success:function(result){ 
            get_files();   
            alert(result);
         }  
    }); 
}

function use_file(idCLicked){
    var fileName = idCLicked;
    // var r = confirm("Are you sure you want to use this file?")
    var dataString = "fileName1=" + fileName;
    // if(r == true){
         $.ajax({  
             type: "POST",
             url: "php/uploadFile/loadToSQL.php",
             data: dataString,
             cache: false,
             crossDomain : true, 
             success:function(data){
                 get_files();  
                //  alert("New file added.");
             }  
         });
    //  }
   return false;
 }

 function downloadFile(){
     console.log("sds");
    $.ajax({  
        type: "GET",   
        url: "php/uploadFile/downloadFile.php",  
        cache: false,
        contentType: false,
        processData: false,
         success:function(result){ 
            alert(result);
         }  
    }); 
}
