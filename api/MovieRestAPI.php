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

	case "POST":

    
        //New Movie
        $movie = new Movie();
        $movie->setTitle($requestData['title']);
		$movie->setPosterURL($requestData['poster']);
		$movie->setSummary($requestData['summary']);
		$movie->setRuntime($requestData['runtime']);
		$movie->setGenres($requestData['genres']);
		$movie->setCrew($requestData['crew']);
		$movie->setDirectors($requestData['directors']);
		$movie->setAwards($requestData['awards']);
		$movie->setCreatedBy($requestData['createdBy']);
        
        
        //Add book to DB
        $result = MovieMapper::createMovie($movie);

        //Return result
        header('Content-Type: application/json');
        //Return the result.
        echo json_encode($result);
        

    break;
		
        case "PUT":
        //this is used to submit an edited entity
        $movie = new Movie();
		$movie->setMovieID($requestData['id']);
        $movie->setTitle($requestData['title']);
		$movie->setPosterURL($requestData['poster']);
		$movie->setSummary($requestData['summary']);
		$movie->setRuntime($requestData['runtime']);
		$movie->setGenres($requestData['genres']);
		$movie->setCrew($requestData['crew']);
		$movie->setDirectors($requestData['directors']);
		$movie->setAwards($requestData['awards']);
		$movie->setCreatedBy($requestData['createdBy']);

        $result = MovieMapper::updateMovie($movie);
    
        header('Content-Type: application/json');
        //Return the result.
        echo json_encode($result);
    
    
    break;
    
    //Delete all the things!
    case "DELETE":
    
        $title = $requestData['title'];
        $result = MovieMapper::deleteMovie($title);

        header('Content-Type: application/json');
        echo json_encode($result);

    break;
    
    default:

        echo json_encode(array("message" => "Voce fala HTTP?"));
    break;
}
?>
