<?php

namespace DB_PDO {
    class  Database{
        private $conn;
        private static $instance = null;
        private function __construct(array $config){
            $this->conn = new \PDO($config['dsn'].$config['database'], $config['user'], $config['password']);
        }

        public static function getInstance(array $config){
            if(!static::$instance){
                static::$instance = new Database($config);
            }
            return static::$instance;
        }

        public function getConnection(){
            return $this->conn;
        }

    }
}