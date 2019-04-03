<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Utility/Page.class.php");
require_once("inc/Utility/Validation.class.php");
require_once("inc/Utility/RestClient.class.php");
require_once("inc/Utility/LoginManager.class.php");

// Post request message to show
$message = "";

// Message for each field
$validateMessages = array();

// Page header
Page::$title = "MyMDB - Authenticate";
Page::header();

// Handle post requests
if(!empty($_POST)) {
    if($_POST['action'] == "login") {
        // When user click submit in Login form        
        $validateMessages = Validation::validateLoginForm($_POST);
        
        if(count($validateMessages) == 0) {
            $juser = json_decode(RestClient::call(USER_API, "GET", array("username" => $_POST['username'])));
            
            if($juser != null) {
                $user = new User();
                $user->setUserID($juser->UserID);
                $user->setUserName($juser->UserName);
                $user->setPassword($juser->Password);
                $user->setEmail($juser->Email);

                if($user->verifyPassword($_POST['password'])) {
                    
                    LoginManager::login($user);

                    header('Location: '.HOME_PAGE);
                }
            } 
            
            $message = "Login failed! User name or password is not correct!";            
        }
    } else if($_POST['action'] == "register") {
        // When user click submit in Register form
        $validateMessages = Validation::validateRegisterForm($_POST);

        if(count($validateMessages) == 0) {                 
            $user = json_decode(RestClient::call(USER_API, "GET", array("username" => $_POST['newusername'])));
            if($user != null) {
                $message = "Register failed! Username already taken!";
            } else {
                $newUserId = json_decode(RestClient::call(USER_API, "POST", $_POST));
            
                if($newUserId != null && $newUserId > 0) {
                    $juser = json_decode(RestClient::call(USER_API, "GET", array("id" => $newUserId)));
                    $user = new User();
                    $user->setUserID($juser->UserID);
                    $user->setUserName($juser->UserName);
                    $user->setPassword($juser->Password);
                    $user->setEmail($juser->Email);
                    LoginManager::login($user);
    
                    header('Location: '.HOME_PAGE);                
                } 
                
                $message = "Register failed! Please try again later!";   
            }                
        }        
    }
}

Page::page_head();

// Show message
Page::messagearea($message);

// Show form
Page::authenticateForm($validateMessages);

// Page footer
Page::footer();

?>