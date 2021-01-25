/* Active logout */

function activeLogout(){
    $("#logoutBtn").click(function(){
        $.ajax({
            url: "../php/userLogout.php",
            type: "GET",
            success: function() { $(window.location).attr('href', 'login.php'); },
        });
    })
}


/* Function to search actor or movie */

function search(){
    var request = $("#selectType").val(); 
    var to_search =  $("#search > input").val();
   
    if (to_search){

        var path = window.location.pathname;

        if (path == "/progetto/html/moviePage.php" && request == "Movies"){
            
            // ajax request
            $.ajax({
                url: "../php/getMovieInfo.php",
                type: "GET",
                datatype: "json",
                data: { movieTitle : to_search },
                success: showMovieInfo,
                error: ajaxFailed
            })

        } else if (path == "/progetto/html/actorPage.php" && request == "Actors"){
            
            // ajax request
            var array = to_search.split(" ");
            $.ajax({
                url: "../php/getActorInfo.php",
                type: "GET",
                datatype: "json",
                data: { name : array[0], surname : array[1] },
                success: showActorInfo,
                error: ajaxFailed
            })

        } else {

            // redirect
            if (request == "Movies")
                var url = 'moviePage.php?title='+to_search;
            else { 
                var array = to_search.split(" ");
                var url = 'actorPage.php?name='+array[0]+'&surname='+array[1];
            }

            url = url.replaceAll(" ", "+");
            $(window.location).attr('href', url)
        }
    }
}

/* Auxiliary function that creates a list element */

function liAppend(info){
    var list = $("#list_el");
    var li = $("<li>"+info+"</li>");
    list.append(li);
}


/* Ajax error */

function ajaxFailed(e) {
    var errorMessage = "Error making Ajax request:\n\n";

    errorMessage += "Server status:\n" + e.status + " " + e.statusText +
        "\n\nServer response text:\n" + e.responseText;
    alert(errorMessage);
}

/* Login error */

function loginError() {
    $(window.location).attr('href', 'login.php');
}
