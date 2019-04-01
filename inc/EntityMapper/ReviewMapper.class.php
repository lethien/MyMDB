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

}

?>