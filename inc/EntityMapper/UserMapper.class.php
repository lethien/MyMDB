<?php

class UserMapper {
    // PDO agent
    private static $db;

    // Error
    public static $error;

    // Initialize PDB agent with Customer Class Name
    public static function initialize() {
        try {
            self::$db = new PDOAgent("User"); 
            return true;
        } catch(Exception $e) {
            self::$error = "System failure: Can't connect to Database!";
            return false;
        }       
    }

    // Get all users from database
    public static function getUsers() {
        $sqlSelect = "SELECT UserID, UserName, Password, Email FROM User";

        self::$db->query($sqlSelect);

        self::$db->execute();

        return self::$db->resultSet();
    }

    // Get a user based on id
    public static function getUser($id) {
        $sqlSelect = "SELECT UserID, UserName, Password, Email FROM User WHERE UserID = :id";

        self::$db->query($sqlSelect);
        self::$db->bind(":id", $id);

        self::$db->execute();

        return self::$db->singleResult();
    }

    // Get a user based on username
    public static function getUserName($username) {
        $sqlSelect = "SELECT UserID, UserName, Password, Email FROM User WHERE UserName = :username";

        self::$db->query($sqlSelect);
        self::$db->bind(":username", $username);

        self::$db->execute();

        return self::$db->singleResult();
    }

    // Add a new user to database
    public static function addUser(User $newUser) {
        $sqlInsert = "INSERT INTO User (UserName, Password, Email) VALUES (:username, :password, :email)";

        self::$db->query($sqlInsert);
        self::$db->bind(":username", $newUser->getUserName());
        self::$db->bind(":password", $newUser->getPassword());
        self::$db->bind(":email", $newUser->getEmail());

        self::$db->execute();

        return self::$db->lastInsertId();
    }

    // Update a user
    public static function updateUser(User $user) {
        $sqlUpdate = "UPDATE User SET UserName = :username, Password = :password, Email = :email WHERE UserID = :id";

        try{
            self::$db->query($sqlUpdate);
            self::$db->bind(":id", $user->getUserID());
            self::$db->bind(":username", $user->getUserName());
            self::$db->bind(":password", $user->getPassword());
            self::$db->bind(":email", $user->getEmail());
    
            self::$db->execute();

            if(self::$db->rowCount() != 1) {
                throw new Exception("Problem when updating User (ID:". $user->getUserID() .")");
            }
        } catch(Exception $e) {
            self::$error = $e->getMessage();
            return false;
        }
        
        return true;
    }

    // Delete a user
    public static function deleteUser($id) {
        $sqlDelete = "DELETE FROM User WHERE UserID = :id";

        try{
            self::$db->query($sqlDelete);
            self::$db->bind(":id", $id);

            self::$db->execute();

            if(self::$db->rowCount() != 1) {
                throw new Exception("Problem when deleting User (ID:". $id .")");
            }
        } catch(Exception $e) {
            self::$error = $e->getMessage();
            return false;
        }
        
        return true;
    }
}

?>