<?php include("top.html") ?>
        
        <script src="../js/movie.js"></script>
        <script src="../js/common.js"></script>

        <!-- Cagnazzo Christian Damiano 
            The site manages information on films and actors. 
            It allows you to search for movies and actors through different filters, 
            vote for a movie, add it to your favorites list or to 
            the see later list or add a review.
            This file represents the movie page -->
    </head>

    <body>
        <?php include("banner.html") ?>
            
                <div class="error"></div>

                <div id="movieContainer"> <!-- movie container div -->
                    <div id="left">
                        <div id="movieTitle"></div>
                        <!-- photo -->
                    </div>

                    <div id="right">
                        <div class="rating">
                            <input type="radio" name="rate" id="0" checked/>
                            <input type="radio" name="rate" id="1"/>
                            <label for="1"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rate" id="2" />
                            <label for="2"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rate" id="3"/>
                            <label for="3"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rate" id="4" />
                            <label for="4"><i class="fa fa-star"></i></label>
                            <input type="radio" name="rate" id="5" />
                            <label for="5"><i class="fa fa-star"></i></label> 
                        </div>
                        <div id="remove">
                            <label><i class="fa fa-remove"></i></label>
                        </div>
                        <div id="watchDiv">
                            <label><i class="fa fa-eye"></i></label>
                        </div>
                        <div id="favouriteHeart">
                            <label><i class="fa fa-heart"></i></label>
                        </div>
                        
                        <ul id="list_def">
                            <li>Genre: </li>
                            <li>Average grades: </li>
                            <li>Release date: </li>
                            <li>Movie director: </li>
                            <li>Music: </li>
                            <li>Country: </li>
                            <li>Distribution: </li>
                            <li>Production: </li>
                            <li>Length: </li>
                            <li>Screenplay: </li>
                        </ul>
                        <ul id="list_el"></ul>
                    </div>
            

                    <span class="intest">Main actors</span>
                    <div id="actorsContainer"></div>

                    <span class="intest">Descriptions</span>    
                    <div id="description"></div>

                    <span class="intest">Your review</span> 
                    <div id="review">
                        <textarea id="usReview" maxlength="100" rows="4" cols="145" placeholder="Leave here your comment about this movie ..."></textarea>
                        <input type="submit" id="confirm" value="Confirm">
                        <input type="submit" id="delete" value="Delete">
                    </div>

                    <div>
                        <span class="intest">User Reviews</span> 
                        <div id="revErr" class="error"></div>
                        <div id="allReviews"></div>
                    </div>
                

                </div> <!-- end of movie container div -->
            
<?php include("bottom.html") ?>