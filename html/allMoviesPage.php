<?php include("top.html") ?>
    
        <script src="../js/allMovies.js"></script>
        <script src="../js/common.js"></script>
        <script src="../js/dragdrop.js"></script>

        <!-- Cagnazzo Christian Damiano 
            The site manages information on films and actors. 
            It allows you to search for movies and actors through different filters, 
            vote for a movie, add it to your favorites list or to 
            the see later list or add a review.
            This file represents the all movie list page -->
    </head>

    <body>
        <?php include("banner.html") ?>
        
                <span class="titleType" id="FEATURED">FEATURED</span>
                <span class="titleType" id="TOP">TOP</span>
                <span class="titleType" id="FAVOURITES">FAVOURITES</span>
                <span class="titleType" id="TOWATCH">TO WATCH</span>
                <span class="titleType" id="ADVANCED">ADVANCED SEARCH</span>

                <div id="advancedForm">  <!-- filter search div -->
                    <span id="filter"> - Click hear to hide or show filters - </span>
                    <fieldset>
                        <label>Genre:</label>
                        <select id="genre">
                            <option id="selectGenre" selected="selected">---</option>
                            <option>Drama</option>
                            <option>Comedy</option>
                            <option>Action</option>
                            <option>Fantasy</option>
                            <option>Comic</option> 
                        </select><br>

                        <label>Show:</label>
                        <input type="radio" name="show" id="all" value="A" checked><label for="all">All</label>
                        <input type="radio" name="show" id="myF" value="MF"><label for="myF">In my favourites</label>
                        <input type="radio" name="show" id="notMyF" value="NMF"><label for="notMyF">Not in my favourites</label><br>   
                    
                        <label>Order by:</label>
                        <select id="order">
                            <option selected="selected">---</option>
                            <option value="Titolo ASC">Title &#8593;</option>
                            <option value="Titolo DESC">Title &#8595;</option>
                            <option value="MediaVoti ASC">Grade &#8593;</option>
                            <option value="MediaVoti DESC">Grade &#8595;</option>
                            <option value="DataUscita ASC">Date &#8593;</option>
                            <option value="DataUscita DESC">Date &#8595;</option>
                        </select><br>
                    
                        <label>Realease date:</label><span>From</span><input type="text" id="min" size="6" maxlength="4" placeholder="year min"> 
                        <span>to</span><input type="text" id="max" size="6" maxlength="4" placeholder="year max"><br>
                        <input id="subFilter" type="submit" value="Confirm">
                    </fieldset>
                </div> <!-- end of filter search div -->

                <div class="error"></div>
                <div id=allContainer></div> 

<?php include("bottom.html") ?>