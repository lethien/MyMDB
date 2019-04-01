<?php

class PDOAgent {
    // Database infos
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    // Database source name
    private $dsn;

    // PHP Database object
    private $pdo;

    // Database statement object;
    private $stmt;

    // Class name for parse select result
    private $classname;

    // Initialize PDO Agent
    public function __construct(string $classname) {
        // Build database source name string
        $this->dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;

        // Set options
        $options = array (
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        // Attemp to connect to database using pdo
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $options);
        } catch(Exception $e) {
            throw $e;
        }

        // Set classname
        $this->classname = $classname;
    }

    // Prepare query statment
    public function query(string $query) {
        $this->stmt = $this->pdo->prepare($query);
    }

    // Bind query variable
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {  
            switch (true) {  
                case is_int($value):  
                $type = PDO::PARAM_INT;  
                break;  
                case is_bool($value):  
                $type = PDO::PARAM_BOOL;  
                break;  
                case is_null($value):  
                $type = PDO::PARAM_NULL;  
                break;  
                default:  
                $type = PDO::PARAM_STR;  
            }  
        }  

        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute query 
    public function execute($data = null) {
        if(is_null($data)) 
            return $this->stmt->execute();
        else
            return $this->stmt->execute($data);
    }

    // Start : Functions to call after execute for result
    // Get select result with single row
    public function singleResult() {        
        // Fetch mode to return class
        $this->stmt->setFetchMode(PDO::FETCH_CLASS, $this->classname);
        return $this->stmt->fetch();
    }

    // Get select result with one or multiple rows
    public function resultSet() {                
        return $this->stmt->fetchAll(PDO::FETCH_CLASS, $this->classname);
    }

    // Get inserted row id
    public function lastInsertId() : int {
        return $this->pdo->lastInsertId();
    }

    // Get result count
    public function rowCount() : int {
        return $this->stmt->rowCount();
    }

    // Get the debug info
    public function debugDumpParams() {
        return $this->stmt->debugDumpParams();
    }
    // End : Functions to call after execute for result
}

?>