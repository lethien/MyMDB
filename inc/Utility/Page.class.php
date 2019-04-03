<?php

class Page {
    // Title property
    public static $title = "Set your title!";

    public static function header() {
        ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>

                <!-- Basic Page Needs
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <meta charset="utf-8">
                <title><?php echo self::$title; ?></title>
                <meta name="description" content="">
                <meta name="author" content="">

                <!-- Mobile Specific Metas
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <meta name="viewport" content="width=device-width, initial-scale=1">

                <!-- FONT
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

                <!-- CSS
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <link rel="stylesheet" href="css/normalize.css">
                <link rel="stylesheet" href="css/skeleton.css">

                <!-- Favicon
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <link rel="icon" type="image/png" href="images/favicon.png">

            </head>
            <body>
                <!-- No Script Warning
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <noscript>Your browser does not support JavaScript! Some features may not work properly!</noscript>

                <!-- Primary Page Layout
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
                <div class="container">                                                    
        <?php
    }

    // Render page header which include logo, user links and search bar
    public static function page_head($isLoggedin = false) {
        ?>
            <div class="row">
                <!-- Page main logo, also link to home page -->
                <div class="one-half column" style="margin-top: 50px">  
                    <a href="<?php echo HOME_PAGE;?>" style="color: black;text-decoration: none;">                                      
                        <h3><img src="images/pageicon.png" 
                                    style="vertical-align: middle;height: 75px;margin-right: 10px;" />
                            My Movie DataBase
                        </h3>
                    </a>
                </div>
                <div class="one-half column" style="margin-top: 50px">  
                <!-- If user has logged in, show Welcome user message along with links for user detail and logout -->                                      
                    <?php
                        if($isLoggedin) {
                            ?>
                                <p style="text-align: right;margin: 0;padding: 20px 0;">
                                    Welcome <a href="UserDetail.php"><?php if(LoginManager::getLoggedinUser() != null) echo LoginManager::getLoggedinUser()->getUserName(); ?></a>
                                    /
                                    <a href="Logout.php">Logout</a>
                                </p>                                
                            <?php
                        }
                    ?>
                </div>
            </div>

            <!-- If user has logged in, show movie search bar --> 
            <?php
                if($isLoggedin) {
                    ?>
                        <div class="row" style="padding: 1.5rem 3.5rem 0 3.5rem;background-color: #FFC342;border-radius: 50px;">
                            <div class="three columns">
                                <a href="MoviesList.php"><h5>View all Movies</h5></a>
                            </div>
                            <div class="one columns">
                                <h5>Or</h5>
                            </div>
                            <div class="eight columns">
                                <form action="MoviesList.php" method="POST">                                                
                                    <input class="button-primary u-pull-right" type="submit" value="Search">
                                    <input type="text" name="search" placeholder="Search Movie Title, Description, ..." 
                                        class="u-pull-right eight columns"
                                        value="<?php if(isset($_POST['search'])) echo $_POST['search']; ?>" />
                                </form>
                            </div>
                        </div>
                    <?php
                }
            ?>
        <?php
    }

    public static function footer() {
        ?>
                </div>

                <script>
                    // Util method for delete and edit links in table
                    function setActionAndCustIdForTable(action, custId) {
                        document.getElementById("table_action").value = action;
                        document.getElementById("table_cust_id").value = custId;
                    }
                </script>
                <!-- End Document
                –––––––––––––––––––––––––––––––––––––––––––––––––– -->
            </body>
            </html>
        <?php
    }

    // Render content of Authenticate.php
    public static function authenticateForm($validateMessages) {
        echo '<div class="row">';
        self::loginform($validateMessages);
        echo '<div class="two columns"><p></p></div>';
        self::registerForm($validateMessages);
        echo '</div>';
    }

    // Render Login form
    public static function loginform($validateMessages) {        
        ?>
            <div class="five columns">
                <h4>Already a user? Login</h4>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <input type="hidden" name="action" value="login" >                   
                    <?php
                        self::renderFormInputField("username", "User Name", 
                            isset($_POST['username']) ? $_POST['username'] : "", 
                            isset($validateMessages['username']) ? $validateMessages['username'] : "");                        
                        self::renderFormInputField("password", "Password", 
                            "", 
                            isset($validateMessages['password']) ? $validateMessages['password'] : "", "password");                        
                    ?>                                                 
                    <input class="button-primary u-pull-right" type="submit" value="Login">
                </form>
            </div>
        <?php
    }

    // Render Register form
    public static function registerForm($validateMessages) {  
        ?>
            <div class="five columns">
                <h4>New to MyMDB? Register</h4>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <input type="hidden" name="action" value="register" >                    
                    <?php
                        self::renderFormInputField("newusername", "User Name", 
                            isset($_POST['newusername']) ? $_POST['newusername'] : "",
                            isset($validateMessages['newusername']) ? $validateMessages['newusername'] : "");
                        self::renderFormInputField("newemail", "Email", 
                            isset($_POST['newemail']) ? $_POST['newemail'] : "", 
                            isset($validateMessages['newemail']) ? $validateMessages['newemail'] : "", "email");
                        self::renderFormInputField("newpassword", "Password", 
                            "", 
                            isset($validateMessages['newpassword']) ? $validateMessages['newpassword'] : "", "password");
                        self::renderFormInputField("newconfirmpassword", "Confirm Password", 
                            "", 
                            isset($validateMessages['newconfirmpassword']) ? $validateMessages['newconfirmpassword'] : "", "password");
                    ?>
                    <input class="button-primary u-pull-right" type="submit" value="Register">
                </form>
            </div>
        <?php
    }

    // Utility method to render form input field
    public static function renderFormInputField($fieldID, $fieldLabel, $fieldDefaultValue, $fieldValidation, $fieldType = "text") {
        ?>
            <div class="row">
                <div class="u-full-width">
                    <label for="<?php echo $fieldID; ?>"><?php echo $fieldLabel; ?>: </label>
                    <input class="u-full-width" type="<?php echo $fieldType; ?>"
                    <?php
                        // If there is a validation issue on this input field, change background-color and show message as placeholder
                        if($fieldValidation != "") {
                            echo ' style="border-color: #721c24;background-color: #f8d7da" ';
                            echo ' placeholder="'. $fieldValidation .'" ';
                        } 
                        // If there is no validation issue on this input field, set value as default value
                        else {
                            echo ' value="'. $fieldDefaultValue .'" ';
                        }
                    ?>
                            id="<?php echo $fieldID; ?>" name="<?php echo $fieldID; ?>" >
                </div>
            </div>
        <?php
    }

    // Show message (can be error or success message)
    public static function messagearea($message = null, $severity = "error") {        
        ?>
            <div class="row">
                <div class="one-full column">
                    <?php
                        if(is_null($message) || $message == "") {
                            // No message
                            echo '<p style="padding: 10px 25px;border-radius: 10px;">&nbsp;</p>';
                        } else {
                            // Display message with style based on severity 
                            echo '<p style="padding: 10px 25px;border-radius: 10px;';
                            if($severity == "success") {
                                echo 'color: #155724;background-color: #d4edda;border-color: #c3e6cb;';
                            } else if($severity == "error") {
                                echo 'color: #721c24;background-color: #f8d7da;border-color: #f5c6cb;';
                            }
                            echo '">';
    
                            echo $message;

                            echo '</p>';
                        }
                    ?>
                </div>
            </div>
        <?php
    }

    // Render content of MyMDB.php
    public static function render_homepage($homePageStat, $topRatingMovies, $topReviewedMovies) {
        ?>
            <!-- MyMDB statistic infos -->
            <div class="row" style="margin-top: 30px">
                <div class="one-full column">
                    <h4>MyMDB information:</h4>
                    <p>Number of movies: <?php echo $homePageStat->moviesCount; ?></p>
                    <p>Number of users: <?php echo $homePageStat->usersCount; ?></p>
                    <p>Number of reviews: <?php echo $homePageStat->reviewsCount; ?></p>
                </div>
            </div>

            <!-- MyMDB top rating movies -->
            <div class="row" style="margin-top: 30px">
                <div class="one-full column">
                    <h4>Highest Rating:</h4>
                </div>
            </div>
            <?php 
                self::render_movies_rows($topRatingMovies);
            ?>

            <!-- MyMDB most reviewed movies -->
            <div class="row" style="margin-top: 30px">
                <div class="one-full column">
                    <h4>Most Reviewed:</h4>
                </div>
            </div>
            <?php 
                self::render_movies_rows($topReviewedMovies);
            ?>
        <?php
    }

    //Render content of MoviesList.php
    public static function render_movie_list($movies) {
        ?>
            <div class="row" style="margin-top: 30px">
                <div class="one-full column">
                    <h4>
                        Movie List - <?php echo count($movies) ?> results<?php if(isset($_POST['search'])) echo ' - Search term: '.$_POST['search']; ?>
                        <a href="MovieInfo.php" class="button-primary u-pull-right">Add Movie</a>
                    </h4>
                    
                </div>                
            </div>

            <?php 
                self::render_movies_rows($movies);
            ?>
            
        <?php
    }

    //Render content of MovieInfo.php in case of a GET request
    public static function render_movie_detail($movie, $review, $reviewMessage, $reviewMessageSeverity) {
        ?>
            <!-- Movie Infos Fields-->
            <div class="row" style="margin-top: 30px">
                <div class="one-full column">
                    <img style="float: left;height: 250px;width: 150px;margin-right: 20px;" 
                            src="<?php echo $movie->getPosterURL(); ?>"
                            alt="<?php echo $movie->getTitle(); ?> Poster"
                            title="<?php echo $movie->getTitle(); ?> Poster" />
                    <h4>
                        <?php echo $movie->getTitle(); ?>                                                        
                        <a href="MovieInfo.php?movieid=<?php echo $movie->getMovieID(); ?>&action=edit" class="button-primary u-pull-right">Edit Movie</a>
                    </h4> 
                    <p><b>Runtime:</b> <?php echo $movie->getRuntime(); ?> minutes</p>
                    <p><b>Genres:</b> <?php echo $movie->getGenres(); ?></p>
                    <p><b>Reviews:</b> <?php echo $movie->getReviewNumber(); ?></p>
                    <p><b>Rating:</b> <?php echo $movie->getRatingFormated(); ?></p>
                </div>  
            </div>
            <div class="row" style="margin-top: 30px"> 
                <div class="one-full column">
                    <p><b>Directors:</b> <?php echo $movie->getDirectors(); ?></p>
                    <p><b>Cast:</b> <?php echo $movie->getCrew(); ?></p>
                    <p><b>Summary:</b> <?php echo $movie->getSummary(); ?></p>
                    <p><b>Awards:</b> <?php echo $movie->getAwards(); ?></p>
                </div>             
            </div>
            <!-- Current User's review on this movie -->
            <div class="row" style="margin-top: 30px"> 
                <div class="one-full column">
                    <?php
                        if($review->getRating() > 0) { // if user already reviewed this movie, show review
                    ?>                        
                        <form id="delete_review_form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <b>Your Review: <?php echo $review->getRating(); ?> Stars.</b>
                            <input type="hidden" name="userID" value="<?php echo $review->getUserID(); ?>" >
                            <input type="hidden" name="movieID" value="<?php echo $review->getMovieID(); ?>" >
                            <input type="hidden" name="action" value="delete_review" >
                            <a style="float:right;" href="javascript:document.getElementById('delete_review_form').submit();">Delete Review</a>                        
                        </form>
                        <p><?php echo $review->getReview(); ?></p>                        
                    <?php
                        } else { // if user haven't reviewed this movie, show form for user to leave a review
                    ?>                        
                        <div class="u-full-width">
                            <b>Leave a Review:</b>
                            <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                                <input type="hidden" name="userID" value="<?php echo $review->getUserID(); ?>" >
                                <input type="hidden" name="movieID" value="<?php echo $review->getMovieID(); ?>" >
                                <input type="hidden" name="action" value="review" >
                                <div class="u-full-width">
                                    <b>Rating: </b>
                                    <input type="radio" name="rating" value="1" style="margin-left: 20px;"> 1
                                    <input type="radio" name="rating" value="2" style="margin-left: 20px;"> 2
                                    <input type="radio" name="rating" value="3" style="margin-left: 20px;" checked> 3
                                    <input type="radio" name="rating" value="4" style="margin-left: 20px;"> 4
                                    <input type="radio" name="rating" value="5" style="margin-left: 20px;"> 5
                                </div>
                                <div class="u-full-width">
                                    <label for="review">Review: </label>
                                    
                                    <textarea rows = "10" cols = "50" class="u-full-width" name="review"></textarea>
                                </div>
                                <div class="u-full-width">
                                    <input class="button-primary u-pull-right" type="submit" value="Leave Review">
                                </div>
                                <div class="u-full-width">
                                    <input class="button-primary u-pull-right" type="submit" value="Leave Review">
                                </div>
                            </form>
                        </div>
                    <?php
                        }
                    ?>
                </div>             
            </div>
            <?php
            // If there is a message for review form, show here
            if($reviewMessage != null && $reviewMessage != "") {
                self::messagearea($reviewMessage, $reviewMessageSeverity);
            }
            ?>
        <?php
    }

    // Utility method to render list of movies in rows of movie cards
    private static function render_movies_rows($movies) {         
        if (count($movies) > 0) {                                
            for ($i=0; $i<count($movies); $i++) {
                // Since each movie card takes half width of row, render 2 movie cards for each row
                if($i % 2 == 0) echo '<div class="row" style="margin-top: 30px">';
                $movie = $movies[$i];
                self::render_movie_card($movie);
                if($i % 2 != 0) echo '</div>';
            }
        } else {
            self::messagearea("There is no movie to display.");
        }         
    }

    // Utility method to render movie brief info in card form
    private static function render_movie_card($movie) {
        ?>
            <div class="one-half column" style="padding: 10px;border: 1px solid lightgray;">
                <div class="one-full column">
                    <img style="float: left;height: 250px;width: 150px;margin-right: 20px;" 
                            src="<?php echo $movie->getPosterURL(); ?>" 
                            alt="<?php echo $movie->getTitle(); ?> Poster"
                            title="<?php echo $movie->getTitle(); ?> Poster" />
                    <p><b>
                        <a href="MovieInfo.php?movieid=<?php echo $movie->getMovieID(); ?>">
                            <?php echo $movie->getTitle(); ?>
                        </a>
                    </b></p>
                    <p><b>Runtime:</b> <?php echo $movie->getRuntime(); ?> minutes</p>
                    <p><b>Genres:</b> <?php echo $movie->getGenres(); ?></p>
                    <p><b>Rating:</b> <?php echo $movie->getRatingFormated(); ?><?php if($movie->getReviewNumber() > 1) echo ' ('.$movie->getReviewNumber().' Reviews)'; ?></p>
                    <p><b>Cast:</b> <?php echo $movie->getCrew(); ?></p>
                </div>
            </div>
        <?php
    }

    // Render content of UserDetail.php
    public static function render_user_detail($userDetailStat, $topRatingMovies) {
        ?>
            <div class="row" style="margin-top: 30px">
                <!-- User infos -->
                <div class="one-half column">
                    <h4>User information:</h4>
                    <p>User ID: <?php echo LoginManager::getLoggedinUser()->getUserID(); ?></p>
                    <p>User Name: <?php echo LoginManager::getLoggedinUser()->getUserName(); ?></p>
                    <p>Email: <?php echo LoginManager::getLoggedinUser()->getEmail(); ?></p>
                </div>

                <!-- User Activity Statistic -->
                <div class="one-half column">
                    <h4>User Activity:</h4>
                    <p>Movies Created: <?php echo $userDetailStat->moviesCount; ?></p>
                    <p>Reviewed: <?php echo $userDetailStat->reviewsCount; ?></p>
                </div>
            </div> 

            <!-- User favorite movies -->           
            <div class="row" style="margin-top: 30px">
                <div class="one-full column">
                    <h4>Favorite Movies:</h4>
                </div>
            </div>
            <?php 
                self::render_movies_rows($topRatingMovies);
            ?>
        <?php
    }

    // Render content of MovieInfo.php in case of Add or Edit movie
    public static function render_movie_form($movie, $validateMessages, $message, $messageSeverity) {
        if($movie != null && $movie->getMovieID() > 0) { // This is an existed movie
            $formtitle = "Edit Movie - ID: ".$movie->getMovieID();
            $submitbutton = "Update";
            $formaction = "update";
        } else { // This is a new movie
            $formtitle = "Add Movie";
            $submitbutton = "Add";
            $formaction = "add";
        }

        ?>
            <div class="row" style="margin-top: 30px">
                <div class="one-full column">
                    <h4>
                        <?php echo $formtitle; ?>
                        <?php
                            if($movie != null && $movie->getMovieID() > 0) {
                                echo '<a href="MovieInfo.php?movieid='.$movie->getMovieID().'" class="button-primary u-pull-right">Cancel Edit</a>';
                            }                        
                        ?>
                    </h4>
                    <?php self::messagearea($message, $messageSeverity); ?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                        <input type="hidden" name="movieid" value="<?php echo $movie->getMovieID(); ?>" >
                        <input type="hidden" name="action" value="<?php echo $formaction; ?>" >
                        <?php
                            self::renderFormInputField("title", "Title", 
                                $movie->getTitle(),
                                isset($validateMessages['title']) ? $validateMessages['title'] : "");
                            self::renderFormInputField("poster", "Poster URL", 
                                $movie->getPosterURL(),
                                isset($validateMessages['poster']) ? $validateMessages['poster'] : "");
                            self::renderFormInputField("summary", "Plot Summary", 
                                $movie->getSummary(),
                                isset($validateMessages['summary']) ? $validateMessages['summary'] : "");
                            self::renderFormInputField("runtime", "Runtime (in minutes)", 
                                $movie->getRuntime(), 
                                isset($validateMessages['runtime']) ? $validateMessages['runtime'] : "", "number");
                            self::renderFormInputField("genres", "Genres", 
                                $movie->getGenres(),
                                isset($validateMessages['genres']) ? $validateMessages['genres'] : "");
                            self::renderFormInputField("crew", "Crews", 
                                $movie->getCrew(),
                                isset($validateMessages['crew']) ? $validateMessages['crew'] : "");
                            self::renderFormInputField("directors", "Directors", 
                                $movie->getDirectors(),
                                isset($validateMessages['directors']) ? $validateMessages['directors'] : "");
                            self::renderFormInputField("awards", "Awards", 
                                $movie->getAwards(),
                                isset($validateMessages['awards']) ? $validateMessages['awards'] : "");
                        ?>
                        <input class="button-primary u-pull-right" type="reset" value="Reset" style="margin-left: 30px">
                        <input class="button-primary u-pull-right" type="submit" value="<?php echo $submitbutton; ?>">
                    </form>
                </div>
            </div>
        <?php
    }
}

?>
