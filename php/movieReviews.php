<?php
    /* Handles the addition, removal and return of movie reviews */

    if (!isset($_SERVER["REQUEST_METHOD"]) || $_SERVER["REQUEST_METHOD"] != "POST") {
        header("HTTP/1.1 400 Invalid Request");
        die("ERROR 400: Invalid request - This service accepts only POST requests.");
    }

    include "common.php";

    header("Content-type: application/json");

    if (userIsLogged()){
        returnResultReviewToJson();
    } else 
        print "{ \"Error\": \"Request not valid. Please, login\" }";

    /* -------------------------------------------------- */

    function returnResultReviewToJson(){

        if (!isset($_POST['request']) || !isset($_POST['movieTitle'])) {
            print "{ \"Error\": \"Request not valid - Missing request type or movie title\" }";
        
        } else {

            $request = strip_tags($_POST['request']);
            $movie = strip_tags($_POST['movieTitle']);
            $user = $_SESSION['name'];

            switch ($request) {

                case "userReview":
                    $review = getUserReview($movie, $user); // db result
                    if ($review)
                        print "{ \"Review\": \"".$review."\"}";
                    else
                        print "{ \"False\": \"No review\"}";
                    break;

                case "allReviews":      
                    $reviews = getAllReviews($movie, $user); // db result

                    if ($reviews){
                        $reviewList = array();
                        print "{ \"Reviews\": \n";

                        // clean result
                        foreach ($reviews as $review){
                            $row_array['review'] = $review['Recensione'];
                            $row_array['user'] = $review['Utente'];
                        
                            array_push($reviewList,$row_array);
                        }

                        print json_encode($reviewList);
                        print "\n}";

                    } else {
                        print "{ \"Error\": \"No reviews\" }";
                    }
                    break;

                case "addReview":
                    if (!isset($_POST['review']))
                        print "{ \"Error\": \"Request not valid\" }";
                    
                    else {  
                        $review = strip_tags($_POST['review']);
                        $result = addReview($movie, $user, $review); // db result
                        if ($result)
                            print "{ \"addReview\": \"True\"}";
                        else
                            print "{ \"addReview\": \"False\"}";
                    }
                    break;

                case "deleteReview":
                    $result = deleteReview($movie, $user); // db result
                    
                    if ($result)
                        print "{ \"deleteReview\": \"True\"}";
                    else
                        print "{ \"deleteReview\": \"False\"}";
                    break;

                default:
                    print "{ \"Error\": \"Request not valid\" }";
                    break;
            }
        }
    }
?>



