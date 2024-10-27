<?php

class UserModel {
    private $db;

    public function __construct() {
        $this->db = $this->conectardb();
    }

    public function getUser($id_usuario) {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE id_usuario = ?');
        $query->execute([$id_usuario]);
        
        // devuelvo el usuario
        return $query->fetch(PDO::FETCH_OBJ); 
    }

    private function conectardb() {
        return new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB .";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
}