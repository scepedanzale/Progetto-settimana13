<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';

session_start();

use DB_PDO\Connection as Conn;
use DB_PDO\Database as DB;
use UserDTO\User as User;

$config = require_once 'config.php';
$PDOConn = Conn::getInstance($config);
$conn = $PDOConn->getConnection();

if($_SESSION['userLogged']){
    $user = new DB($conn);
}


if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'login'){
    
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    
    $userDTO = new User($conn);
    $userDTO->login($email, $password);
     
}else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'logout'){
    session_unset();
    header('Location: index.php');
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'deleteUser'){
    $user->deleteUser($_REQUEST['id']);
}else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'addUser'){

    $firstname = strlen(htmlspecialchars(trim($_REQUEST['firstname']))) > 1 ? htmlspecialchars(trim($_REQUEST['firstname'])) : exit();
    $lastname = strlen(htmlspecialchars(trim($_REQUEST['lastname']))) > 1 ? htmlspecialchars(trim($_REQUEST['lastname'])) : exit(); 
    
    $regexEmail = '/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/m';
    preg_match_all($regexEmail, htmlspecialchars($_REQUEST['email']), $matchesEmail, PREG_SET_ORDER, 0);
    $regexPass = '/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/';
    preg_match_all($regexPass, htmlspecialchars($_REQUEST['password']), $matchesPass, PREG_SET_ORDER, 0);

    $email = $matchesEmail ? htmlspecialchars($_REQUEST['email']) : exit();
    $pass = $matchesPass ? htmlspecialchars($_REQUEST['password']) : exit(); 
    $password = password_hash($pass , PASSWORD_DEFAULT);

    $array = [
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email,
        "password" => $password,
    ];
    
    $user = new DB($conn);
    $user->addUser($array);

}else if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'updateUser'){

    $firstname = strlen(htmlspecialchars(trim($_REQUEST['firstname']))) > 1 ? htmlspecialchars(trim($_REQUEST['firstname'])) : exit();
    $lastname = strlen(htmlspecialchars(trim($_REQUEST['lastname']))) > 1 ? htmlspecialchars(trim($_REQUEST['lastname'])) : exit(); 
    
    $regexEmail = '/^((?!\.)[\w\-_.]*[^.])(@\w+)(\.\w+(\.\w+)?[^.\W])$/m';
    preg_match_all($regexEmail, htmlspecialchars($_REQUEST['email']), $matchesEmail, PREG_SET_ORDER, 0);
   
    $email = $matchesEmail ? htmlspecialchars($_REQUEST['email']) : exit();

    $array = [
        "firstname" => $firstname,
        "lastname" => $lastname,
        "email" => $email];
    
    $user->updateUser($array, $_REQUEST['id']);
}