<?php

require_once('../inc/config.inc.php');
require_once('../inc/Entity/Review.class.php');
require_once('../inc/Utility/PDOAgent.class.php');
require_once('../inc/EntityMapper/ReviewMapper.class.php');

ReviewMapper::initialize();

// Pull request data from the input stream
parse_str(file_get_contents('php://input'), $requestData);

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        
        
        break;
    case 'POST':
        

        break;
    case 'PUT':
        

        break;
    case 'DELETE':        
        

        break;
}

?>