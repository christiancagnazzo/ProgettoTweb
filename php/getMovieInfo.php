<?php
    /* Returns all the info of a single movie */

    if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
        header("HTTP/1.1 400 Invalid Request");
        die("ERROR 400: Invalid request - This service accepts only GET requests.");
    }

    include "common.php";

    header("Content-type: application/json");

    if (userIsLogged()){
        returnMovieInfoToJson();
    } else 
        print "{ \"Error\": \"Request not valid. Please, login\" }";

    /* -------------------------------------------------- */

    function returnMovieInfoToJson(){
        if (!isset($_GET['movieTitle']))
            print "{\"Error\": \"Invalid request - Movie title missing.\"}";

        else {
        
            $info = getMovieInfo(strip_tags(($_GET['movieTitle']))); // db result

            if ($info){
                print "{ \"Info\": \n";
            
                // clean result
                $return_arr = array();
                $row_array['title'] = $info['Titolo'];
                $row_array['photo'] = $info['Foto'];
                $row_array['description'] = $info['Descrizione'];
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
                array_push($return_arr,$row_array);
            
                // return result
                print json_encode($return_arr);

                $actors = getActorsOfMovie($_GET['movieTitle']); // db result

                if ($actors){
                    print ",\n \"Actors\": \n";
                    $return_arr = array();

                    foreach ($actors as $actor){
                        $rowarray['actor'] = $actor['Attore'];
                        $rowarray['character'] = $actor['Personaggio'];
                        $rowarray['photo'] = $actor['Foto'];
                        array_push($return_arr,$rowarray);
                    }
            
                    // return result
                    print json_encode($return_arr);
                }

                print "\n}";
                
            } else {
                print "{ \"Error\": \"Movie not found\" }";
            }
        }
    }
?>