<?php
    /*  Returns the title and the photo of movies for the homepage, 
        i.e. the first 5 of the three categories (top, featured, favourites) */

    if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
        header("HTTP/1.1 400 Invalid Request");
        die("ERROR 400: Invalid request - This service accepts only GET requests.");
    }

    include "common.php";

    header("Content-type: application/json");


    if (userIsLogged()){
        returnHomeMoviesToJson();
    } else 
        print "{ \"Error\": \"Request not valid. Please, login\" }";

    /* -------------------------------------------------- */


    function returnHomeMoviesToJson(){
        $user = $_SESSION['name'];

        /* Db result */
        $featured_movies = getMovieList($user, "FEATURED", true); // true = LIMIT 5
        $top_movies = getMovieList($user, "TOP", true); // LIMIT 5
        $favourites_movies = getMovieList($user, "FAVOURITES", true); // LIMIT 5
        

        /* GET 5 FEATURED MOVIES */

        print "{ \"Featured\": \n";

        $movieArray = cleanResult($featured_movies);
        print json_encode($movieArray);

        print ",\n";

        /* ------------------------- */


        /* GET 5 TOP MOVIES */

        print "\"Top\": \n";
            
        $movieArray = cleanResult($top_movies);
        print json_encode($movieArray);

        print ",\n";

        /* ------------------------- */


        /* GET 5 FAVOURITES MOVIES */

        print "\"Favourites\": \n";

        
        $movieArray = cleanResult($favourites_movies);
        print json_encode($movieArray);    
        
        print "\n}";
        
    }
        

    // Clean and save result in a associative array
    function cleanResult($movieList){
        $movieArray = array();
        foreach ($movieList as $movie){
            $row_array['title'] = $movie['Titolo'];
            $row_array['photo'] = $movie['Foto'];
            array_push($movieArray,$row_array);
        }
        return $movieArray;
    }   
    
?>