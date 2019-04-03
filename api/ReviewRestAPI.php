<?php

require_once('../inc/config.inc.php');
require_once('../inc/Entity/Review.class.php');
require_once('../inc/Utility/PDOAgent.class.php');
require_once('../inc/EntityMapper/ReviewMapper.class.php');

ReviewMapper::initialize();

// Pull request data from the input stream
parse_str(file_get_contents('php://input'), $requestData);

switch($_SERVER['REQUEST_METHOD']) {
    // if requrest GET
    case 'GET':
        if(isset($requestData['userID']) && isset($requestData['movieID'])) {
            // get all Reviews of a Movie from database by userID and movieID 
            $review = ReviewMapper::getReviewByUser($requestData['userID'], $requestData['movieID']);
            
            // Serialize the Review           
            $serializedReview = ($review != false) ? $review->jsonSerialize() : null;

            // Return the serialized Reviews          
            header("Content-Type: application/json");
            echo json_encode($serializedReview);
        }
        break;

    // if requrest POST
    case 'POST':
        // initialize an instance of Review
        $nr = new Review();

        // assign values to the Review object
        $nr->setUserID($requestData['userID']);
        $nr->setMovieID($requestData['movieID']);
        $nr->setRating($requestData['rating']);
        $nr->setReview($requestData['review']);

        // add New Review to Review table in database by passing an object
        $newReview = ReviewMapper::addReview($nr);
        header("Content-Type: application/json");
        echo json_encode($newReview);   

        break;

    // if requrest PUT
    case 'PUT':
        // initialize an instance of Review
        $updatingReview = new Review();

        // assign values to the Review object
        $updatingReview->setUserID($requestData['userID']);
        $updatingReview->setMovieID($requestData['movieID']);
        $updatingReview->setRating($requestData['rating']);
        $updatingReview->setReview($requestData['review']);

        // update New Review to a Review in database by passing an object
        $result = ReviewMapper::updateReview($updatingReview);
        header("Content-Type: application/json");
        echo json_encode($result);

        break;

    // if requrest DELETE
    case 'DELETE':
        // delete a Review in database by passing userID and movieID
        $result = ReviewMapper::deleteReview($requestData['userID'], $requestData['movieID']);
        header("Content-Type: application/json");
        echo json_encode($result);

        break;
}

?>