<?php

require_once 'config.php';

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = $this->conectardb();
    }

    public function getProductos() {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductosPorCategoria($id_categoria) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_categoria = ?');
        $query->execute([$id_categoria]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function getProductoPorId($id_producto) {
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id_producto]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function agregarProducto($id_categoria, $nombre, $descripcion, $precio, $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock, $proveedor){
        $query = $this->db->prepare('INSERT INTO productos 
        (id_categoria, nombre, precio, peso_neto, fecha_empaquetado, fecha_vencimiento, stock, id_proveedor) VALUES (?,?,?,?,?,?,?,?)');
        $query->execute([$id_categoria, $nombre, $descripcion, $precio, $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock,$proveedor]);
    }

    public function actualizarProducto($id_producto, $id_categoria, $nombre, $descripcion, $precio, $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock, $id_proveedor){
        $query = $this->db->prepare('UPDATE productos SET id_categoria = ?, nombre = ?, descripcion = ?, precio = ?, peso_neto = ?, fecha_empaquetado = ?, fecha_vencimiento = ?, stock = ?, id_proveedor = ? WHERE id_producto = ?');
        $query->execute([$id_categoria, $nombre, $descripcion, $precio, $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock, $id_proveedor, $id_producto]);
    }

    public function eliminarProducto($id_producto) {
        $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id_producto]);
    }

    private function conectardb() {
        return new PDO("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB .";charset=utf8", MYSQL_USER, MYSQL_PASS);
    }
}