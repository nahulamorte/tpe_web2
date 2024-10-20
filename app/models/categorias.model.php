<?php

require_once 'config.php';

class CategoriaModel {
    private $db;

    public function __construct() {
        $this->db = $this->conect();
    }

    public function getCategorias() {
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getItemsByCategory($id_categoria) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_categoria = ?');
        $query->execute([$id_categoria]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoryById($id_categoria) {
        $query = $this->db->prepare('SELECT * FROM categorias WHERE id_categoria = ?');
        $query->execute([$id_categoria]);
    }

    public function agregar($nombre, $descripcion) {
        $query = $this->db->prepare('INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)');
        $query->execute([$nombre, $descripcion]);
    }

    public function updateCategory($id_categoria, $nombre = null, $descripcion = null) {
        $consulta = 'UPDATE categorias SET';
        $params = [];

        if ($nombre !== null) {
            $consulta.= 'nombre = ?, ';
            $params[] = $nombre;
        }

        if ($descripcion !== null) {
            $consulta.= 'descripcion = ?, ';
            $params[] = $descripcion;
        }

        $consulta = rtrim($sql, ', ');

        $sql .= ' WHERE id_categoria = ?';
        $params[] = $id_categoria;
        
        $query = $this->db->prepare($sql);
        $query->execute($params);

        $query = $db->prepare($consulta);
        $query->execute($params);
    }

    public function deleteCategory($id_categoria) {
        $query = $this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
        $query->execute([$id_categoria]);
    }

    private function conect() {
        return new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB .";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
}