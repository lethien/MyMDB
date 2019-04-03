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
        // Select all movies in the DB     
        $selectAll = "SELECT M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy, 
        COUNT(Review) as ReviewNumber, IFNULL(AVG(Rating), 0) as Rating 
        FROM Movie as M
        LEFT JOIN Review as R ON M.MovieID = R.MovieID
        GROUP BY M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy";
        //Query
        self::$db->query($selectAll);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->resultSet();
    }
	
	static function getMovie(string $title) {  
        // Select movie by title      
        $sqlSelect = "SELECT M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy, 
        COUNT(Review) as ReviewNumber, IFNULL(AVG(Rating), 0) as Rating 
        FROM Movie as M
        LEFT JOIN Review as R ON M.MovieID = R.MovieID 
        WHERE Title = :Title
        GROUP BY M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy";
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
        // Select movie by ID
        $sqlSelect = "SELECT M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy, 
        COUNT(Review) as ReviewNumber, IFNULL(AVG(Rating), 0) as Rating 
        FROM Movie as M
        LEFT JOIN Review as R ON M.MovieID = R.MovieID 
        WHERE M.MovieID = :MovieID
        GROUP BY M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy";
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
        // Delete movie by title
        $deleteSQLQuery = "DELETE FROM Movie WHERE Title = :Title;";

        try {
            //Query
            self::$db->query($deleteSQLQuery);
            //Bind
            self::$db->bind(':Title', $title);
            //Execute
            self::$db->execute();
            //Check delete result
            if (self::$db->rowCount() != 1) {
                throw new Exception("Problem deleting movie $title");
            }
        } catch(Exception $ex) {
            echo $ex->getMessage();
            self::$db->debugDumpParams();
            //Return
            return false;            
        }
        //Return    
        return true;
    }
	static function createMovie(Movie $newMovie) : int   {
        // Insert a new movie
        $sqlInsert = "INSERT INTO Movie (Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy) 
		VALUES (:Title, :Poster, :Summary, :Runtime, :Genres, :Crew, :Directors, :Awards, :CreatedBy)";

        //Query
        self::$db->query($sqlInsert);

        //Bind
		self::$db->bind(':Title', $newMovie->getTitle());
		self::$db->bind(':Poster', $newMovie->getPosterURL());
		self::$db->bind(':Summary', $newMovie->getSummary());
		self::$db->bind(':Runtime', $newMovie->getRuntime());
		self::$db->bind(':Genres', $newMovie->getGenres());
		self::$db->bind(':Crew', $newMovie->getCrew());
		self::$db->bind(':Directors', $newMovie->getDirectors());
		self::$db->bind(':Awards', $newMovie->getAwards());
        self::$db->bind(':CreatedBy', $newMovie->getCreatedBy());
        
        //Execute
        self::$db->execute();

        //Return
        return self::$db->lastInsertId();
    }

    public static function updateMovie(Movie $movie) {
        // Update a movie
        $sqlUpdate = "UPDATE Movie SET Title = :Title, Poster = :Poster, PlotSummary = :Summary, 
        Runtime = :Runtime, Genres = :Genres, Crew = :Crew, 
        Directors = :Directors, Awards = :Awards 
		WHERE MovieID = :ID";

        try{
            //Query
            self::$db->query($sqlUpdate);

            //Bind
            self::$db->bind(':ID', $movie->getMovieID());
            self::$db->bind(':Title', $movie->getTitle());
            self::$db->bind(':Poster', $movie->getPosterURL());
            self::$db->bind(':Summary', $movie->getSummary());
            self::$db->bind(':Runtime', $movie->getRuntime());
            self::$db->bind(':Genres', $movie->getGenres());
            self::$db->bind(':Crew', $movie->getCrew());
            self::$db->bind(':Directors', $movie->getDirectors());
            self::$db->bind(':Awards', $movie->getAwards());

            //Execute
            self::$db->execute();

            //Check update result
            if(self::$db->rowCount() != 1) {
                throw new Exception("Problem when updating Movie (ID:". $movie->getMovieID() .")");
            }
        } catch(Exception $e) {
            self::$error = $e->getMessage();
            //Return
            return false;
        }
        
        //Return
        return true;
    }
	
	static function seachMovie(string $search) {        
        //this should search all the fields that are not numbers
        $sqlSelect = "SELECT M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy, 
        COUNT(Review) as ReviewNumber, IFNULL(AVG(Rating), 0) as Rating 
        FROM Movie as M
        LEFT JOIN Review as R ON M.MovieID = R.MovieID         
        WHERE CONVERT(`Title` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Poster` USING utf8) LIKE '%$search%' 
        OR CONVERT(`PlotSummary` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Genres` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Crew` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Directors` USING utf8) LIKE '%$search%' 
        OR CONVERT(`Awards` USING utf8) LIKE '%$search%' 
        GROUP BY M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy"; 

        //Query
        self::$db->query($sqlSelect);

        //Execute
        self::$db->execute();

        //Return
        return self::$db->resultSet();        
    }
	
	static function getTopRatingMovies() {
        // Select top 4 rating movies
        $selectAll = "SELECT M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy, 
        COUNT(Review) as ReviewNumber, IFNULL(AVG(Rating), 0) as Rating 
        FROM Movie as M
        LEFT JOIN Review as R ON M.MovieID = R.MovieID
        GROUP BY M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy
        ORDER BY Rating DESC, ReviewNumber DESC
        LIMIT 4";

        //Query
        self::$db->query($selectAll);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->resultSet();
    }

    static function getTopReviewedMovies() {
        // Select top 4 most reviewed movies
        $selectAll = "SELECT M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy, 
        COUNT(Review) as ReviewNumber, IFNULL(AVG(Rating), 0) as Rating 
        FROM Movie as M
        LEFT JOIN Review as R ON M.MovieID = R.MovieID
        GROUP BY M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy
        ORDER BY ReviewNumber DESC, Rating DESC
        LIMIT 4";

        //Query
        self::$db->query($selectAll);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->resultSet();
    }

    static function getMoviesCreatedByUser($userId) {
        // Select all movies that are created by user
        $sqlSelect = "SELECT M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy, 
        COUNT(Review) as ReviewNumber, IFNULL(AVG(Rating), 0) as Rating 
        FROM Movie as M
        LEFT JOIN Review as R ON M.MovieID = R.MovieID 
        WHERE CreatedBy = :UserID
        GROUP BY M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(':UserID', $userId);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->resultSet();
    }

    static function getUserFavoriteMovies($userId) {
        // Select user's top 4 rating movies
        $selectAll = "SELECT M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy, 
        COUNT(Review) as ReviewNumber, IFNULL(AVG(Rating), 0) as Rating 
        FROM Movie as M
        LEFT JOIN Review as R ON M.MovieID = R.MovieID
        WHERE R.UserID = :UserID
        GROUP BY M.MovieID, Title, Poster, PlotSummary, Runtime, Genres, Crew, Directors, Awards, CreatedBy
        ORDER BY Rating DESC
        LIMIT 4";

        //Query
        self::$db->query($selectAll);
        //Bind
        self::$db->bind(':UserID', $userId);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->resultSet();
    }
}
?>
