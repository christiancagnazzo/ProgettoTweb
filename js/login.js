$(function(){
    
    // Hide search bar, logout button and watch list button 
    $("#search").hide();
    $("#logout").hide();
    $("#toWatch").hide();

    // Active login button
    $("#loginBtn").click(function(){
        $(".error").text("");

        var _username = $("#username").val();
        var _password = $("#password").val();

        if (!_username || !_password){
            $(".error").text("Complete all fields");
        
        } else {
    
            $.ajax({
                url: "../php/userLogin.php",
                type: "POST",
                datatype: "json",
                data: { username: _username, password: _password},
                success: login,
                error: ajaxFailed
            });
        }
    })

}); 


/* Redirection to homepage if the login was successful */ 

function login(json){
    if(json.userIsLogged){
        $(window.location).attr('href', 'homepage.php');
    }
    else {
        $(".error").text("User or email incorrect");
    }
}
