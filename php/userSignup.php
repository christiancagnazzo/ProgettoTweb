<?php 
   
    if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
       header("HTTP/1.1 400 Invalid Request");
       die("ERROR 400: Invalid request - This service accepts only POST requests.");
    }
    
    include "common.php";

    header("Content-type: application/json");
    
    print "{\n";

    /* Search for user and if it does not exist insert in the db */

    if (isset($_POST["username"]) && isset($_POST["password"]) &&
        isset($_POST["name"]) && isset($_POST["surname"]) &&
        isset($_POST["email"])){
        
        $username = strip_tags($_POST["username"]);
        $password = strip_tags($_POST["password"]);
        $name = strip_tags($_POST["name"]);
        $surname = strip_tags($_POST["surname"]);
        $email = strip_tags($_POST["email"]);

        if (!ifUserExists($username) && !ifEmailExists($email)){
            
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                print " \"Error\": \"Insert a valid email\", \n";
                
            } else {
                // insert user into db
                $rst = insertUser($username,md5($password),$name,$surname,$email);
                if ($rst){
                    if (isset($_SESSION)) {
                        session_regenerate_id(TRUE);
                    }
                    $_SESSION["name"] = $username;
                }
            }
            
        } else
            print " \"Error\": \"Existing username or email\", \n";
    }
    

    /* Return json result */

    if(userIsLogged()){

        print " \"userIsLogged\": true, \n";
        print "  \"name\": \"".$_SESSION["name"]."\"";

    } else {

        print " \"userIsLogged\": false \n";
        
    }

    print "\n}";
?>