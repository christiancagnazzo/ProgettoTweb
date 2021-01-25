<?php
    /* Manages user interaction with movies: 
       adding and removing votes, favorites and to watch */

    if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
        header("HTTP/1.1 400 Invalid Request");
        die("ERROR 400: Invalid request - This service accepts only POST requests.");
    }

    include "common.php";

    header("Content-type: application/json");

    if (userIsLogged()){
        returnResultInteractionToJson();
    } else 
        print "{ \"Error\": \"Request not valid. Please, login\" }";

    /* -------------------------------------------------- */


    function returnResultInteractionToJson(){
        if (!isset($_POST['request']) || !isset($_POST['movieTitle'])) {
            print "{ \"Error\": \"Request not valid - Missing request type or movie title\" }";

        } else {

            $request = strip_tags($_POST['request']);
            $movie = $_POST['movieTitle'];
            $user = $_SESSION['name'];

            switch ($request) {
                case "init":
                    $vote = getRate($movie, $user); // db result
                    if ($vote != null)
                        print "{ \"rate\": \"".$vote."\",\n";
                    else
                        print "{ \"rate\": \"0\",\n";

                    $isFavourite = isFavourite($movie, $user); // db result
                    if ($isFavourite)
                        print "\"isFavourite\": \"True\",\n";
                    else
                        print "\"isFavourite\": \"False\",\n"; 

                    $isToWatch = isToWatch($movie, $user); // db result
                    if ($isToWatch)
                        print "\"isToWatch\": \"True\"}";
                    else
                        print "\"isToWatch\": \"False\"}";    
                break;

                case "addPrefer":
                    $result = addPrefer($movie, $user); // db result
                    if ($result)
                        print "{ \"addPrefer\": \"True\"}";
                    else
                        print "{ \"addPrefer\": \"False\"}";
                    break;

                case "removePrefer":
                    $result = removePrefer($movie, $user); // db result
                    if ($result)
                        print "{ \"removePrefer\": \"True\"}";
                    else
                        print "{ \"removePrefer\": \"False\"}";
                    break;

                case "addRate":
                    if (!isset($_POST['rate']))
                        print "{ \"Error\": \"Request not valid\" }";
                    
                    else {  
                        $rate = strip_tags($_POST['rate']);
                        $result = addRate($movie, $user, $rate); // db result
                        if ($result)
                            print "{ \"addRate\": \"True\"}";
                        else
                            print "{ \"addRate\": \"False\"}";
                    }
                    break;
                
                case "removeRate":
                    $result = removeRate($movie, $user); // db result
                    if ($result)
                        print "{ \"removeRate\": \"True\"}";
                    else
                        print "{ \"removeRate\": \"False\"}";
                    break;

                case "addToWatch":
                    $result = addToWatch($movie, $user); // db result
                    if ($result)
                        print "{ \"addToWatch\": \"True\"}";
                    else
                        print "{ \"addToWatch\": \"False\"}";
                
                    break;

                case "removeToWatch":
                    $result = removeToWatch($movie, $user); // db result
                    if ($result)
                        print "{ \"removeToWatch\": \"True\"}";
                    else
                        print "{ \"removeToWatch\": \"False\"}";
                
                    break;

                default:
                    print "{ \"Error\": \"Request not valid\" }";
                    break;
            }
        }
    }
?>



