<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/Movie.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Page.class.php");

LoginManager::verifyUserLoggedin();

// Page header
Page::$title = "MyMDB - Movie List";
Page::header();
Page::page_head(true);

// TODO: get movies list based on search term in POST
$moviesList = array();
$allMovies = array();

//Get every movie 
$result = RestClient::call(MOVIE_API,"GET",array());

//De-serialize the result of the Rest call.
$jmovies = json_decode($result);


foreach ($jmovies as $m)  {
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
    
    $allMovies[] = $movie;
    var_dump($allMovies);
}

Page::render_movie_list($allMovies);

// Page footer
Page::footer();


?>
