<?php

require_once('../inc/config.inc.php');
require_once('../inc/Entity/Movie.class.php');
require_once('../inc/Utility/PDOAgent.class.php');
require_once('../inc/EntityMapper/MovieMapper.class.php');

MovieMapper::initialize();

// Pull request data from the input stream
parse_str(file_get_contents('php://input'), $requestData);

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if (isset($requestData['title']))  {

        $title = $requestData['title'];
        $movie = MovieMapper::getMovie($title);

        $jsonMovie = $movie->jsonSerialize();
        

        header('Content-Type: application/json');
        echo json_encode($jsonMovie);
		}
    else{
        //Get all the movies
        $movies = MovieMapper::getMovies();
        //Initialize an array to hold the serialized movies
        $serializedMovies = array();

        //Go through all the movies and add them to the serialized array
        foreach ($movies as $movie)   
        {
            $serializedMovies[] = $movie->jsonSerialize();
        }

        
        //Set the header
        header('Content-Type: application/json');
        //Return all the movie!
        echo json_encode($serializedMovies);
    }
    
    break;
        
        break;
    case 'POST':
        

        break;
    case 'PUT':
        

        break;
    case 'DELETE':        
        

        break;
}

?>
