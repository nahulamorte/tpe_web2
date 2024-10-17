<?php

require_once 'config.php';

class ProductModel {
    private $db;

    public function __construct(){
        $this->db = $this->conect();
    }

    public function getProducts() {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    private function conect() {
        return new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB .";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
}