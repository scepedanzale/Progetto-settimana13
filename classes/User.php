<?php

namespace UserDTO{
    class User {
        private $conn;

        public function __construct($conn) {
            $this->conn = $conn;
        }

        // richiama tutti utenti
        public function getAllUsers() {
            $sql = 'SELECT * FROM prog_13.users';
            $res = $this->conn->query($sql, PDO::FETCH_ASSOC);
    
            if($res){
                return $res;
            }

            return null;
        }

        public function getUserByEmail(string $email) {
            $sql = 'SELECT * FROM prog_13.users WHERE email = :email';
            $stm = $this->conn->prepare($sql);
            $res = $stm->execute(['email' => $email]);
    
            if($res){
                return $stm->fetchAll();
            }

            return null;
        }
        public function getUserByID(int $id) {
            $sql = 'SELECT * FROM prog_13.users WHERE id = :id';
            $stm = $this->conn->prepare($sql);
            $res = $stm->execute(['id' => $id]);
    
            if($res){ 
                return $res;
            }

            return null;
        }

        // aggiungi utente
        public function addUser(array $user) {
            $sql = "INSERT INTO prog_13.users (firstname, lastname, email, password) VALUES (:nome, :cognome, :mail, :pass)";
            $stm = $this->conn->prepare($sql);
            $stm->execute(['nome' => $user['firstname'], 'cognome' => $user['lastname'], 'mail' => $user['email'], 'pass' => $user['password']]);
            return $stm->rowCount();
        }
        // modifica utente
        public function updateUser(array $user) {
            $sql = "UPDATE prog_13.users SET firstname = :nome, lastname = :cognome, email = :mail, password= :pass WHERE id = :id";
            $stm = $this->conn->prepare($sql);
            $stm->execute(['nome' => $user['firstname'], 'cognome' => $user['lastname'], 'mail' => $user['email'], 'pass' => $user['password']]);
            return $stm->rowCount();
        }
        // elimina utente
        public function deleteUser(int $id) {
            $sql = "DELETE FROM prog_13.users WHERE id = :id";
            $stm = $this->conn->prepare($sql);
            $stm->execute(['id' => $id]);
           return $stm->rowCount();
        }
    }
}
