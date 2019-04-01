<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Page.class.php");

LoginManager::verifyUserLoggedin();

// Page header
Page::$title = "MyMDB - Movie List";
Page::header();
Page::page_head(true);

// TODO: get movies list based on search term in POST
$movies = array();

Page::render_movie_list($movies);

// Page footer
Page::footer();


?>