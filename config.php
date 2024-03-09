<?php

return [
    "diver" => "mysql",
    "host" => "localhost",
    "user" => "root",
    "password" => "",
    "database" => "prog_13",
    "dsn" => "mysql:host = localhost; database = "
];



/* 
try {
    $conn = new PDO(
        $config['dsn'].$config['database'],
        $config['user'],
        $config['password']
    );
    $query = "CREATE DATABASE IF NOT EXISTS prog_13";

    $query = "
        CREATE TABLE IF NOT EXISTS prog_13.users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL
        )
    "; 

    $res = $conn->query($query);
    if($res){
        echo 'db creata';
    }else{
        echo 'errore';
    }

} catch (PDOException $e) {
    die("Errore di connessione: " . $e->getMessage());
}*/