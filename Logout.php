<?php
require_once("inc/config.inc.php");
require_once("inc/Utility/LoginManager.class.php");

// Remove user from session
LoginManager::logout();

// Redirect to home page
header('Location: '.HOME_PAGE);

?>