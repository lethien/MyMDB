<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Movie.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Page.class.php");
require_once("inc/Utility/RestClient.class.php");

LoginManager::verifyUserLoggedin();

// Page header
Page::$title = "MyMDB - Movie List";
Page::header();
Page::page_head(true);

// Movies list to display
$moviesList = array();

// Get movies from DB through RestAPI call
if(!empty($_POST['search'])) { // If there is a search term in POST, get movies based on that search term
    $result = RestClient::call(MOVIE_API,"GET",$_POST);
} else { // else, get all movies from DB
    $result = RestClient::call(MOVIE_API,"GET",array());
}

// Loop through returned array
$jmovies = json_decode($result);
foreach ($jmovies as $m) {
    //Assemble a new movie class
    $movie = new Movie();
    $movie->setMovieID($m->MovieID);
    $movie->setTitle($m->Title);
    $movie->setPosterURL($m->Poster);
    $movie->setSummary($m->PlotSummary);
    $movie->setRuntime($m->Runtime);
    $movie->setGenres($m->Genres);
    $movie->setCrew($m->Crew);
    $movie->setDirectors($m->Directors);
    $movie->setAwards($m->Awards);
    $movie->setCreatedBy($m->CreatedBy);
    $movie->setReviewNumber($m->ReviewNumber);
    $movie->setRating($m->Rating);
    
    // Add movie to display array
    $moviesList[] = $movie;        
}

// Render movies
Page::render_movie_list($moviesList);

// Page footer
Page::footer();

?>
