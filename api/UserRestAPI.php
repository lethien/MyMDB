<?php

require_once('../inc/config.inc.php');
require_once('../inc/Entity/User.class.php');
require_once('../inc/Utility/PDOAgent.class.php');
require_once('../inc/EntityMapper/UserMapper.class.php');

UserMapper::initialize();

// Pull request data from the input stream
parse_str(file_get_contents('php://input'), $requestData);

switch($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($requestData['id'])) {
            // Get all requested user from database
            $user = UserMapper::getUser($requestData['id']);

            // Serialize the user
            $serializedUser = ($user != false) ? $user->jsonSerialize() : null;

            // Return the serialized user
            header("Content-Type: application/json");
            echo json_encode($serializedUser);
        } else if(isset($requestData['username'])) {
            // Get all requested user from database
            $user = UserMapper::getUserName($requestData['username']);

            // Serialize the user
            $serializedUser = ($user != false) ? $user->jsonSerialize() : null;

            // Return the serialized user
            header("Content-Type: application/json");
            echo json_encode($serializedUser);
        } else {
            // Get all users from database
            $users = UserMapper::getUsers();

            // Serialize all users into another array
            $serializedUsers = array();
            foreach($users as $u) {
                $serializedUsers[] = $u->jsonSerialize();
            }

            // Return the serialized users array
            header("Content-Type: application/json");
            echo json_encode($serializedUsers);
        }
        
        break;
    case 'POST':
        $user = new User();
        $user->setUserName($requestData['newusername']);
        $user->setNewPassword($requestData['newpassword']);
        $user->setEmail($requestData['newemail']);

        $nuID = UserMapper::addUser($user);
        header("Content-Type: application/json");
        echo json_encode($nuID);

        break;
    case 'PUT':
        $user = new User();
        $user->setUserID($requestData['id']);
        $user->setUserName($requestData['username']);
        $user->setPassword($requestData['password']);
        $user->setEmail($requestData['email']);

        $result = UserMapper::updateUser($user);
        header("Content-Type: application/json");
        echo json_encode($result);

        break;
    case 'DELETE':        
        $result = UserMapper::deleteUser($requestData['id']);
        header("Content-Type: application/json");
        echo json_encode($result);

        break;
}

?>