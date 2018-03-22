function myFunction(){
    var calories = document.getElementById("calories").value;
    var weight = document.getElementById("weight").value;
    var dataString = 'calories1=' + calories + '&weight1=' + weight;
    if (calories == '' || weight == ''){
        window.alert("Please Fill All Fields");
    }
    else{
        $.ajax({
            type: "POST",
            url: "ajaxjs.php",
            data: dataString,
            cache: false,
            crossDomain : true,
            success: function() {
            }
        });
    }
    return false;
}