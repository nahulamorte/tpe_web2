<?php

class ProveedorModel {
    private $db;

    public function __construct() {
        $this->db = $this->conectardb();
    }

    public function getProveedores() {
        $query = $this->db->prepare('SELECT * FROM proveedores');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProveedorById($id_proveedor) {
        $query = $this->db->prepare('SELECT * FROM proveedores WHERE id_proveedor = ?');
        $query->execute([$id_proveedor]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    private function conectardb() {
        return new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB .";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
}