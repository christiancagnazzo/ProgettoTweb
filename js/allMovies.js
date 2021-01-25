$(function(){  
    $("#filter").hide();
    
    // Initial check and operation
    checkIfUserLogged();
    activeLogout();
    
    // Active search button
    $("#searchBtn").click(search);

    // Active movie list type button
    $(".titleType").click(function (){
        $(".titleType").removeClass("selected");
        $("#"+this.id).addClass("selected");
        $("#allContainer").empty();
        if (this.id == "ADVANCED"){
            $("#filter").show();
            $("fieldset").slideDown("slow");
        } else {
            $("fieldset").slideUp("slow");
            $("#filter").hide();
            $.ajax({
                url: "../php/getAllMovies.php",
                type: "GET",
                datatype: "json",
                data: { typeL : this.id },
                success: showMovieList,
                error: ajaxFailed
            })
        }
    })

    // Active filter search button
    $("#subFilter").click(function() {
        $("fieldset").slideUp("slow");
        var min = $("#min").val() || "";
        var max = $("#max").val() || "";
        if (isNaN(min) || isNaN(max)){
            $("#allContainer").empty();
            $(".error").text("Insert valid year");
            $(".error").show();
        } else {

            $.ajax({
                url: "../php/getAllMovies.php",
                type: "GET",
                datatype: "json",
                data: { typeL : "ADVANCED", genre: $("#genre").val(), order: $("#order").val(), 
                        show: $("input[name='show']:checked").val(), minY: min, maxY: max},
                success: showMovieList,
                error: ajaxFailed
            })
        }
    })

    // Active toWatch button
    $("#toWatch").click(function (){
        $("fieldset").slideUp("slow");
        $("#filter").hide();
        $(".titleType").removeClass("selected");
        $("#TOWATCH").addClass("selected");
        $("#allContainer").empty();
        $.ajax({
            url: "../php/getAllMovies.php",
            type: "GET",
            datatype: "json",
            data: { typeL : "TOWATCH" },
            success: showMovieList,
            error: ajaxFailed
        })
    })

    // Active slide filter
    $("#filter").click(function(){
        $("fieldset").slideToggle("slow");
    })


    // Go to homepage
    $("#logo").click(function(){ $(window.location).attr('href', 'homepage.php');})
})

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
    else show all movies page */

function completeLogin(json){
    if(json.userIsLogged){
        $("#user").text(json.name);
        
        // Retrieving the type parameter from the initially query string 
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var typeList = urlParams.get('type');

        // Request all movies list based on type 
        if (typeList) { 
            $("#"+typeList).addClass("selected");
            $.ajax({
                url: "../php/getAllMovies.php",
                type: "GET",
                datatype: "json",
                data: { typeL : typeList },
                success: showMovieList,
                error: ajaxFailed
            })
        }

        activeDragDropArea();
        
    } else {
        $(window.location).attr('href', 'login.php');
    }
}
/* --------------------------------------------------------------------- */


    /* ----------------
        SHOW MOVIE LIST
        --------------- */

function showMovieList(json){
    if (json.Error){
        $("#allContainer").empty();
        $(".error").text(json.Error);
        $(".error").show();

    } else {
        $(".error").hide();
        $("#allContainer").empty();
        
        var movies = json.Movies;
        var allContainer = $("#allContainer");
        
        movies.forEach(function (movie){
            var container = $("<div class=container></div>");

            var left = createLeft(movie);
            var right = createRight(movie);
            container.append(left);
            container.append(right);

            allContainer.append(container);
            container.fadeIn(700);
        }) 
       
    }
}


/* Auxiliary function that creates the left content (title and photo film) */

function createLeft(movie){
    var left = $("<div id=left></div>");
    
    var title = $("<div id=movieTitle></div>");
    title.click(function() { // on click redirect to single movie page
        var title = movie.title.replaceAll(" ", "+");
        var url = 'moviePage.php?title='+title;
        $(window.location).attr('href', url)
    })
    title.text(movie.title);
    
    var img = $('<img class=moviePhoto>');
    img.click(function() { // on click redirect to single movie page
        var title = movie.title.replaceAll(" ", "+");
        var url = 'moviePage.php?title='+title;
        $(window.location).attr('href', url)
    })
    img.attr('src', movie.photo);
    img.attr('alt', movie.title);
    
    left.append(title);
    left.append(img)

    activeDragDropImg(img, movie);

    return left;
}

/* Auxiliary function that creates the right content (movie info) */

function createRight(movie){
    var right = $("<div id=right></div>");
    var list_def = createListDef(movie);
    var list_el = createListEl(movie);
    right.append(list_def);
    right.append(list_el);
    return right;
}

/* Auxiliary function that creates the info definition list */

function createListDef(){
    var list_def = $("<ul id=list_def></ul>");
    listAppend("Genre: ",list_def);
    listAppend("Average grades: ",list_def);
    listAppend("Realease date: ",list_def);
    listAppend("Movie director: ",list_def);
    listAppend("Music: ",list_def);
    listAppend("Country: ",list_def);
    listAppend("Distribution:",list_def);
    listAppend("Production: ",list_def);
    listAppend("Length: ",list_def);
    listAppend("Screenplay: ",list_def);
    return list_def;
}

/* Auxiliary function that creates the information list */

function createListEl(movie){
    var list_el = $("<ul id=list_el></ul>");
    listAppend(movie.genre,list_el);
    listAppend(movie.averageGrades,list_el);
    listAppend(movie.releaseDate,list_el);
    listAppend(movie.movieDirectorName+" "+movie.movieDirectorSurname,list_el);
    listAppend(movie.music,list_el);
    listAppend(movie.country,list_el);
    listAppend(movie.distribution,list_el);
    listAppend(movie.production,list_el);
    listAppend(movie.length,list_el);
    listAppend(movie.screenplay,list_el);
    return list_el;
}

/* Auxiliary function that creates a list element */

function listAppend(info, append_to){
    var li = $("<li>"+info+"</li>");
    append_to.append(li);
}

