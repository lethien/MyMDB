<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Movie.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Validation.class.php");
require_once("inc/Utility/RestClient.class.php");
require_once("inc/Utility/Page.class.php");

LoginManager::verifyUserLoggedin();

// Post request message to show
$message = "";
$messageSeverity = "error";

// Message for each field
$validateMessages = array();

// What to render
$toRender = "form";

// Movie to render
$movie = new Movie();

// Handle request
if(isset($_GET['movieid'])) {

} else {    
    if(isset($_POST['action']) && $_POST['action'] == "add") {
        $validateMessages = Validation::validateMovieForm($_POST);

        if(count($validateMessages) > 0) {
            $movie->setTitle($_POST['title']);
            $movie->setPosterURL($_POST['poster']);
            $movie->setSummary($_POST['summary']);
            $movie->setRuntime($_POST['runtime']);
            $movie->setGenres($_POST['genres']);
            $movie->setCrew($_POST['crew']);
            $movie->setDirectors($_POST['directors']);
            $movie->setAwards($_POST['awards']);          
        } else {
            $_POST['createdBy'] = LoginManager::getLoggedinUser()->getUserID();
            $newMovieId = json_decode(RestClient::call(MOVIE_API, "POST", $_POST));

            if($newMovieId != null && $newMovieId > 0) {
                $message = "Movie ".$_POST['title'].' added! You can continue to add another movie.';   
                $messageSeverity = "success";            
            } else {
                $movie->setTitle($_POST['title']);
                $movie->setPosterURL($_POST['poster']);
                $movie->setSummary($_POST['summary']);
                $movie->setRuntime($_POST['runtime']);
                $movie->setGenres($_POST['genres']);
                $movie->setCrew($_POST['crew']);
                $movie->setDirectors($_POST['directors']);
                $movie->setAwards($_POST['awards']);

                $message = "Movie ".$_POST['title'].' not added! Please try again later.';   
            }
        }
    }
}

// Page header
Page::$title = "MyMDB - Movie Info";
Page::header();
Page::page_head(true);

// Render page content
if($toRender == "form") {
    Page::render_movie_form($movie, $validateMessages, $message, $messageSeverity);
}

// Page footer
Page::footer();


?>