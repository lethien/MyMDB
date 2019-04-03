<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Entity/Movie.class.php");
require_once("inc/Entity/Review.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Validation.class.php");
require_once("inc/Utility/RestClient.class.php");
require_once("inc/Utility/Page.class.php");

LoginManager::verifyUserLoggedin();

// Post request message to show
$message = "";
$messageSeverity = "error";

// Message for each field
$validateMessages = array();

// What to render
$toRender = "form";

// Movie to render
$movie = new Movie();
$movie->setMovieID(0);
$movie->setTitle("");
$movie->setPosterURL("");
$movie->setSummary("");
$movie->setRuntime(0);
$movie->setGenres("");
$movie->setCrew("");
$movie->setDirectors("");
$movie->setAwards("");
$movie->setCreatedBy(0);

// Review of current user for this movie
$review = new Review();

// Handle request
if(isset($_GET['movieid'])) { // GET requests
    // Get requested movie from DB through RestAPI call
    $jRequestedMovie = json_decode(RestClient::call(MOVIE_API, "GET", $_GET));
    if($jRequestedMovie != null) {
        $movie->setMovieID($jRequestedMovie->MovieID);
        $movie->setTitle($jRequestedMovie->Title);
        $movie->setPosterURL($jRequestedMovie->Poster);
        $movie->setSummary($jRequestedMovie->PlotSummary);
        $movie->setRuntime($jRequestedMovie->Runtime);
        $movie->setGenres($jRequestedMovie->Genres);
        $movie->setCrew($jRequestedMovie->Crew);
        $movie->setDirectors($jRequestedMovie->Directors);
        $movie->setAwards($jRequestedMovie->Awards);
        $movie->setCreatedBy($jRequestedMovie->CreatedBy);
        $movie->setReviewNumber($jRequestedMovie->ReviewNumber);
        $movie->setRating($jRequestedMovie->Rating);

        if(isset($_GET['action']) && $_GET['action'] == "edit") { // Render edit movie form
            
        } else { // Render movie detail             
            $toRender = "detail";

            // Get review from database through RestAPI call
            $jReview = json_decode(RestClient::call(REVIEW_API, "GET", 
                array("userID" => LoginManager::getLoggedinUser()->getUserID(), 
                        "movieID" => $movie->getMovieID())));

            if($jReview != null) {
                $review->setUserID($jReview->UserID);
                $review->setMovieID($jReview->MovieID);
                $review->setRating($jReview->Rating);
                $review->setReview($jReview->Review);
            } else {
                $review->setUserID(LoginManager::getLoggedinUser()->getUserID());
                $review->setMovieID($movie->getMovieID());
                $review->setRating(0);
                $review->setReview("");
            }

            // Get message in session
            if(isset($_SESSION['review_message'])) {
                // Unset message from session after retrieve
                $message = $_SESSION['review_message'];
                unset($_SESSION['review_message']);

                if(isset($_SESSION['messageSeverity'])) {
                    $messageSeverity = $_SESSION['messageSeverity'];
                    unset($_SESSION['messageSeverity']);
                }
            }
        }
    } else {
        // Can't find movie with requested ID, show add form
        $message = "Can't the requested Movie. You can add it here.";
    }    
} else { // POST Request
    $rePopulateForm = true;

    if(isset($_POST['action']) && $_POST['action'] == "add") { // Add new movie        
        $validateMessages = Validation::validateMovieForm($_POST);

        if(count($validateMessages) == 0) {
            // Add new movie to DB through RestAPI call
            $_POST['createdBy'] = LoginManager::getLoggedinUser()->getUserID();
            $newMovieId = json_decode(RestClient::call(MOVIE_API, "POST", $_POST));

            if($newMovieId != null && $newMovieId > 0) { // Add movie success
                $message = "Movie ".$_POST['title'].' added! You can continue to add another movie.';   
                $messageSeverity = "success";   
                $rePopulateForm = false;         
            } else { // Failed to add movie
                $message = "Movie ".$_POST['title'].' not added! Please try again later.';   
            }
        }

        if($rePopulateForm) { // Keep showing values of previous form
            $movie->setMovieID($_POST['movieid']);
            $movie->setTitle($_POST['title']);
            $movie->setPosterURL($_POST['poster']);
            $movie->setSummary($_POST['summary']);
            $movie->setRuntime($_POST['runtime']);
            $movie->setGenres($_POST['genres']);
            $movie->setCrew($_POST['crew']);
            $movie->setDirectors($_POST['directors']);
            $movie->setAwards($_POST['awards']);
        }
    } else if(isset($_POST['action']) && $_POST['action'] == "update") { // Update movie        
        $validateMessages = Validation::validateMovieForm($_POST);

        if(count($validateMessages) == 0) {
            // Update movie in DB through RestAPI call
            $success = json_decode(RestClient::call(MOVIE_API, "PUT", $_POST));

            if($success) {
                $message = "Movie updated!";
                $messageSeverity = "success";                            
            } else {                
                $message = "Movie ".$_POST['title'].' not updated! Please try changing some fields or try again later.';   
            }
        }

        if($rePopulateForm) { // Keep showing values of previous form
            $movie->setMovieID($_POST['movieid']);
            $movie->setTitle($_POST['title']);
            $movie->setPosterURL($_POST['poster']);
            $movie->setSummary($_POST['summary']);
            $movie->setRuntime($_POST['runtime']);
            $movie->setGenres($_POST['genres']);
            $movie->setCrew($_POST['crew']);
            $movie->setDirectors($_POST['directors']);
            $movie->setAwards($_POST['awards']);
        }
    } else if(isset($_POST['action']) && $_POST['action'] == "review") { // Leave a review        
        $validateMessages = Validation::validateReviewForm($_POST);

        if(count($validateMessages) == 0) {
            // Add review to DB through RestAPI call
            $newReview = json_decode(RestClient::call(REVIEW_API, "POST", $_POST));
            if($newReview == 0) { // Add review success
                $_SESSION['review_message'] = "Your review has been added";
                $_SESSION['messageSeverity'] = 'success';
            } else {
                $_SESSION['review_message'] = "Review not added! Try again later";
            }
        } else {
            $_SESSION['review_message'] = "Rating and Review required";
        }
        // Redirect to show movie detail page
        header('Location: MovieInfo.php?movieid='.$_POST['movieID']);
    } else if(isset($_POST['action']) && $_POST['action'] == "delete_review") { // Delete a review        
        // Delete review in DB through RestAPI call
        $deleteReview = json_decode(RestClient::call(REVIEW_API, "DELETE", $_POST));
        if($deleteReview) { // Delete review success
            $_SESSION['review_message'] = "Your review has been deleted";
            $_SESSION['messageSeverity'] = 'success';
        } else {
            $_SESSION['review_message'] = "Review not deleted! Try again later";
        }
        
        // Redirect to show movie detail page
        header('Location: MovieInfo.php?movieid='.$_POST['movieID']);
    } 
}

// Page header
Page::$title = "MyMDB - Movie Info";
Page::header();
Page::page_head(true);

// Render page content
if($toRender == "form") {
    Page::render_movie_form($movie, $validateMessages, $message, $messageSeverity);
} else if($toRender == "detail") {
    Page::render_movie_detail($movie, $review, $message, $messageSeverity);
}

// Page footer
Page::footer();

?>