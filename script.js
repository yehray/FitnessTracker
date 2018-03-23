function addData(){
    var date = new Date(document.getElementById("datepicker").value).toISOString();
    var calories = document.getElementById("calories").value;
    var weight = document.getElementById("weight").value;
    var dataString = 'date1=' + date.slice(0,10) + '&calories1=' + calories + '&weight1=' + weight + '&action1=' + 'add';
    console.log(date);
    console.log(dataString);
    if (date == '' || calories == '' || weight == ''){
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

function deleteData(){
    var date = new Date(document.getElementById("datepicker").value).toISOString();
    var dataString = 'date1=' + date.slice(0,10) + '&action1=' + 'delete';
    if (date == ''){
        window.alert("Please Fill a Date");
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