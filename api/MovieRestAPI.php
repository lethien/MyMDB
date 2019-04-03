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
        if (isset($requestData['title']))  { // Get movie by title
            // Retrieve movie from database
            $title = $requestData['title'];
            $movie = MovieMapper::getMovie($title);

            // Serialize movie object to standard class
            $jsonMovie = ($movie != false) ? $movie->jsonSerialize() : null;
            
            // Return the movie in JSON format
            header('Content-Type: application/json');
            echo json_encode($jsonMovie);
        } else if (isset($requestData['movieid']))  { // Get movie by movie ID
            // Retrieve movie from database
            $id = $requestData['movieid'];
            $movie = MovieMapper::getMovieById($id);

            // Serialize movie object to standard class 
            $jsonMovie = ($movie != false) ? $movie->jsonSerialize() : null;
            
            // Return the movie in JSON format
            header('Content-Type: application/json');
            echo json_encode($jsonMovie);
        } else if(isset($requestData['search'])){ // Get movies list by search term
            // Retrieve movies list from database
            $moviesFound = MovieMapper::SeachMovie($requestData['search']);
            
            //Go through all the movies and add them to the serialized array
            $serializedList = array();
            foreach ($moviesFound as $movie)   
            {
                $serializedList[] = $movie->jsonSerialize();
            }

            // Return the movies array in JSON format
            header('Content-Type: application/json');
            echo json_encode($serializedList);
        } else { //Get all the movies    
            // Retrieve movies list from database        
            $movies = MovieMapper::getMovies();            
            
            //Go through all the movies and add them to the serialized array
            $serializedMovies = array();
            foreach ($movies as $movie)   
            {
                $serializedMovies[] = $movie->jsonSerialize();
            }
            
            // Return the movies array in JSON format
            header('Content-Type: application/json');
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
        
        //Add movie to DB
        $result = MovieMapper::createMovie($movie);

        //Return the result
        header('Content-Type: application/json');
        echo json_encode($result);
        break;

    case "PUT":
        //this is used to submit an edited entity
        $movie = new Movie();
		$movie->setMovieID($requestData['movieid']);
        $movie->setTitle($requestData['title']);
		$movie->setPosterURL($requestData['poster']);
		$movie->setSummary($requestData['summary']);
		$movie->setRuntime($requestData['runtime']);
		$movie->setGenres($requestData['genres']);
		$movie->setCrew($requestData['crew']);
		$movie->setDirectors($requestData['directors']);
		$movie->setAwards($requestData['awards']);

        // Update movie in DB
        $result = MovieMapper::updateMovie($movie);
    
        //Return the result
        header('Content-Type: application/json');
        echo json_encode($result);
        break;
    case "DELETE":
        //Delete movie by title
        $title = $requestData['title'];
        $result = MovieMapper::deleteMovie($title);

        //Return the result
        header('Content-Type: application/json');
        echo json_encode($result);
        break;
    
    default:
        echo json_encode(array("message" => "Voce fala HTTP?"));
        break;
}
?>
