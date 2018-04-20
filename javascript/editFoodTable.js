inTable =  true;

function fetch_data(){
    var date = new Date(document.getElementById("datepicker").value).toISOString();
    var dataString = 'date1=' + date.slice(0,10);
    $.ajax({  
        type: "POST",
        url: "php/editFoodTable/editFood.php",
        data: dataString,
        cache: false,
        crossDomain : true,   
         success:function(result){  
              $('#live_data').html(result);  
         }  
    });  
}

function delete_data(idCLicked){
   var id = idCLicked;
   var dataString = 'id1=' + id;
   $.ajax({  
       type: "POST",
       url: "php/editFoodTable/delete.php",
       data: dataString,
       cache: false,
       crossDomain : true, 
       success:function(data){  
           fetch_data();  
       }  
  });
  return false;

}

function insert_data(){ 
    var date = new Date(document.getElementById("datepicker").value).toISOString();
    var weight = document.getElementById("weight").value; 
    if(weight == 0){
        alert("Please enter in weight");
        return true;
    }
    var food = document.getElementById("tags").value; 
    var calories = document.getElementById("editCalories").innerHTML; 
    var protein = document.getElementById("editProtein").innerHTML;  
    var carbohydrates = document.getElementById("editCarbohydrates").innerHTML;  
    var sugars = document.getElementById("editSugars").innerHTML;   
    var dataString = 'date1=' + date.slice(0,10) + '&food1=' + food + '&calories1=' + calories + '&weight1=' + weight + '&protein1=' + protein + '&carbohydrates1=' + carbohydrates + '&sugars1=' + sugars + '&inTable1=' + inTable;
    inTable =  true;
    $.ajax({
       type: "POST",
       url: "php/editFoodTable/insert.php",
       data: dataString,
       cache: false,
       crossDomain : true,
       success: function() {
           fetch_data();  
       }
   });
   return false;
}

function findFoodData(){ 
    var foodName = document.getElementById("tags").value;
    var dataString = 'foodName1=' + foodName; 
   $.ajax({
        type: "POST",
        url: "php/editFoodTable/getFoodData.php",
        data: dataString,
        cache: false,
        crossDomain : true,
        success: function(result) {
            foodArray = JSON.parse(result);
            document.getElementById("editCalories").innerHTML = foodArray[0];
            document.getElementById("editProtein").innerHTML = foodArray[1];
            document.getElementById("editCarbohydrates").innerHTML =foodArray[2];
            document.getElementById("editSugars").innerHTML = foodArray[3];
            callBack(foodArray);
        },
   });
   return false;
}

function callBack(foodArray){
    if(foodArray[0] == null){
        inTable = false;
    }
}

function getWeight(){
    var date = new Date(document.getElementById("datepicker").value).toISOString();
    var dataString = 'getDate=' + date.slice(0,10);
    $.ajax({  
        type: "POST",   
        url: "php/editFoodTable/getWeight.php", 
        data: dataString,
        dataType: "text",  
        cache: false,
        crossDomain : true,
        success:function(result){  
            document.getElementById("weight").value = result;
        }  
    }); 
}

function increaseDate(){
    var nextDay = $('#datepicker').datepicker('getDate'); 
    nextDay.setDate(nextDay.getDate()+1); 
    $('#datepicker').datepicker('setDate', nextDay);
    fetch_data();
    getWeight();
}

function decreaseDate(){
    var prevDay = $('#datepicker').datepicker('getDate'); 
    prevDay.setDate(prevDay.getDate()-1); 
    $('#datepicker').datepicker('setDate', prevDay);
    fetch_data();
    getWeight();
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
             alert(result);
         }  
    }); 
}



function test(){
    console.log();
}


