<?php


class LoginManager  {


    //This function checks if the user is logged in, if they are not they are redirected to the login page
    static function verifyUserLoggedin()   {
        
        session_start();

        //Check for a session_id or the $_SESSION variable
        if(isset($_SESSION["loggedin"])) {
            //The user is logged in
            return true;
        } else {
            //The user is not logged in
            //Destroy any session just in case
            unset($_SESSION);
            session_destroy();
            //Send them back to the login page
            //Redirect the user to the login page
            header('Location: Authenticate.php');
            //Return false
            return false;
        }
    }

    static function login($loggedinUser) {
        session_start();

        $_SESSION["loggedin"] = $loggedinUser;
    }
      
    static function logout() {
        session_start();
        unset($_SESSION);
        session_destroy();
    }
    
    static function getLoggedinUser() {
        if(isset($_SESSION["loggedin"])) {
            return $_SESSION["loggedin"];
        } else return null;
    }
}

?>