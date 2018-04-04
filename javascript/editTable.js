function fetch_data(){
     $.ajax({  
          url:"php/editTable/select.php",  
          method:"POST",  
          success:function(data){  
               $('#live_data').html(data);  
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

function insert_data(){ 
    var date = new Date(document.getElementById("datepicker").value).toISOString();  
    var calories = $('#Calories').text();  
    var weight = $('#Weight').text(); 
    console.log(date.slice(0,10) );
    var dataString = 'date1=' + date.slice(0,10) + '&calories1=' + calories + '&weight1=' + weight;
    $.ajax({
        type: "POST",
        url: "php/editTable/insert.php",
        data: dataString,
        cache: false,
        crossDomain : true,
        success: function() {
            console.log("SUCCESS");
            fetch_data();  
        }
    });
    return false;

}