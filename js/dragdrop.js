/* Active drag and drop area */

function activeDragDropArea(){
    // add movies already present
    $.ajax({
        url: "../php/getAllMovies.php",
        type: "GET",
        datatype: "json",
        data: { typeL : "TOWATCH" },
        error: ajaxFailed,
        success: function(json){
            var movies = json.Movies;
       
            movies.forEach(function (movie){
                var img = $('<img class=iconMovie>');
                img.attr('src', movie.photo);
                img.attr('alt', movie.title);
                $("#drag").append(img);
            }) 
        }
    })

    // drag event
    $("#drag").on({
        drop: function(event){
            event.preventDefault();
            event.dataTransfer = event.originalEvent.dataTransfer;
            title = event.dataTransfer.getData("text");
            // add movie
            $.ajax({
                url: "../php/movieInteraction.php",
                type: "POST",
                datatype: "json",
                data: { movieTitle : title, request : "addToWatch" },
                success: checkToWatch,
                error: ajaxFailed
            })      
        },
        dragover: function(event){
            event.preventDefault();
            $("#drag").css("background-color","orange");
        },
        dragleave: function(event){ 
            event.preventDefault();
            $("#drag").css("background-color","red");
        }
    })
}

/* Check if movie has been added to the list */ 

function checkToWatch(json){
    if (json.Error){
        $(".error").show();
        $(".error").text(json.Error);
    } else {
        if (json.addToWatch && json.addToWatch == "True"){
            $("#drag").css("background-color","green").animate({height: "0"}, "slow"); 
            // update drag area 
            $.ajax({
                url: "../php/getMovieInfo.php",
                type: "GET",
                datatype: "json",
                data: { movieTitle : title },
                error: ajaxFailed,
                success: function(json){
                    var allInfo = json.Info;
                    allInfo.forEach(function (info) {
                        var img = $('<img class=iconMovie>');
                        img.attr('src', info.photo);
                        img.attr('alt', info.title);
                        $("#drag").append(img);
                    })
                }
            })
        } else {
            $("#drag").effect("shake").animate({height: "0"}, "slow"); 
        }
    }
}

/* Active drag and drop image */

function activeDragDropImg(img, movie){
    img.attr("id",movie.title);
    img.attr('draggable', true);
    img.on({
        dragstart: function(event){
            $("#drag").css("background-color","red");
            $("#drag").animate({height: "100px"}, "slow");
            event.dataTransfer = event.originalEvent.dataTransfer;
            event.dataTransfer.setData("text", event.target.id);
        },
        dragend: function(){ 
            if ($("#drag").css('background-color') == 'rgb(255, 0, 0)') // red
                $("#drag").animate({height: "0"}, "slow"); 
            }
    })
}