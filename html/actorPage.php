<?php include("top.html") ?>
        
        <script src="../js/actor.js"></script>
        <script src="../js/common.js"></script>

        <!-- Cagnazzo Christian Damiano 
            The site manages information on films and actors. 
            It allows you to search for movies and actors through different filters, 
            vote for a movie, add it to your favorites list or to 
            the see later list or add a review.
            This file represents the actor page -->
    </head>

    <body>
        <?php include("banner.html") ?>
            
                <div class="error"></div>
                
                <div id="actorContainer"> <!-- actor container div -->
                    <div id="left">
                        <!-- photo -->
                    </div>

                    <div id="right">
                        <span>Info:</span>
                            <ul id="list_def">
                                <li>Name: </li>
                                <li>Date of birth: </li>
                                <li>Place of birth: </li>
                                <li>Age: </li>
                            </ul>
                        
                        <ul id="list_el"></ul>
                    </div>

                    <div id="movieListContainer"> <!-- movie list div -->
                        <span>Movies:</span>
                        <ul id="movieList">
                        </ul>
                    </div> <!-- end of movie list div -->
                    
                    <span class="intest">Descriptions</span>    
                    <div id="description"></div>
                </div> <!-- end of actor container div -->
            
<?php include("bottom.html") ?>