<?php

class ReviewMapper {
    // PDO agent
    private static $db;

    // Error
    public static $error;

    // Initialize PDB agent with Review Class Name
    public static function initialize() {
        try {
            self::$db = new PDOAgent("Review"); 
            return true;
        } catch(Exception $e) {
            self::$error = "System failure: Can't connect to Database!";
            return false;
        }       
    }

    // get all Reviews of A movie by movieID
    public static function getReviews($movieId) {
        // query to get list of reviews with same movieID
        $sqlSelectAllReviews = 'SELECT UserID, MovieID, Rating, Review FROM Review WHERE MovieID = :movieid';

        self::$db->query($sqlSelectAllReviews);
        self::$db->bind(":movieid", $movieId);

        self::$db->execute();
        //return a list of reviews by MovieID
        return self::$db->resultSet();
    }

    // get all Review of A movie by a user
    public static function getReviewByUser($userId, $movieId) {
        // query to get list of reviews with same movieID
        $sqlSelectReview = 'SELECT UserID, MovieID, Rating, Review FROM Review 
        WHERE MovieID = :movieid AND UserID = :userid';

        self::$db->query($sqlSelectReview);
        self::$db->bind(":movieid", $movieId);
        self::$db->bind(":userid", $userId);

        self::$db->execute();
        //return a list of reviews by MovieID
        return self::$db->singleResult();
    }

    // add a new Review
    public static function addReview(Review $newReview) {
        // insert query a new review row to Review table
        $sqlInsertReview = 'INSERT INTO Review (UserID, MovieID, Rating, Review) VALUES (:userid, :movieid, :rating, :review)';
        self::$db->query($sqlInsertReview);

        // convert datas
        self::$db->bind(":userid", $newReview->getUserID());
        self::$db->bind(":movieid", $newReview->getMovieID());
        self::$db->bind(":rating", $newReview->getRating());
        self::$db->bind(":review", $newReview->getReview());

        self::$db->execute();

        // return the last insert id
        return self::$db->lastInsertId();
    }

    // update Review
    public static function updateReview(Review $updateReview) {
        // query to edit a review in Review table
        $sqlUpdateReview = "UPDATE Review SET Rating = :rating, Review = :review WHERE UserID = :userid AND MovieID = :movieid";

        try{
            self::$db->query($sqlUpdateReview);
            self::$db->bind(":userid", $newReview->getUserID());
            self::$db->bind(":movieid", $newReview->getMovieID());
            self::$db->bind(":rating", $newReview->getRating());
            self::$db->bind(":review", $newReview->getReview());
            self::$db->execute();

            if(self::$db->rowCount() != 1) {
                throw new Exception("Problem when updating Review (on MovieID: ". $updateReview->getMovieID() .")");
            }
        } catch(Exception $e) {
            self::$error = $e->getMessage();
            return false;
        }
        
        return true;
    }

    // delete Review
    public static function deleteReview($userId, $movieId) {
        // delete query with userID and movieID
        $sqlDeleteReview = "DELETE FROM Review WHERE UserID = :userid AND MovieID = :movieid";

        try{
            self::$db->query($sqlDeleteReview);
            self::$db->bind(":userid", $userId);
            self::$db->bind(":movieid", $movieId);

            self::$db->execute();

            if(self::$db->rowCount() != 1) {
                throw new Exception("Problem when deleting Review (on MovieID: ". $movieId .")");
            }
        } catch(Exception $e) {
            self::$error = $e->getMessage();
            return false;
        }
        
        return true;
    }
}

?>