<?php include("top.html") ?> 

        <script src="../js/signup.js"></script>
        <script src="../js/common.js"></script>

        <!-- Cagnazzo Christian Damiano 
            The site manages information on films and actors. 
            It allows you to search for movies and actors through different filters, 
            vote for a movie, add it to your favorites list or to 
            the see later list or add a review.
            This file represents the main signup screen -->
    </head>

    <body>
        <?php include("banner.html") ?>
            
                <div id="signupForm"> <!-- signup form -->
                    <label>Name:</label><input type="text" id="name" required><br>
                    <label>Surname:</label><input type="text" id="surname" required><br>
                    <label>Email:</label><input type="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required><br>
                    <label>Username:</label><input type="text" id="username" required><br>
                    <label>Password:</label><input type="password" id="password" required pattern="(?=^.{8,}$)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$"><br>
                    <input id="signupBtn" type="submit" value="Sign Up"><br>
                    <div class="error"></div>
                </div> <!-- end of signup form -->
    

<?php include("bottom.html") ?>