<?php
    /* Returns the list of movies of a category, 
        without limits and with all the information */

    if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
        header("HTTP/1.1 400 Invalid Request");
        die("ERROR 400: Invalid request - This service accepts only GET requests.");
    }

    include "common.php";

    header("Content-type: application/json");

    if (userIsLogged()){
        returnAllMoviesInfoToJson();
    } else 
        print "{ \"Error\": \"Request not valid. Please, login\" }";

    /* -------------------------------------------------- */

    function returnAllMoviesInfoToJson(){
        if (!isset($_GET['typeL'])) {
            print "{\"Error\": \"Invalid request - Request type missing \"}";
        }
        
        else {
            $typeList = strip_tags($_GET['typeL']);
            $user = $_SESSION['name']; 

            switch ($typeList) {
                
                case "ADVANCED":

                    if (!isset($_GET['genre']) || !isset($_GET['order']) || !isset($_GET['show']) ||
                        !isset($_GET['minY']) || !isset($_GET['maxY'])){
                        
                        print "{\"Error\": \"Invalid request - Missing parameters.\"}";

                    } else {

                        $genre = $_GET['genre'];
                        $show = $_GET['show'];
                        $order = $_GET['order'];
                        $minY = $_GET['minY'];
                        $maxY = $_GET['maxY'];

                        if (($minY != "" && !ctype_digit($minY)) || ($maxY != "" && !ctype_digit($maxY)))
                            print "{ \"Error\": \"Insert valid year\" }";
                        
                        else{
                            // db result
                            $list = filterSearch($user, $genre, $show, $order, $minY, $maxY);

                            if ($list){
                                returnResult($list);
                            } else {
                                print "{ \"Error\": \"No movies in this list\" }";
                            }
                        }
                    }
                    break;

                case "FEATURED":
                case "FAVOURITES":
                case "TOP":
                case "TOWATCH":

                    // db result
                    $list = getMovieList($user, $typeList, false); // NO LIMIT 

                    if ($list){
                        returnResult($list);
                    } else {
                        print "{ \"Error\": \"No movies in this list\" }";
                    }
                    break;

                default:
                    print "{\"Error\": \"Invalid request - Request type not exists.\"}";

            }
        }
    }

    // Function to return movies info 
    function returnResult($list){
        $movieList = array();
        print "{ \"Movies\": \n";

        // clean result
        foreach ($list as $movie){
            $info = getMovieInfo($movie['Titolo']); // db result

            $row_array['title'] = $info['Titolo'];
            $row_array['photo'] = $info['Foto'];
            $row_array['genre'] = $info['Genere'];
            $row_array['averageGrades'] = $info['MV'];
            $row_array['releaseDate'] = $info['DataUscita'];
            $row_array['movieDirectorName'] = $info['Nome'];
            $row_array['movieDirectorSurname'] = $info['Cognome'];
            $row_array['music'] = $info['Musiche'];
            $row_array['country'] = $info['Paese'];
            $row_array['distribution'] = $info['Distribuzione'];
            $row_array['production'] = $info['Produzione'];
            $row_array['length'] = $info['Durata'];
            $row_array['screenplay'] = $info['Sceneggiatura'];

            array_push($movieList,$row_array);
        }

        print json_encode($movieList);
        print "\n}";
    }
?>