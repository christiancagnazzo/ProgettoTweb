$(function(){

    // Hide watch list button
    $("#toWatch").hide();

    // Initial check and operation 
    checkIfUserLogged();
    activeLogout();

    // Active search button
    $("#searchBtn").click(search);

    // Go to homepage
    $("#logo").click(function(){ $(window.location).attr('href', 'homepage.php');})
}); 

/* --------------------------------------------------------------------- */

/* Check if user is logged in */

function checkIfUserLogged(){
    $.ajax({
        url: "../php/userLogin.php",
        type: "POST",
        datatype: "json",
        success: completeLogin,
        error: loginError
    })
}

/* If the user was not logged, redirect to login
    else show actor page */

function completeLogin(json){
    if(json.userIsLogged){
        $("#user").text(json.name);
        
        // Retrieving the parameter from the query string
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var actorId = urlParams.get('actor') || "";
        var actorName = urlParams.get('name') || "";
        var actorSurname = urlParams.get('surname') || "";

        // Request actor info
        $.ajax({
            url: "../php/getActorInfo.php",
            type: "GET",
            datatype: "json",
            data: { actor : actorId, name : actorName, surname : actorSurname },
            success: showActorInfo,
            error: ajaxFailed
        })
        
    } else {
        $(window.location).attr('href', 'login.php');
    }
} 

/* --------------------------------------------------------------------- */

    /* ----------------
        SHOW ACTOR INFO
        --------------- */

function showActorInfo(json){
    if (json.Error){
        $("#actorContainer").hide();
        $(".error").show();
        $(".error").text(json.Error);

    } else {
        $(".error").hide();
        $("#list_el").empty();
        $("#movieList").empty();
        $("#actorPhoto").remove();
        $("#actorContainer").fadeIn(500);

        var allInfo = json.Info;
        var movies = json.Movies;
        
        allInfo.forEach(function (info) {
            var img = $("<img id=actorPhoto>");
            img.attr("src", info.photo);
            img.attr("alt", info.name+" "+info.surname);
            $("#left").append(img);

            liAppend(info.name+" "+info.surname);
            liAppend(info.date);
            liAppend(info.place);
            liAppend(info.age);

            $("#description").text(info.description);
        });

        movies.forEach(function (movie) {
            var list = $("#movieList");
            var li = $("<li></li>")

            li.text(movie.movie)
            list.append(li);

            li.click(function() {
                var url = 'moviePage.php?title='+movie.movie;
                $(window.location).attr('href', url)
            })
        });
    }
}


