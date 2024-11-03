<?php

require_once 'config.php';

class CategoriaModel {
    private $db;

    public function __construct() {
        $this->db = $this->conectardb();
    }

    public function getCategorias() {
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCategoria($id_categoria) {
        $query = $this->db->prepare('SELECT * FROM categorias WHERE id_categoria = ?');
        $query->execute([$id_categoria]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function getCategoriaById($id_categoria) {
        $query = $this->db->prepare('SELECT * FROM categorias WHERE id_categoria = ?');
        $query->execute([$id_categoria]);

        $categoria = $query->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }

    public function actualizarCategoria($id_categoria, $nombre, $descripcion) {
        $query = $this->db->prepare('UPDATE categorias SET nombre = ?, descripcion = ? WHERE id_categoria = ?');
        $query->execute([$nombre, $descripcion, $id_categoria]);
    }

    public function eliminarCategoria($id_categoria) {
        $query = $this->db->prepare('DELETE FROM categorias WHERE id_categoria = ?');
        $query->execute([$id_categoria]);
    }

    public function agregarCategoria($nombre, $descripcion) {
        $query = $this->db->prepare('INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)');
        $query->execute([$nombre, $descripcion]);
    }

    private function conectardb() {
        return new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB .";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
}