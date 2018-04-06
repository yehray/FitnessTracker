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

function edit_data(idTag, idClicked, editItem){
    var element = document.getElementById(idTag);
    var newVal= document.getElementById(idTag).innerHTML;
    var idNum = element.getAttribute('data-id'); 
    var dataString = 'idNum1=' + idNum;
    if(editItem == 'date'){
        if(isValidDate(newVal)){
            var dataString = dataString + '&date1=' + newVal + '&editItem1=' + editItem;
        }
        else{
            alert("Please enter date as YYYY-MM-DD")
            return false;
        }
    }
    if(editItem == 'calories'){
        var dataString = dataString + '&calories1=' + newVal + '&editItem1=' + editItem;
    }
    if(editItem == 'weight'){
        var dataString = dataString + '&weight1=' + newVal + '&editItem1=' + editItem;
    }
    console.log("Data being submitted: ");
    console.log(dataString);
    $.ajax({
        type: "POST",
        url: "php/editTable/edit.php",
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

function isValidDate(dateString)
{
    // First check for the pattern
    if(!/^(\d{4})-(\d{2})-(\d{2})$/.test(dateString))
        return false;
    
        // Parse the date parts to integers
    var parts   = dateString.split("-");
    var day     = parseInt(parts[2], 10);
    var month   = parseInt(parts[1], 10);
    var year    = parseInt(parts[0], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
    {
        return false;
    }

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
    {
        monthLength[1] = 29;
    }

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];

};