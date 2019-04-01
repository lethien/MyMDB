<?php

/*
+---------+------------------+------+-----+---------+-------+
| Field   | Type             | Null | Key | Default | Extra |
+---------+------------------+------+-----+---------+-------+
| UserID  | int(10) unsigned | NO   | PRI | NULL    |       |
| MovieID | int(10) unsigned | NO   | PRI | NULL    |       |
| Rating  | int(11)          | NO   |     | NULL    |       |
| Review  | text             | NO   |     | NULL    |       |
+---------+------------------+------+-----+---------+-------+ 
*/
class Review {
    // Class attributes
    private $UserID;
    private $MovieID;
    private $Rating;
    private $Review;   

    // Getters
    public function getUserID() : int {
        return $this->UserID;
    }
    public function getMovieID() : int {
        return $this->MovieID;
    }
    public function getRating() : int {
        return $this->Rating;
    }
    public function getReview() : string {
        return $this->Review;
    }

    // Setters
    public function setUserID(string $newUserID) {
        return $this->UserID = $newUserID;
    }
    public function setMovieID(string $newMovieID) {
        return $this->MovieID = $newMovieID;
    }
    public function setRating(int $newRating) {
        return $this->Rating = $newRating;
    }
    public function setReview(string $newReview) {
        return $this->Review = $newReview;
    }

    // for JSON serialize
    function jsonSerialize() {
        // instance an object and add properties to a standard class
        $obj = new StdClass;
        $obj->UserID = $this->getUserID();
        $obj->MovieID = $this->getMovieID();
        $obj->Rating = $this->getRating();
        $obj->Review = $this->getReview();
        return $obj;
    }
}

?>