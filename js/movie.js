$(function(){ 
    
    // Hide watch list button
    $("#toWatch").hide();
    
    // Initial check and operation
    checkIfUserLogged();
    activeLogout();

    // Active search button
    $("#searchBtn").click(search);

    // Active favourites button   
    $("#favouriteHeart").click(favourite);

    // Active button rate and delete rate
    $(".rating input").click(addRate);
    $("#remove").click(removeRate);

    // Active add watch list button 
    $("#watchDiv").click(watch);

    // User review
    $( "#confirm" ).prop( "disabled", true );
    $( "#delete" ).prop( "disabled", true );
    $("#confirm").click(addReview);
    $("#delete").click(deleteReview)
    

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
    else show homepage */

function completeLogin(json){
    if(json.userIsLogged){
        $("#user").text(json.name);
        
        // Retrieving the title parameter from the query string
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var title = urlParams.get('title');
        
        // Request movie info
        $.ajax({
            url: "../php/getMovieInfo.php",
            type: "GET",
            datatype: "json",
            data: { movieTitle : title },
            success: showMovieInfo,
            error: ajaxFailed
        })
       
    } else {
        $(window.location).attr('href', 'login.php');
    }
} 

/* --------------------------------------------------------------------- */


    /* ----------------
        SHOW MOVIE INFO
        --------------- */

function showMovieInfo(json) {
    if (json.Error){
        $("#movieContainer").hide();
        $(".error").show();
        $(".error").text(json.Error);
        
    } else if (json.Info) {
        $("#movieContainer").fadeIn(500);
        $(".error").hide();
        $("#left img").remove();
        $("#list_el").empty();
        $("#actorsContainer").empty();
        
        var allInfo = json.Info;
        var actors = json.Actors;

        showInfo(allInfo);
        showListActor(actors);

        // set initially rate and preference
        $.ajax({
            url: "../php/movieInteraction.php",
            type: "POST",
            datatype: "json",
            data: { movieTitle : $("#movieTitle").text(), request : "init" },
            success: setInit,
            error: ajaxFailed
        }) 

        // set initially user review
        $.ajax({
            url: "../php/movieReviews.php",
            type: "POST",
            datatype: "json",
            data: { movieTitle : $("#movieTitle").text(), request : "userReview" },
            success: setUserReview,
            error: ajaxFailed
        })

        // set all reviews
        $.ajax({
            url: "../php/movieReviews.php",
            type: "POST",
            datatype: "json",
            data: { movieTitle : $("#movieTitle").text(), request : "allReviews" },
            success: setAllReviews,
            error: ajaxFailed
        })
    } 
}

function showInfo(allInfo){
    allInfo.forEach(function (info) {
        $("#movieTitle").text(info.title);
        var img = $("<img class=moviePhoto>");
        img.attr("src", info.photo);
        img.attr("alt", info.title);
        $("#left").append(img);

        liAppend(info.genre);
        liAppend(info.averageGrades);
        liAppend(info.releaseDate);
        liAppend(info.movieDirectorName+" "+info.movieDirectorSurname);
        liAppend(info.music);
        liAppend(info.country);
        liAppend(info.distribution);
        liAppend(info.production);
        liAppend(info.length);
        liAppend(info.screenplay);

        $("#description").text(info.description);
    });
}

function showListActor(actors){
    var container = $("#actorsContainer");

    actors.forEach(function (actor) {
        var div = $("<div class=actor></div>");
        var span = $("<span class=character>")

        var img = $("<img class=actorsImg>");
        img.attr("id", actor.actor)
        img.attr("src", actor.photo);
        img.attr("alt", actor.character);
        span.text(actor.character);
        div.append(span);
        div.append(img);
        container.append(div);

        div.click(function() { // on click redirec to actor page
            var url = 'actorPage.php?actor='+actor.actor;
            $(window.location).attr('href', url)
        })
    });
}


    /* ----------------
       MOVIE INTERACTION
        --------------- */

/* Function to set rate and favourite initially */

function setInit(json){
    if (json.Error){
        $("#movieContainer").hide();
        $(".error").text(json.Error);
        
    } else {
        var rate = json.rate;
        var favourite = json.isFavourite;
        var toWatch = json.isToWatch;

        if (rate == 0)
            $("#0").prop("checked",true);
        else 
            $("#"+rate).prop("checked",true);

        if (favourite == "True")
            $("#favouriteHeart > label").attr("id", "love");
        else 
            $("#favouriteHeart > label").attr("id", "notLove");

        if (toWatch == "True"){
            $("#watchDiv > label").attr("id", "yesWatch");
        } else {
            $("#watchDiv > label").attr("id", "notWatch");
        }
        
    }
}


/* Function to add or remove a movies to/from favourites */

function favourite(){
    var requestType;

    if ($("#favouriteHeart > label")[0].id == "love"){
        requestType = "removePrefer";
    }
    else  {
        requestType = "addPrefer";
        $("#favouriteHeart > label").animate({opacity: '0.5'}, "slow");
        $("#favouriteHeart > label").animate({opacity: '1'}, "slow");
    }

    $.ajax({
        url: "../php/movieInteraction.php",
        type: "POST",
        datatype: "json",
        data: { movieTitle : $("#movieTitle").text(), request : requestType },
        success: updateFavourite,
        error: ajaxFailed
    }) 
}

function updateFavourite(json){
    if (json.Error){
        $("#movieContainer").hide();
        $(".error").text(json.Error);
        $("#error").show();
    }
    else {
        if (json.addPrefer && json.addPrefer == "True")
            $("#favouriteHeart > label").attr("id", "love");
        
        else if (json.removePrefer && json.removePrefer == "True")
            $("#favouriteHeart > label").attr("id", "notLove"); 
    }
}

/* Function to add or remove a movies to/from watch list */

function watch(){
    var requestType;

    if ($("#watchDiv > label")[0].id == "yesWatch"){
        requestType = "removeToWatch";
    }
    else  {
        requestType = "addToWatch";
        var eye = $("#watchDiv > label");
        eye.animate({opacity: '0.5'}, "slow");
        eye.animate({opacity: '1'}, "slow");
    }

    $.ajax({
        url: "../php/movieInteraction.php",
        type: "POST",
        datatype: "json",
        data: { movieTitle : $("#movieTitle").text(), request : requestType },
        success: updateWatch,
        error: ajaxFailed
    })
}

function updateWatch(json){
    if (json.Error){
        $("#movieContainer").hide();
        $(".error").text(json.Error);
        $("#error").show();
    }
    else {
        if (json.addToWatch && json.addToWatch == "True")
            $("#watchDiv > label").attr("id", "yesWatch");

        else if (json.removeToWatch && json.removeToWatch == "True")
            $("#watchDiv > label").attr("id", "notWatch");
    }
}


/* Function to add or change movie rate */

function addRate(event){
    var vote = event.target.id;
    
    $.ajax({
        url: "../php/movieInteraction.php",
        type: "POST",
        datatype: "json",
        data: { movieTitle : $("#movieTitle").text(), request : "addRate", rate : vote },
        error: ajaxFailed,

        success: function(json) { 
            if (json.Error){ 
                $("#movieContainer").hide();
                $(".error").text(json.Error);
                $("#error").show();
            }
            else {

                if (json.addRate && json.addRate == "True"){ 
                    $(".rating input").prop('checked', false);
                    $("#"+vote).prop("checked",true);
                    $(".rating label").animate({opacity: '0.4'}, "slow");
                    $(".rating label").animate({opacity: '1'}, "slow");
                } 
            }
        }
    })
}

/* Function to remove movie rate */

function removeRate(){
    $.ajax({
        url: "../php/movieInteraction.php",
        type: "POST",
        datatype: "json",
        data: { movieTitle : $("#movieTitle").text(), request : "removeRate"},
        error: ajaxFailed,

        success: function(json) { 
            if (json.Error){ 
                $("#movieContainer").hide();
                $(".error").text(json.Error);
                $("#error").show();
            }
            else {

                if (json.removeRate && json.removeRate == "True"){ 
                    $(".rating input").prop('checked', false);
                    $("#0").prop("checked",true);
                    $("#remove").animate({opacity: '0.5'}, "slow");
                    $("#remove").animate({opacity: '1'}, "slow");
                } 
            }
        }
    })
}

/* Function to set user's review */

function setUserReview(json){
    if (!json.Error){
        if (json.Review){
            $("#delete").prop( "disabled", false);
            $("#confirm").prop( "disabled", true);
            $("#usReview").text(json.Review);
            $("#usReview").prop("disabled", true);
        }
        else {
            $("#confirm").prop( "disabled", false);
            $("#delete").prop( "disabled", true);
            $("#usReview").text("");
            $("#usReview").prop("disabled", false);
        }
    }
}

/* Function to set all reviews */
function setAllReviews(json){
    if (json.Error){
        $("#allReviews").empty();
        $("#revErr").show();
        $("#revErr").text("There are no reviews from other users");

    } else if (json.Reviews) {
        $("#allReviews").empty();
        var reviews = json.Reviews;
        
        var allContainer = $("#allReviews");
        
        reviews.forEach(function (review){
            var container = $("<div class=containerReview></div>");
            
            var p = $("<p></p>");
            p.text(review['review']);
            
            var span = $("<span></span>");
            span.text(review['user']);

            container.append(p);
            container.append(span);
            allContainer.append(container);
        })
    }    
}

/* Function to add review */
function addReview(){
    var _review = $("#usReview").val();

    if (_review){
        $.ajax({
            url: "../php/movieReviews.php",
            type: "POST",
            datatype: "json",
            data: { movieTitle : $("#movieTitle").text(), request : "addReview", review : _review },
            error: ajaxFailed,

            success: function(json) {
                if (!json.Error){
                    if (json.addReview){
                        $( "#confirm" ).prop( "disabled", true );
                        $( "#delete" ).prop( "disabled", false );
                        $("#usReview").prop("disabled", true);
                    }
                }
            }
        })
    }
}

/* Function to delete review */
function deleteReview(){
    var _review = $("#usReview").val();

    if (_review){
        $.ajax({
            url: "../php/movieReviews.php",
            type: "POST",
            datatype: "json",
            data: { movieTitle : $("#movieTitle").text(), request : "deleteReview"},
            error: ajaxFailed,

            success: function(json) {
                if (!json.Error){
                    if (json.deleteReview){
                        $("#confirm").prop( "disabled", false );
                        $("#delete").prop( "disabled", true );
                        $("#usReview").prop("disabled", false);
                        $("#usReview").val('')
                    }
                }
            }
        })
    }
}

