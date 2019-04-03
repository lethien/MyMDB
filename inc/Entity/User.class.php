<?php

// +----------+------------------+------+-----+---------+----------------+
// | Field    | Type             | Null | Key | Default | Extra          |
// +----------+------------------+------+-----+---------+----------------+
// | UserID   | int(10) unsigned | NO   | PRI | NULL    | auto_increment |
// | UserName | char(50)         | NO   |     | NULL    |                |
// | Password | text             | NO   |     | NULL    |                |
// | Email    | char(50)         | NO   |     | NULL    |                |
// +----------+------------------+------+-----+---------+----------------+

class User {
    private $UserID;
    private $UserName;
    private $Password;
    private $Email;

    // Getters
    public function getUserID() : int {
        return $this->UserID;
    }
    public function getUserName() : string {
        return $this->UserName;
    }
    public function getPassword() : string {
        return $this->Password;
    }
    public function getEmail() : string {
        return $this->Email;
    }

    // Setters
    public function setUserID($id) {
        $this->UserID = (int) $id;
    }
    public function setUserName(string $username) {
        $this->UserName = $username;
    }
    public function setPassword(string $password) {
        $this->Password = $password;
    }
    public function setEmail(string $email) {
        $this->Email = $email;
    }

    // for JSON serialize
    function jsonSerialize() {
        // Add selected properties to a standard class
        $obj = new StdClass;
        $obj->UserID = $this->getUserID();
        $obj->UserName = $this->getUserName();
        $obj->Password = $this->getPassword();
        $obj->Email = $this->getEmail();
        return $obj;
    }

    // Hash and set password
    public function setNewPassword(string $newPassword) {
        //Hash password
        $hash = password_hash($newPassword, PASSWORD_DEFAULT);
      
        $this->setPassword($hash);
    }

    // Verify password
    public function verifyPassword($verifyPassword) : bool {
        //check password_verify
        return password_verify($verifyPassword, $this->getPassword());
    }
}

?>