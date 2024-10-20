<?php
require_once "./config.php";
require_once "app/controllers/error.controller.php";

class ProductModel {


    private $db;
    private $controller;

    public function __construct(){
        $this->db = new PDO ("mysql:host=".MYSQL_HOST . ";dbname=".MYSQL_DB . ";charset=utf8", MYSQL_USER, MYSQL_PASS);
        $this->controller = new productController();
    }



    public function getProducts() {
        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function getProductById($id){
        $query = $this->db->prepare('SELECT * FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    //borra productos
    public function deleteProduct($id) {
        $query = $this->db->prepare('DELETE FROM productos WHERE id_producto = ?');
        $query->execute([$id]);
    }
    
    //agrega items
    public function addItems($id_categoria, $nombre, $descripcion, $precio, $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock, $proveedor) {
        // La consulta debe especificar las columnas en las que se insertarán los valores
        $query = $this->db->prepare('INSERT INTO productos (id_categoria, nombre, descripcion, precio, peso_neto, fecha_empaquetado, fecha_vencimiento, stock, id_proveedor) 
                                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)');
    
        // Ejecutar la consulta pasando los valores correspondientes
        return $query->execute([$id_categoria, $nombre, $descripcion, $precio, $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock, $proveedor]);
    }
    

    //edita y actualiza los productos
    public function updateProduct($id_producto, $id_categoria, $nombre, $descripcion, $precio, 
                            $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock, $proveedor) {

        // Comenzamos la consulta SQL
        $sql = 'UPDATE productos SET ';
        $params = [];

        // Agregamos los campos a actualizar solo si son diferentes de null
        if ($id_categoria !== null) {
            $sql .= 'id_categoria = ?, ';
            $params[] = $id_categoria;
        }

        if ($nombre !== null) {
            $sql .= 'nombre = ?, ';
            $params[] = $nombre;
        }

        if ($descripcion !== null) {
            $sql .= 'descripcion = ?, ';
            $params[] = $descripcion;
        }

        if ($precio !== null) {
            $sql .= 'precio = ?, ';
            $params[] = $precio;
        }

        if ($peso_neto !== null) {
            $sql .= 'peso_neto = ?, ';
            $params[] = $peso_neto;
        }

        if ($fecha_empaquetado !== null) {
            $sql .= 'fecha_empaquetado = ?, ';
            $params[] = $fecha_empaquetado;
        }

        if ($fecha_vencimiento !== null) {
            $sql .= 'fecha_vencimiento = ?, ';
            $params[] = $fecha_vencimiento;
        }

        if ($stock !== null) {
            $sql .= 'stock = ?, ';
            $params[] = $stock;
        }

        if ($proveedor !== null) {
            $sql .= 'id_proveedor = ?, ';  // Cambié a `id_proveedor` porque es la clave correcta en tu base de datos
            $params[] = $proveedor;
        }

        // Eliminar la última coma sobrante y agregar la cláusula WHERE
        $sql = rtrim($sql, ', ');
        $sql .= ' WHERE id_producto = ?';
        $params[] = $id_producto;  // Agregamos el ID del producto para la condición WHERE

        // Preparamos y ejecutamos la consulta
        $query = $this->db->prepare($sql);
        $query->execute($params);
    }


}