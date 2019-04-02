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
$movie->setMovieID(0);
$movie->setTitle("");
$movie->setPosterURL("");
$movie->setSummary("");
$movie->setRuntime(0);
$movie->setGenres("");
$movie->setCrew("");
$movie->setDirectors("");
$movie->setAwards("");
$movie->setCreatedBy(0);

// Handle request
if(isset($_GET['movieid'])) {
    $jRequestedMovie = json_decode(RestClient::call(MOVIE_API, "GET", $_GET));
    if($jRequestedMovie != null) {
        $movie->setMovieID($jRequestedMovie->MovieID);
        $movie->setTitle($jRequestedMovie->Title);
        $movie->setPosterURL($jRequestedMovie->Poster);
        $movie->setSummary($jRequestedMovie->PlotSummary);
        $movie->setRuntime($jRequestedMovie->Runtime);
        $movie->setGenres($jRequestedMovie->Genres);
        $movie->setCrew($jRequestedMovie->Crew);
        $movie->setDirectors($jRequestedMovie->Directors);
        $movie->setAwards($jRequestedMovie->Awards);
        $movie->setCreatedBy($jRequestedMovie->CreatedBy);

        if(isset($_GET['action']) && $_GET['action'] == "edit") {
            // Render edit movie form
        } else {
            // Render movie detail 
            $toRender = "detail";
        }
    } else {
        $message = "Can't the requested Movie. You can add it here.";
    }    
} else {    
    $rePopulateForm = true;

    if(isset($_POST['action']) && $_POST['action'] == "add") {
        // Add new movie
        $validateMessages = Validation::validateMovieForm($_POST);

        if(count($validateMessages) == 0) {
            $_POST['createdBy'] = LoginManager::getLoggedinUser()->getUserID();
            $newMovieId = json_decode(RestClient::call(MOVIE_API, "POST", $_POST));

            if($newMovieId != null && $newMovieId > 0) {
                $message = "Movie ".$_POST['title'].' added! You can continue to add another movie.';   
                $messageSeverity = "success";   
                $rePopulateForm = false;         
            } else {                
                $message = "Movie ".$_POST['title'].' not added! Please try again later.';   
            }
        }
    } else if(isset($_POST['action']) && $_POST['action'] == "update") {
        // Update movie
        $validateMessages = Validation::validateMovieForm($_POST);

        if(count($validateMessages) == 0) {
            $success = json_decode(RestClient::call(MOVIE_API, "PUT", $_POST));

            if($success) {
                $message = "Movie updated!";
                $messageSeverity = "success";                            
            } else {                
                $message = "Movie ".$_POST['title'].' not updated! Please try changing some fields or try again later.';   
            }
        }
    }

    if($rePopulateForm) {
        $movie->setMovieID($_POST['movieid']);
        $movie->setTitle($_POST['title']);
        $movie->setPosterURL($_POST['poster']);
        $movie->setSummary($_POST['summary']);
        $movie->setRuntime($_POST['runtime']);
        $movie->setGenres($_POST['genres']);
        $movie->setCrew($_POST['crew']);
        $movie->setDirectors($_POST['directors']);
        $movie->setAwards($_POST['awards']);
    }
}

// Page header
Page::$title = "MyMDB - Movie Info";
Page::header();
Page::page_head(true);

// Render page content
if($toRender == "form") {
    Page::render_movie_form($movie, $validateMessages, $message, $messageSeverity);
} else if($toRender == "detail") {
    Page::render_movie_detail($movie);
}

// Page footer
Page::footer();

?>