<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = $this->conectardb();
    }

    public function getUserByEmail($email) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE email = ?');
        $query->execute([$email]);
        
        // devuelvo el usuario
        return $query->fetch(PDO::FETCH_OBJ);
    }

    private function conectardb() {
        return new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB .";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
}