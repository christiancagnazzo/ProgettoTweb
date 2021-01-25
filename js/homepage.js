$(function(){

    // Initial check and operation
    checkIfUserLogged();
    
    activeLogout();
    
    // Active search button
    $("#searchBtn").click(search);

    // Active all movie button 
    $(".all").click(function (){
        var type = this.id;
        var url = 'allMoviesPage.php?type='+type;
        $(window.location).attr('href', url)
    })

    // Active watch list button 
    $("#toWatch").click(function (){
        var url = 'allMoviesPage.php?type=TOWATCH';
        $(window.location).attr('href', url)
    })
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
    else show homepage */

function completeLogin(json){
    if(json.userIsLogged){
        $("#user").text(json.name);
        
        // Request movies homepage 
        $.ajax({
            url: "../php/getMoviesHomepage.php",
            type: "GET",
            datatype: "json",
            success: showHomePageMovies,
            error: ajaxFailed
        });

        activeDragDropArea();

        // Fade in section
        $("#today").fadeIn(500);
        $("#top").fadeIn(500);
        $("#favourite").fadeIn(500);  
        
    } else {
        $(window.location).attr('href', 'login.php');
    }
} 

/* --------------------------------------------------------------------- */



    /* ----------------
        SHOW HOME MOVIE
        --------------- */

function showHomePageMovies(json){
    if (json.Error){
        $("#homepage").hide();
        $(".error").text(json.Error);
        
    } else {
        var featured = json.Featured;
        var top = json.Top;
        var favourites = json.Favourites;

        show(featured, $("#imgToday")); 
        show(top, $("#imgTop"));
        show(favourites, $("#imgFavourites"));
    }
}

/* Auxiliar function to show movies img */

function show(movies, div){
    movies.forEach(function (movie){
        var img = $('<img>');
        img.attr('src', movie.photo);
        img.attr('alt', movie.title);
        img.appendTo(div);

        img.click(function() { // on click redirect to single movie page
            var title = movie.title.replaceAll(" ", "+");
            var url = 'moviePage.php?title='+title;
            $(window.location).attr('href', url)
        })

        activeDragDropImg(img, movie);        
    })
}




     