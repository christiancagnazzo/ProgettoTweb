$(function(){

    // Hide search bar, logout button and watch list button
    $("#search").hide();
    $("#logout").hide();
    $("#toWatch").hide();

    // Active signup button
    $("#signupBtn").click(function(){
        $(".error").text("");

        var _name = $("#name").val();
        var _surname = $("#surname").val();
        var _email = $("#email").val();
        var _username = $("#username").val();
        var _password = $("#password").val();

        if (!_username || !_password || !_name || !_surname || !_email){
            
            $(".error").text("Complete all fields");
        
        } else if (!/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(_email))
            
            $(".error").text("Insert valid email");
        
        else if (!/(?=^.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$/.test(_password)){
            
            $(".error").text("Insert 8 char, one upper and one lower case");
        }

        else {
    
            $.ajax({
                url: "../php/userSignup.php",
                type: "POST",
                datatype: "json",
                data: { name: _name, surname: _surname, email: _email, username: _username, password: _password},
                success: signup,
                error: ajaxFailed
            });
        }
    })

}); 


/* Redirection to the homepage if the signup was successful */ 

function signup(json){
    if(json.userIsLogged){
        $(window.location).attr('href', 'homepage.php');
    }
    else {
        $(".error").text(json.Error);
    }
}
