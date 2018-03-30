function addData(){
    var date = new Date(document.getElementById("datepicker").value).toISOString();
    var calories = document.getElementById("calories").value;
    var weight = document.getElementById("weight").value;
    var dataString = 'date1=' + date.slice(0,10) + '&calories1=' + calories + '&weight1=' + weight + '&action1=' + 'add';
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

function login(){
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var dataString = 'username1=' + username + '&password1=' + password;
    if (username == '' || login == ''){
        window.alert("Please fill in username or password.");
    }
    else{
        $.ajax({
            type: "POST",
            url: "login.php",
            data: dataString,
            cache: false,
            crossDomain : true,
            success: function(response) {
                if (response.status == 403) {
                    window.alert("The password or username you have entered is not valid");
                }
                else {
                    window.location = 'http://localhost/fitness_tracker/site.html';
                }
            }
        });
    }
    
    return false;
}

function registration(){
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;
    var email = document.getElementById("email").value;
    var dataString = 'username1=' + username + '&password1=' + password + '&email1=' + email;

    if (username == '' || password == '' || email == ''){
        window.alert("Please fill in username or password.");
    }
    else{
        $.ajax({
            type: "POST",
            url: 'registration.php',
            data: dataString,
            cache: false,
            crossDomain : true,
            success: function(response) {
                window.alert("New account created");
                if (response.status == 403) {
                    window.alert("The password or username you have entered is not valid");
                }
                else {
                    window.location = 'http://localhost/fitness_tracker/site.html';
                }
            }
        });    }
    return false;
}

function ajaxConnect(dataString, url){
    $.ajax({
        type: "POST",
        url: url,
        data: dataString,
        cache: false,
        crossDomain : true,
        success: function() {
        }
    });
}
