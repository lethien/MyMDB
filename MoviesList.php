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

// Get movies list based on search term in POST
$moviesList = array();

if(!empty($_POST['search'])) {
    $result = RestClient::call(MOVIE_API,"GET",$_POST);
} else {
    $result = RestClient::call(MOVIE_API,"GET",array());
}

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
    
    $moviesList[] = $movie;        
}

Page::render_movie_list($moviesList);

// Page footer
Page::footer();

?>
