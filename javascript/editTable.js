function fetch_data(){
     $.ajax({  
          url:"php/editTable/select.php",  
          method:"POST",  
          success:function(data){  
               $('#live_data').html(data);  
          }  
     });  
}

function delete_data(idCLicked){
    var id = idCLicked;
    var dataString = 'id1=' + id;
    console.log(dataString);
    $.ajax({  
        type: "POST",
        url: "php/editTable/delete.php",
        data: dataString,
        cache: false,
        crossDomain : true, 
        success:function(data){  
            fetch_data();  
        }  
   });
}

function insert_data(){ 
    var date = new Date(document.getElementById("addDate").value).toISOString();  
    var calories = $('#Calories').text();  
    var weight = $('#Weight').text(); 
    var dataString = 'date1=' + date.slice(0,10) + '&calories1=' + calories + '&weight1=' + weight;
    $.ajax({
        type: "POST",
        url: "php/editTable/insert.php",
        data: dataString,
        cache: false,
        crossDomain : true,
        success: function() {
            fetch_data();  
        }
    });
    return false;
}

function edit_data(){
    var date = new Date(document.getElementById("datepicker").value).toISOString();  
    var calories = $('#Calories').text();  
    var weight = $('#Weight').text(); 
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

function test(){
    console.log("SUCCESS");
}