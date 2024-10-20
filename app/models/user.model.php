<?php

require_once 'config.php';

class UserModel{
    private $db;

    public function __construct() {
        $this->db = $this->conect();
    }

    // Función para registrar un nuevo usuario
    public function registerUser($email, $password) {
        // Hashear la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta de inserción
        $query = $this->db->prepare('INSERT INTO usuarios (email, password) VALUES (?, ?)');

        // Ejecutar la consulta con los parámetros correspondientes
        return $query->execute([$email, $passwordHash]);
    }

    public function getUserFromEmail($email) {
        $query = $this->db->prepare("SELECT * FROM 'usuarios' WHERE email = ?");
        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }

    private function conect() {
        return new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB .";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
}