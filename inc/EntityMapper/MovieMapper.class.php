<?php
class MovieMapper {
    // PDO agent
    private static $db;
	
    // Error
    public static $error;

    // Initialize PDB agent with Movie Class Name
    public static function initialize() {       
        try {
            self::$db = new PDOAgent("Movie"); 
            return true;
        } catch(Exception $e) {
            self::$error = "System failure: Can't connect to Database!";
            return false;
        }
    }
	
	static function getMovies() : Array {        
        $selectAll = "SELECT MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy FROM Movie";

        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->resultSet();
    }
	
	static function getMovie(string $title) {        
        $sqlSelect = "SELECT MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy FROM Movie WHERE Title = :Title";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(':Title', $title);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->singleResult();
    }

    static function getMovieById(string $id) {
        $sqlSelect = "SELECT MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy FROM Movie WHERE MovieID = :MovieID";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(':MovieID', $id);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->singleResult();
    }
	
	static function deleteMovie(string $title) : bool {
        $deleteSQLQuery = "DELETE FROM Movie WHERE Title = :Title;";

        try {

            self::$db->query($deleteSQLQuery);
            self::$db->bind(':Title', $title);
            self::$db->execute();

            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting movie $title");
            }
        } catch(Exception $ex) {
            echo $ex->getMessage();
            self::$db->debugDumpParams();
            return false;
            
        }

        return true;

    }
	static function createMovie(Movie $newMovie) : int   {
        $sqlInsert = "INSERT INTO Movie (Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy) 
		VALUES (:Title, :Poster, :Summary, :Runtime, :Genres, :Crew, :Directors, :Awards, :CreatedBy)";

        self::$db->query($sqlInsert);

		self::$db->bind(':Title', $newMovie->getTitle());
		self::$db->bind(':Poster', $newMovie->getPosterURL());
		self::$db->bind(':Summary', $newMovie->getSummary());
		self::$db->bind(':Runtime', $newMovie->getRuntime());
		self::$db->bind(':Genres', $newMovie->getGenres());
		self::$db->bind(':Crew', $newMovie->getCrew());
		self::$db->bind(':Directors', $newMovie->getDirectors());
		self::$db->bind(':Awards', $newMovie->getAwards());
		self::$db->bind(':CreatedBy', $newMovie->getCreatedBy());
        self::$db->execute();

        return self::$db->lastInsertId();
    }

    public static function updateMovie(Movie $movie) {
        $sqlUpdate = "UPDATE Movie SET Title = :Title, Poster = :Poster, PlotSummary = :Summary, 
        Runtime = :Runtime, Genres = :Genres, Crew = :Crew, 
        Directors = :Directors, Awards = :Awards 
		WHERE MovieID = :ID";

        try{
            self::$db->query($sqlUpdate);
            self::$db->bind(':ID', $movie->getMovieID());
            self::$db->bind(':Title', $movie->getTitle());
            self::$db->bind(':Poster', $movie->getPosterURL());
            self::$db->bind(':Summary', $movie->getSummary());
            self::$db->bind(':Runtime', $movie->getRuntime());
            self::$db->bind(':Genres', $movie->getGenres());
            self::$db->bind(':Crew', $movie->getCrew());
            self::$db->bind(':Directors', $movie->getDirectors());
            self::$db->bind(':Awards', $movie->getAwards());
            self::$db->execute();

            if(self::$db->rowCount() != 1) {
                throw new Exception("Problem when updating Movie (ID:". $movie->getMovieID() .")");
            }
        } catch(Exception $e) {
            self::$error = $e->getMessage();
            return false;
        }
        
        return true;
    }
	
	static function seachMovie(string $search)    {
        
        //this should search all the fields that are not numbers
        $sqlSelect = "SELECT MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy 
        FROM movie WHERE 
        CONVERT(`Title` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Poster` USING utf8) LIKE '%$search%' 
        OR CONVERT(`PlotSummary` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Genres` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Crew` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Directors` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Awards` USING utf8) LIKE '%$search%';"; 
        //Query
        self::$db->query($sqlSelect);

        //Execute
        self::$db->execute();

        //Return
        return self::$db->resultSet();        
    }
	
	
}
?>
