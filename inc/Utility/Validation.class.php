<?php

class Validation {
    
    public static function validateLoginForm($data): Array   {

        //Initialize and empty array
        $messages = array();

        //Validate all the things
        if(!isset($data["username"]) || $data["username"] == "") {
            $messages["username"] = "User name is required";
        }
        if(!isset($data["password"]) || $data["password"] == "") {
            $messages["password"] = "Password is required";
        }

        return $messages;
    }

    public static function validateRegisterForm($data): Array   {

        //Initialize and empty array
        $messages = array();

        //Validate all the things
        if(!isset($data["newusername"]) || $data["newusername"] == "") {
            $messages["newusername"] = "User name is required";
        }
        if(!isset($data["newpassword"]) || $data["newpassword"] == "") {
            $messages["newpassword"] = "Password is required";
        }
        if(!isset($data["newconfirmpassword"]) || $data["newconfirmpassword"] == "") { 
            $messages["newconfirmpassword"] = "Confirm Password is required";
        } else if($data["newpassword"] != $data["newconfirmpassword"]) {
            $messages["newconfirmpassword"] = "Confirm Password is not matched";
        }
        if(!isset($data["newemail"]) || $data["newemail"] == "") {
            $messages["newemail"] = "Email is required";
        } else if(!filter_var($data['newemail'], FILTER_VALIDATE_EMAIL)) {
            $messages["newemail"] = "Email is invalid";
        }

        return $messages;
    }
}