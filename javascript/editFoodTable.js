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
    var food = document.getElementById("tags").value; 
    var calories = document.getElementById("editCalories").innerHTML; 
    var protein = document.getElementById("editProtein").innerHTML;  
    var carbohydrates = document.getElementById("editCarbohydrates").innerHTML;  
    var sugars = document.getElementById("editSugars").innerHTML;  
 
   var dataString = 'date1=' + date.slice(0,10) + '&food1=' + food + '&calories1=' + calories + '&protein1=' + protein + '&carbohydrates1=' + carbohydrates + '&sugars1=' + sugars;
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
        }
   });
   return false;
}

function test(){
    console.log();
}


