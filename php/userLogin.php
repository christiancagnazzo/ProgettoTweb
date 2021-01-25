<?php 
   
    if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
       header("HTTP/1.1 400 Invalid Request");
       die("ERROR 400: Invalid request - This service accepts only POST requests.");
    }
    
    include "common.php";

    header("Content-type: application/json");
    
    
    /* Check password user and set session */

    if (isset($_POST["username"]) && (isset($_POST["password"]))) {
        $username = strip_tags($_POST["username"]);
        $password = strip_tags($_POST["password"]);
        
        if (checkPassword($username, $password) == true) {
            if (isset($_SESSION)) {
                session_regenerate_id(TRUE);
            }
            $_SESSION["name"] = $username;
        } 
    }
    

    /* Return json result */

    print "{\n";

    if(userIsLogged()){

        print " \"userIsLogged\": true, \n";
        print "  \"name\": \"".$_SESSION["name"]."\"";

    } else {

        print " \"userIsLogged\": false \n";
        
    }

    print "\n}";
?>