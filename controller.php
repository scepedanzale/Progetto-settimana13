<?php

require_once 'classes/Database.php';
require_once 'classes/User.php';

session_start();

use DB_PDO\Database as DB;
use UserDTO\User as U;

$config = require_once 'config.php';
$PDOConn = DB::getInstance($config);
$conn = $PDOConn->getConnection();

$userDTO = new U($conn);

if(isset($_REQUEST['action']) && $_REQUEST['action'] === 'login'){

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    
    $matchemail = $userDTO->getUserByEmail($email);
    
    if($matchemail){
        if($password == $matchemail[0]['password']){
            $_SESSION['userLogged'] = $matchemail[0];
            header('Location: index.php');
        }
    }
}

