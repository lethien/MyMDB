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
        
        $selectAll = "SELECT * FROM Movie;";

        self::$db->query($selectAll);
        self::$db->execute();
        return self::$db->resultSet();
    }
	
	static function getMovie(string $title)    {
        
        $sqlSelect = "SELECT * FROM books WHERE Title = :Title";
        //Query
        self::$db->query($sqlSelect);
        //Bind
        self::$db->bind(':Title', $title);
        //Execute
        self::$db->execute();
        //Return
        return self::$db->singleResult();
    }
	
	static function deleteMovie(string $title) : bool {
        $deleteSQLQuery = "DELETE FROM Books WHERE Title = :Title;";

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
	
	
	
	
	
}
?>
