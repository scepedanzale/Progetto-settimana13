<?php

namespace UserDTO{
    class User {
        private \PDO $conn;

        public function __construct(\PDO $conn){
            $this->conn = $conn;
        }

        public function login($email, $password){
            $sql = 'SELECT * FROM prog_13.users WHERE email = :email';
            $stm = $this->conn->prepare($sql);
            $stm->execute(['email' => $email]);
    
            if ($stm->rowCount() > 0){
                $user = $stm->fetchAll();
                if (password_verify($password, $user[0]['password'])) {
                    $_SESSION['userLogged'] = $user[0];
                    header('Location: index.php');
                }
            }
            header('Location: login.php');
        }
    }
}
