<?php

require_once 'app/model/product.model.php';
require_once 'app/model/proveedor.model.php';
require_once 'app/model/categoria.model.php';
require_once 'app/view/product.view.php';

class ProductController {
    private $model;
    private $view;
    private $proveedoresModel;
    private $categoriasModel;

    public function __construct($res) {
        $this->model = new ProductModel();
        $this->proveedorModel = new ProveedorModel();
        $this->categoriasModel = new CategoriaModel();
        $this->view = new ProductView($res->user);
    }

    public function mostrarProductos() {
        $productos = $this->model->getProductos();
        $proveedores = $this->proveedorModel->getProveedores();
        $categorias = $this->categoriasModel->getCategorias();

        if (!$proveedores) {
            return $this->view->showError('No se pudo obtener la lista de proveedores');
        }

        if (!$categorias) {
            return $this->view->showError('No se pudo obtener la lista de categorias');
        }

        if (!$productos) {
            return $this->view->showError('No se pudo obtener la lista de productos');
        }

        foreach($productos as $producto) {
            $categoria = $this->categoriasModel->getCategoriaById($producto->id_categoria);
            $producto->nombreCategoria = $categoria->nombre;
        }

        $this->view->mostrarProductos($productos, $proveedores, $categorias);
    }
    
    public function mostrarProductosPorCategoria($id_categoria) {
        $proveedores = $this->proveedorModel->getProveedores();
        $categorias = $this->categoriasModel->getCategorias();
        $productos = $this->model->getProductosPorCategoria($id_categoria);

        foreach($productos as $producto) {
            $categoria = $this->categoriasModel->getCategoriaById($producto->id_categoria);
            $producto->nombreCategoria = $categoria->nombre;
        }

        $this->view->mostrarProductosPorCategoria($productos, $proveedores, $categorias);
    }

    public function verDetalle($id_producto) {
        $producto = $this->model->getProductoPorId($id_producto);

        if (!$producto) {
            $this->view->showError('El producto elegido no existe');
        }

        $this->view->mostrarProducto($producto);
    }

    public function agregarProducto() {
        if (empty($_POST['id_categoria']) || empty($_POST['nombre']) || empty($_POST['descripcion']) ||
            empty($_POST['precio']) || empty($_POST['peso_neto']) || empty($_POST['fecha_empaquetado']) ||
            empty($_POST['fecha_vencimiento']) || empty($_POST['stock']) || empty($_POST['proveedor']))
        {
            return $this->view->showError('Falta completar un campo');
        }

        // seria mejor gestionar los posibles campos vacios mostrando mensajes individuales de cual es el que fallo

        $id_categoria = $_POST['id_categoria'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $peso_neto = $_POST['peso_neto'];
        $fecha_empaquetado = $_POST['fecha_empaquetado'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'];
        $stock = $_POST['stock'];
        $proveedor = $_POST['proveedor'];

        $this->model->agregarProducto($id_categoria, $nombre, $descripcion, $precio, $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock, $proveedor);
        $this->redirigir('productos');
    }

    public function eliminarProducto($id_producto) {
        if (!$this->comprobarSiExiste($id_producto)) {
            return $this->view->showError('El producto no se puede eliminar');
        }

        $this->model->eliminarProducto($id_producto);
        $this->redirigir('productos');
    }

    public function showProductUpdate($id_producto) {
        $producto = $this->model->getProductoPorId($id_producto);
        $proveedores = $this->proveedorModel->getProveedores();
        $categorias = $this->categoriasModel->getCategorias();

        if (!$producto) {
            return $this->view->showError('El producto seleccionado no existe en la db');
        }

        if (!$proveedores) {
            return $this->view->showError('No se pudo obtener la lista de proveedores');
        }

        if (!$categorias) {
            return $this->view->showError('No se pudo obtener la lista de categorias');
        }

        $this->view->showProductUpdate($producto, $categorias, $proveedores);
    }

    public function actualizarProducto($id_producto) {
        if (!isset($_POST['id_categoria']) || empty($_POST['id_categoria'])) {
            return $this->view->showError('Falta completar la categoría');
        }
        
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Falta completar la descripción');
        }
        
        if (!isset($_POST['precio']) || empty($_POST['precio'])) {
            return $this->view->showError('Falta completar el precio');
        }
        
        if (!isset($_POST['peso_neto']) || empty($_POST['peso_neto'])) {
            return $this->view->showError('Falta completar el peso neto');
        }
        
        if (!isset($_POST['fecha_empaquetado']) || empty($_POST['fecha_empaquetado'])) {
            return $this->view->showError('Falta completar la fecha de empaquetado');
        }
        
        if (!isset($_POST['fecha_vencimiento']) || empty($_POST['fecha_vencimiento'])) {
            return $this->view->showError('Falta completar la fecha de vencimiento');
        }
        
        if (!isset($_POST['stock']) || empty($_POST['stock'])) {
            return $this->view->showError('Falta completar el stock');
        }
        
        if (!isset($_POST['id_proveedor']) || empty($_POST['id_proveedor'])) {
            return $this->view->showError('Falta completar el proveedor');
        }
        
        // comprobar si existen el proveedor y la categoria

        $categoriaExiste = $this->categoriasModel->getCategoriaById($_POST['id_categoria']);
        $proveedorExisite = $this->proveedorModel->getProveedorById($_POST['id_proveedor']); 

        if (!$categoriaExiste && !$proveedorExiste) {
            return $this->view->showError('La categoria o el proveedor no existen, intentelo otra vez!');
        }

        $id_categoria = $_POST['id_categoria'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $peso_neto = $_POST['peso_neto'];
        $fecha_empaquetado = $_POST['fecha_empaquetado'];
        $fecha_vencimiento = $_POST['fecha_vencimiento'];
        $stock = $_POST['stock'];
        $id_proveedor = $_POST['id_proveedor'];

        $this->model->actualizarProducto($id_producto, $id_categoria, $nombre, $descripcion, $precio, $peso_neto,
                                            $fecha_empaquetado, $fecha_vencimiento, $stock, $id_proveedor);    
                                            
        $this->redirigir('productos');
    }

    private function comprobarSiExiste($id_producto) {
        return $this->model->getProductoPorId($id_producto);
    }

    private function redirigir($ruta) {
        header('Location: ' . BASE_URL . $ruta);
    }
}