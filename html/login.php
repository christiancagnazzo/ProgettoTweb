<?php include("top.html") ?>
    
        <script src="../js/login.js"></script>
        <script src="../js/common.js"></script>

    <!-- Cagnazzo Christian Damiano 
        The site manages information on films and actors. 
        It allows you to search for movies and actors through different filters, 
        vote for a movie, add it to your favorites list or to 
        the see later list or add a review.
        This file represents the main login screen -->
    </head>

    <body>
        <?php include("banner.html") ?>
        
                <div id="loginForm"> <!-- login div -->
                    Username<br><input type="text" id="username" required><br>
                    Password<br><input type="password" id="password" required><br>
                    <input id="loginBtn" type="submit" value="Login"><br>
                    <a href="signup.php">Or Sign Up</a><br>
                    <div class="error"></div>
                </div> <!-- end of login div -->
        

<?php include("bottom.html") ?>