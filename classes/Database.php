<?php

namespace DB_PDO {
    class  Connection{
        private $conn;
        private static $instance = null;
        private function __construct(array $config){
            $this->conn = new \PDO($config['dsn'].$config['database'], $config['user'], $config['password']);
        }

        public static function getInstance(array $config){
            if(!static::$instance){
                static::$instance = new Connection($config);
            }
            return static::$instance;
        }

        public function getConnection(){
            return $this->conn;
        }

    }
    class Database{
        private \PDO $conn;

        public function __construct(\PDO $conn) {
            $this->conn = $conn;
        }

        // richiama tutti utenti
        public function getAllUsers() {
            $sql = 'SELECT * FROM prog_13.users';
            $res = $this->conn->query($sql, \PDO::FETCH_ASSOC);
    
            if($res){
                return $res;
            }
            return null;
        }

        public function getUserByID(int $id) {
            $sql = 'SELECT * FROM prog_13.users WHERE id ='.$id;
            $res = $this->conn->query($sql, \PDO::FETCH_ASSOC);
            if($res){ 
                return $res;
            }
            return null;
        }

        // aggiungi utente
        public function addUser(array $user) {
            $sql = "INSERT INTO prog_13.users (firstname, lastname, email, password) VALUES (:nome, :cognome, :mail, :pass)";
            $stm = $this->conn->prepare($sql);
            $res = $stm->execute(['nome' => $user['firstname'], 'cognome' => $user['lastname'], 'mail' => $user['email'], 'pass' => $user['password']]);
            if($res){
                header('Location: index.php');
            }
        }
        // modifica utente
        public function updateUser(array $user, int $id) {
            $sql = "UPDATE prog_13.users SET firstname = :nome, lastname = :cognome, email = :mail WHERE id = :id";
            $stm = $this->conn->prepare($sql);
            $res = $stm->execute(['nome' => $user['firstname'], 'cognome' => $user['lastname'], 'mail' => $user['email'], 'id' => $id]);
            if($res){
                header('Location: index.php');
            }
        }
        // elimina utente
        public function deleteUser(int $id) {
            $sql = "DELETE FROM prog_13.users WHERE id = :id";
            $stm = $this->conn->prepare($sql);
            $res = $stm->execute(['id' => $id]);
            if($res){
                header('Location: index.php');
            }
        }
    }
}