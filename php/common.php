<?php

    if(!isset($_SESSION)) {session_start();}

    # Connect to db
    function dbConnect(){
        $dsn = 'mysql:dbname=project;host=localhost:3306';
        $db = new PDO($dsn, 'root', '');
        return $db;
    }

    # Check password user
    function checkPassword($username, $password){
        try {
            $db = dbconnect();
            $username = $db->quote($username);
            $rows = $db->query("SELECT password FROM Utente WHERE Username = $username");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        $row = $rows->fetch(); // only one user
        if ($row) { // check password  
            return $row['password'] == md5($password);
        } else {
            return false; // user not found
        }
    }

    # Search user
    function ifUserExists($username){
        try {
            $db = dbconnect();
            $username = $db->quote($username);
            $rows = $db->query("SELECT * FROM Utente WHERE Username = $username");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        $row = $rows->fetch();
        if ($row) { 
            return true;
        } else {
            return false; // user not found
        }
    }

    # Search email
    function ifEmailExists($email){
        try {
            $db = dbconnect();
            $email = $db->quote($email);
            $rows = $db->query("SELECT * FROM Utente WHERE Email = $email");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        $row = $rows->fetch();
        if ($row) { 
            return true;
        } else {
            return false; // email not found
        }
    }

    # Insert user into db
    function insertUser($username, $password, $name, $surname, $email){
        try {
            $db = dbconnect();
            $username = $db->quote($username);
            $password = $db->quote($password);
            $name = $db->quote($name);
            $surname = $db->quote($surname);
            $email = $db->quote($email);
            return $db->exec("INSERT INTO Utente VALUES($username,$password,$name,$surname,$email)");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
    }

    # Check if user is logged
    function userIsLogged() {
        if (isset($_SESSION["name"])) 
            return true;
        else
            return false;
    }

    # This function returns the title and photo of all movies 
    # of the type passed as parameter (featured, top or favorites) in a set order. 
    # If the limit parameter is set to true, 
    # only the first 5 are returned (for homepage)
    function getMovieList($user, $type, $limit){
        try {

            $db = dbconnect();
            $user = $db->quote($user);
        
            switch ($type) {

                case "FEATURED":
                    $query = "SELECT Titolo, Foto 
                                FROM Film WHERE MONTH(DataUscita) = MONTH(curdate()) 
                                ORDER BY DAY(DataUscita) DESC";
                    if ($limit) 
                        $query .= " LIMIT 5";
                    break;

                case "TOP":
                    $query = "SELECT Titolo, Foto 
                                FROM Film 
                                ORDER BY MediaVoti DESC";
                    if ($limit) 
                        $query .= " LIMIT 5";
                    break;

                case "TOWATCH":
                    $user = $db->quote($_SESSION['name']);
                    $query = "SELECT F.Titolo, F.Foto 
                                FROM Film F JOIN FilmDaVedere FF ON F.Titolo=FF.Titolo 
                                WHERE FF.Utente = $user 
                                ORDER BY F.MediaVoti DESC";
                    break;

                case "FAVOURITES":
                    $query = "SELECT F.Titolo, F.Foto 
                                FROM Film F JOIN FilmFavorito FF ON F.Titolo=FF.Film
                                WHERE FF.Utente = $user
                                ORDER BY F.MediaVoti DESC";
                    if ($limit) 
                        $query .= " LIMIT 5";       
                    break;
            }

            $rows = $db->query($query);

        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        return $rows->fetchAll();
    }

    # This function returns all the information of 
    # the movie passed as a parameter
    function getMovieInfo($title){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $rows = $db->query("SELECT Film.*, COALESCE(MediaVoti,0) as MV, Regista.Nome, Regista.Cognome
                                FROM Film JOIN Regista ON Film.Regista=Regista.Codice
                                WHERE Film.Titolo = $title");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        return $rows->fetch();
    }

    # This function returns all the actors of 
    # the movie passed as a parameter
    function getActorsOfMovie($title){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $rows = $db->query("SELECT Attore, Personaggio, Foto
                                FROM AttoreFilm AF JOIN Attore A ON AF.Attore=A.Codice
                                WHERE Film = $title");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        return $rows->fetchAll();
    }

    # This function returns, if it exists, the vote assigned to a film by a user
    function getRate($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $rows = $db->query("SELECT Punteggio
                                FROM VotoFilm
                                WHERE Film = $title AND Utente = $user");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        $row = $rows->fetch(); // only one vote
        if ($row) { 
            return $row['Punteggio'];
        } else {
            return null; // vote not found
        }
    }

    # This function returns whether a movie is part of a user's favorites
    function isFavourite($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $rows = $db->query("SELECT *
                                FROM FilmFavorito
                                WHERE Film = $title AND Utente = $user");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        $row = $rows->fetch(); // only one prefer
        if ($row) { 
            return true;
        } else {
            return false; // not prefer
        }
    }

    # This function returns whether a movie is part of a user's watch list
    function isToWatch($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $rows = $db->query("SELECT *
                                FROM FilmDaVedere
                                WHERE Titolo = $title AND Utente = $user");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        $row = $rows->fetch(); // only one
        if ($row) { 
            return true;
        } else {
            return false; 
        }
    }

    # This function adds a movie to a user's favorites
    function addPrefer($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $result = $db->exec("REPLACE INTO FilmFavorito
                        VALUES ($title, $user)");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        return $result;
    }

    # This function removes a movie to a user's favorites
    function removePrefer($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $result = $db->exec("DELETE FROM FilmFavorito
                        WHERE Film=$title AND UTENTE=$user");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }  
        return $result;
    }

    # This function removes a rate's movie
    function removeRate($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $result = $db->exec("DELETE FROM VotoFilm
                        WHERE Film=$title AND UTENTE=$user");
            // update average 
            if ($result)
                $db->exec("UPDATE Film SET MediaVoti=
                            (SELECT avg(punteggio) 
                            FROM VotoFilm where Film=$title) 
                            WHERE Titolo=$title");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }  
        return $result;
    }

    # This function adds / replaces a movie grade
    function addRate($title, $user, $rate){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $rate = $db->quote($rate);
            $result = $db->query("REPLACE INTO VotoFilm 
                                VALUES (default, $user, $title, $rate)");
            // update average 
            if ($result)
                $db->exec("UPDATE Film SET MediaVoti=
                            (SELECT avg(punteggio) 
                            FROM VotoFilm where Film=$title) 
                            WHERE Titolo=$title");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }  
        return $result;
    }

    # This function returns all the information of 
    # the actor passed as a parameter
    function getActorInfo($actor){
        try {
            $db = dbconnect();
            $actor = $db->quote($actor);
            $rows = $db->query("SELECT *
                                FROM Attore
                                WHERE Codice = $actor");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        return $rows->fetch();
    }

    # This function returns the id of  
    # the actor name and surname passed as a parameter
    function getActorId($name, $surname){
        try {
            $db = dbconnect();
            $name .= "%";
            $name = $db->quote($name);
            $surname = $db->quote($surname);
            $rows = $db->query("SELECT Codice FROM Attore
                                WHERE Nome LIKE $name and Cognome = $surname"); 
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        return $rows->fetch();
    }

    # This function returns all the movies of 
    # the actor passed as a parameter
    function getMoviesActor($actor){
        try {
            $db = dbconnect();
            $actor = $db->quote($actor);
            $rows = $db->query("SELECT Film
                                FROM AttoreFilm
                                WHERE Attore = $actor");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        return $rows->fetchAll();
    }

    # This function adds a movie to watch list
    function addToWatch($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $result = $db->exec("INSERT INTO FilmDaVedere 
                                VALUES ($title, $user)");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }  
        return $result;
    }

    # This function removes a rate's movie
    function removeToWatch($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $result = $db->exec("DELETE FROM FilmDaVedere
                        WHERE Titolo=$title AND UTENTE=$user");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }  
        return $result;
    }

    # This function return user's review of a movie
    function getUserReview($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $result = $db->query("SELECT Recensione FROM Recensioni
                        WHERE Film=$title AND UTENTE=$user");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }  
        $row = $result->fetch(); // only one review
        if ($row) { 
            return $row['Recensione'];
        } else {
            return null; // not found
        }
    }

    # This function adds a review about a movie
    function addReview($title, $user, $review){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $review = $db->quote($review);
            $result = $db->query("INSERT INTO Recensioni 
                                VALUES ($title, $user, $review)");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }  
        return $result;
    }

    # This function deletes the review of a movie
    function deleteReview($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $result = $db->exec("DELETE FROM Recensioni 
                                WHERE Film=$title AND UTENTE=$user");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }  
        return $result;
    }

    # This function returns all the movie's reviews
    function getAllReviews($title, $user){
        try {
            $db = dbconnect();
            $title = $db->quote($title);
            $user = $db->quote($user);
            $rows = $db->query("SELECT *
                                FROM Recensioni
                                WHERE Film = $title AND Utente != $user");
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }
        return $rows->fetchAll();
    }

    # Function to return movie list by a filter search
    function filterSearch($user, $genre, $show, $order, $minY, $maxY ){
        try {
            $db = dbconnect();
            $user = $db->quote($user);
        
            $where = "WHERE 1=1";
            $ord = "";

            if ($genre != "---")
                $where .= " AND Film.Genere = '$genre'  ";

            if ($order != "---")
                $ord = " ORDER BY $order";

            if ($minY != "")
                $where .= " AND YEAR(DataUscita) >= ".$db->quote($minY);

            if ($maxY != "")
                $where .= " AND YEAR(DataUscita) <= ".$db->quote($maxY);

            switch ($show){
                case "A":
                    break;
                case "MF":
                    $where .= " AND Film.Titolo IN (
                        SELECT F.Titolo
                        FROM FilmFavorito FF JOIN Film F ON FF.Film=F.Titolo
                        WHERE FF.Utente = $user
                    )";
                    break;
                case "NMF":  
                    $where .= " AND Film.Titolo NOT IN (
                        SELECT F.Titolo
                        FROM FilmFavorito FF JOIN Film F ON FF.Film=F.Titolo
                        WHERE FF.Utente = $user
                    )";  
                    break;  
            }

            $query ="SELECT Film.Titolo, Film.Foto FROM Film $where $ord";
            $rows = $db->query($query);
        } catch (PDOException $e) {
            die('Database error: ' . $e->getMessage());
        }  
        return $rows->fetchAll();
    }
?>