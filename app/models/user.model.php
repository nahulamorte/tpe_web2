<?php

require_once 'config.php';

class UserModel{
    private $db;

    public function __construct() {
        $this->db = $this->conect();
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