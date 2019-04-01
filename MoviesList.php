<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Page.class.php");

LoginManager::verifyUserLoggedin();

// Page header
Page::$title = "MyMDB - Movie List";
Page::header();
Page::page_head(true);

// TODO: get movies list based on search term in POST
$moviesList = array();

//Get every movie 
$result = RestClient::call("GET",array());

//De-serialize the result of the Rest call.
$jmovies = json_decode($result);

$allMovies = array();

foreach ($jmovies as $m)  {
    //Assemble a new movie class
        $movie = new Movie();
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
}

if(isset($_POST['search'])){
    $searchTerm = $_POST['search'];
    

    foreach($allMovies as $movie){
        $movieTitle = $movie->getTitle();
        //this should check if $_POST['search'] is contained within the title of a movie
        if (strpos($movieTitle, $searchTerm) == true) 
        { 
        $moviesList[] = $movie;
        }
    }
}
Page::render_movie_list($moviesList);

// Page footer
Page::footer();


?>
