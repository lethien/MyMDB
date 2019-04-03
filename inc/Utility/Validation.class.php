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

    public static function validateMovieForm($data): Array   {

        //Initialize and empty array
        $messages = array();

        //Validate all the things
        if(!isset($data["title"]) || $data["title"] == "") {
            $messages["title"] = "Title is required";
        }
        if(!isset($data["poster"]) || $data["poster"] == "") {
            $messages["poster"] = "Poster URL is required";
        }
        if(!isset($data["summary"]) || $data["summary"] == "") {
            $messages["summary"] = "Plot Summary is required";
        }
        if(!isset($data["runtime"]) || $data["runtime"] == "") {
            $messages["runtime"] = "Runtime is required";
        } else if(!is_numeric($data["runtime"]) || $data["runtime"] <= 0) {
            $messages["runtime"] = $data["runtime"]." is not a valid runtime";
        }
        if(!isset($data["genres"]) || $data["genres"] == "") {
            $messages["genres"] = "Genre is required";
        }
        if(!isset($data["crew"]) || $data["crew"] == "") {
            $messages["crew"] = "Crew is required";
        }
        if(!isset($data["directors"]) || $data["directors"] == "") {
            $messages["directors"] = "Director is required";
        }

        return $messages;
    }

    public static function validateReviewForm($data): Array   {

        //Initialize and empty array
        $messages = array();

        //Validate all the things
        if(!isset($data["rating"]) || $data["rating"] == "") {
            $messages["rating"] = "Rating is required";
        }
        if(!isset($data["review"]) || $data["review"] == "") {
            $messages["review"] = "Review is required";
        }
        
        return $messages;
    }
}