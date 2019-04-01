<?php

require_once("inc/config.inc.php");
require_once("inc/Entity/User.class.php");
require_once("inc/Utility/LoginManager.class.php");
require_once("inc/Utility/Page.class.php");

LoginManager::verifyUserLoggedin();

// Page header
Page::$title = "MyMDB - User Detail";
Page::header();
Page::page_head(true);

echo "User Detail page";

// Page footer
Page::footer();


?>