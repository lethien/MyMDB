<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Movie.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Page.class.php");
require_once("inc/Utility/RestClient.class.php");

LoginManager::verifyUserLoggedin();

// Page header
Page::$title = "MyMDB - Home";
Page::header();
Page::page_head(true);

$homePageStat = json_decode(RestClient::call(STATISTIC_API, "GET", array("object" => 'home_page')));

$jTopRatingMovies = $homePageStat->topRatingMovies;
$topRatingMovies = array();
foreach ($jTopRatingMovies as $m) {
    //Assemble a new movie
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
    
    $topRatingMovies[] = $movie;        
}

$jTopReviewedMovies = $homePageStat->topReviewedMovies;
$topReviewedMovies = array();
foreach ($jTopReviewedMovies as $m) {
    //Assemble a new movie
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
    
    $topReviewedMovies[] = $movie;        
}

Page::render_homepage($homePageStat, $topRatingMovies, $topReviewedMovies);

// Page footer
Page::footer();


?>