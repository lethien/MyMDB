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

}

?>