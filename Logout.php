<?php
require_once("inc/config.inc.php");
require_once("inc/Utility/LoginManager.class.php");

LoginManager::logout();

header('Location: '.HOME_PAGE);

?>