<?php

class Movie {
    /*
    +-------------+------------------+------+-----+---------+----------------+
    | Field       | Type             | Null | Key | Default | Extra          |
    +-------------+------------------+------+-----+---------+----------------+
    | MovieID     | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
    | Title       | char(50)         | NO   | UNI | NULL    |                |
    | Poster      | char(255)        | NO   |     | NULL    |                |
    | PlotSummary | text             | NO   |     | NULL    |                |
    | Runtime     | int(11)          | NO   |     | NULL    |                |
    | Genres      | text             | NO   |     | NULL    |                |
    | Crew        | text             | NO   |     | NULL    |                |
    | Directors   | text             | NO   |     | NULL    |                |
    | Awards      | text             | YES  |     | NULL    |                |
    | CreatedBy   | int(10) unsigned | NO   | MUL | NULL    |                |
    +-------------+------------------+------+-----+---------+----------------+
    */

	// Class attributes
	private $MovieID;
	private $Title;
	private $Poster;
	private $PlotSummary;
	private $Runtime;
	private $Genres;
	private $Crew;
	private $Directors;
	private $Awards;
    private $CreatedBy;
        
	// Getters
	public function getMovieID() : int {
        return $this->MovieID;
    }
    public function getTitle() : string {
        return $this->Title;
    }
    public function getPosterURL() : string {
        return $this->Poster;
    }
    public function getSummary() : string {
        return $this->PlotSummary;
    }
	public function getRuntime() : int {
        return $this->Runtime;
    }
    public function getGenres() : string {
        return $this->Genres;
    }
    public function getCrew() : string {
        return $this->Crew;
    }
	public function getDirectors() : string {
        return $this->Directors;
    }
    public function getAwards() : string {
        return $this->Awards;
    }
    public function getCreatedBy() : int {
        return $this->CreatedBy;
    }

    // Setters
	public function setMovieID($id) {
        $this->MovieID = (int) $id;
    }
    public function setTitle(string $title) {
        $this->Title = $title;
    }
    public function setPosterURL(string $poster) {
        $this->Poster = $poster;
    }
    public function setSummary(string $summary) {
        $this->PlotSummary = $summary;
    }
	public function setRuntime(int $runtime) {
        $this->Runtime = $runtime;
    }
	public function setGenres(string $genres) {
        $this->Genres = $genres;
    }
    public function setCrew(string $crew) {
        $this->Crew = $crew;
    }
    public function setDirectors(string $directors) {
        $this->Directors = $directors;
    }
	public function setAwards(string $awards) {
        $this->Awards = $awards;
    }
	public function setCreatedBy(int $id) {
        $this->CreatedBy = $id;
    }

    // for JSON serialize
    function jsonSerialize() {
		// Add selected properties to a standard class
        $obj = new StdClass;
        $obj->MovieID = $this->getMovieID();
        $obj->Title = $this->getTitle();
        $obj->Poster = $this->getPosterURL();
        $obj->PlotSummary = $this->getSummary();
		$obj->Runtime = $this->getRuntime();
        $obj->Genres = $this->getGenres();
        $obj->Crew = $this->getCrew();
		$obj->Directors = $this->getDirectors();
		$obj->Awards = $this->getAwards();
		$obj->CreatedBy = $this->getCreatedBy();
        return $obj;
        
    }
}

?>
