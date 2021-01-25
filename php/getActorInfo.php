<?php
    /* Returns all the info of a single actor */ 

    if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "GET") {
        header("HTTP/1.1 400 Invalid Request");
        die("ERROR 400: Invalid request - This service accepts only GET requests.");
    }

    include "common.php";

    header("Content-type: application/json");

    if (userIsLogged()){
        returnActorInfoToJson();
    } else 
        print "{ \"Error\": \"Request not valid. Please, login\" }";

    /* -------------------------------------------------- */

    function returnActorInfoToJson(){
        $actor_id = null;

        // the parameter provided is the actor id
        if (isset($_GET['actor']) && $_GET['actor'] != "") 
            $actor_id = strip_tags(($_GET['actor']));
        
        // the parameters provided are actor name and surame
        else if (isset($_GET['name']) && $_GET['name'] != "" && isset($_GET['surname']) && $_GET['surname'] != ""){
            $id = getActorId(strip_tags($_GET['surname']), strip_tags($_GET['name'])); // actor id
            
            if (!$id)
                print "{ \"Error\": \"Actor not found\" }";
            else 
                $actor_id = $id['Codice'];

        } else print "{ \"Error\": \"Request not valid\" }";

        
        if ($actor_id){

            $info = getActorInfo($actor_id); // db result

            if ($info){
                print "{ \"Info\": \n";
            
                // clean result
                $return_arr = array();
                $row_array['name'] = $info['Nome'];
                $row_array['surname'] = $info['Cognome'];
                $row_array['date'] = $info['DataNascita'];
                $row_array['place'] = $info['LuogoNascita'];
                $row_array['age'] = $info['Eta'];
                $row_array['photo'] = $info['Foto'];
                $row_array['description'] = $info['Descrizione'];
                array_push($return_arr,$row_array);
            
                // return result
                print json_encode($return_arr);

                $movies = getMoviesActor($actor_id); // db result

                if ($movies){
                    print ",\n \"Movies\": \n";
                    $return_arr = array();

                    foreach ($movies as $movie){
                        $rowarray['movie'] = $movie['Film'];
                        array_push($return_arr,$rowarray);
                    }
            
                    // return result
                    print json_encode($return_arr);
                }

                print "\n}";
                
            } else {
                print "{ \"Error\": \"Actor not found\" }";
            }
        }
    }
    
?>