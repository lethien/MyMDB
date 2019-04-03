<?php

require_once('../inc/config.inc.php');
require_once('../inc/Entity/User.class.php');
require_once('../inc/Entity/Movie.class.php');
require_once('../inc/Entity/Review.class.php');
require_once('../inc/Utility/PDOAgent.class.php');
require_once('../inc/EntityMapper/UserMapper.class.php');
require_once('../inc/EntityMapper/MovieMapper.class.php');
require_once('../inc/EntityMapper/ReviewMapper.class.php');

UserMapper::initialize();
MovieMapper::initialize();
ReviewMapper::initialize();

// Pull request data from the input stream
parse_str(file_get_contents('php://input'), $requestData);

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':                    
		if (isset($requestData['object']))  {
            if($requestData['object'] == "home_page") { // Stat for home page
                // Get database stats, number of movies, number of users, number of reviews
                $moviesCount = count(MovieMapper::getMovies());
                $usersCount = count(UserMapper::getUsers());
                $reviewsCount = count(ReviewMapper::getAllReviews());

                // Get top 4 rating movies
                $topRatingMovies = MovieMapper::getTopRatingMovies();

                // Get top 4 reviewed movies
                $topReviewedMovies = MovieMapper::getTopReviewedMovies();

                // Build response
                $obj = new StdClass;
                $obj->moviesCount = $moviesCount;
                $obj->usersCount = $usersCount;
                $obj->reviewsCount = $reviewsCount;
                $obj->topRatingMovies = array();
                foreach($topRatingMovies as $m) {
                    $obj->topRatingMovies[] = $m->jsonSerialize();
                }
                $obj->topReviewedMovies = array();
                foreach($topReviewedMovies as $m) {
                    $obj->topReviewedMovies[] = $m->jsonSerialize();
                }

                //Set the header
                header('Content-Type: application/json');
                //Return all the movie!
                echo json_encode($obj);
            } else if($requestData['object'] == "user_detail" 
                && isset($requestData['userId'])) { // Stat for user
                $userId = $requestData['userId'];

                // Get database stats, number of movies, number of users, number of reviews
                $moviesCount = count(MovieMapper::getMoviesCreatedByUser($userId));
                $reviewsCount = count(ReviewMapper::getAllReviewsOfUser($userId));

                // Get top 4 rating movies
                $topRatingMovies = MovieMapper::getUserFavoriteMovies($userId);

                // Build response
                $obj = new StdClass;
                $obj->moviesCount = $moviesCount;
                $obj->reviewsCount = $reviewsCount;
                $obj->topRatingMovies = array();
                foreach($topRatingMovies as $m) {
                    $obj->topRatingMovies[] = $m->jsonSerialize();
                }

                //Set the header
                header('Content-Type: application/json');
                //Return all the movie!
                echo json_encode($obj);
            }
		}
    
        break;

	case "POST":
        
        break;

    case "PUT":
        
        break;
    
    case "DELETE":        
        
        break;
    
    default:
        echo json_encode(array("message" => "Voce fala HTTP?"));
        break;
}
?>
