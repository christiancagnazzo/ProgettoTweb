<?php include("top.html"); ?> 

        <script src="../js/homepage.js"></script>
        <script src="../js/common.js"></script>
        <script src="../js/dragdrop.js"></script>

        <!-- Cagnazzo Christian Damiano 
            The site manages information on films and actors. 
            It allows you to search for movies and actors through different filters, 
            vote for a movie, add it to your favorites list or to 
            the see later list or add a review.
            This file represents the homepage screen -->
    </head>
    
    <body>
        <?php include("banner.html"); ?>
        
                <div> <!-- homepage div -->

                    <div id="today"> <!-- today featured movie div -->
                
                        <div class="intestation">
                            <span class="type">
                                Featured Today
                            </span>
                            <span class="all" id="FEATURED">
                                >
                            </span>
                        </div>
                        <div id="imgToday"></div>          
                    
                    </div> <!-- end of today featured movie div -->

                    <div id="top"> <!--top movie div -->

                        <div class="intestation">
                            <span class="type">
                                Top Today
                            </span>
                            <span class="all" id="TOP">
                                >
                            </span>
                        </div>
                        <div id="imgTop"></div> 
            
                    </div> <!-- end of top movie div -->

                    <div id="favourite"> <!--favourites movie div -->

                        <div class="intestation">
                            <span class="type">
                                Your Favourites
                            </span>
                            <span class="all" id="FAVOURITES">
                                >
                            </span>
                        </div>
                        <div id="imgFavourites"></div> 

                    </div>  <!-- end of favourites movie div -->

                </div> <!-- end of homepage div -->

                <div class="error"></div>
            

<?php include("bottom.html"); ?>
    