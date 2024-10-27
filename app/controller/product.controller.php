<?php
require_once 'app/model/product.model.php';
require_once 'app/view/product.view.php';

class ProductController {
    private $model;
    private $view;

    public function __construct($res) {
        $this->model = new ProductModel();
        $this->view = new ProductView($res->user);
    }

    public function mostrarProductos() {
        $productos = $this->model->getProductos();
        $this->view->mostrarProductos($productos);
    }
    
    public function mostrarProductosPorCategoria($id_categoria) {
        $productos = $this->model->getProductosPorCategoria($id_categoria);

        // if (!$productos) {
        //     $this->view->showError('No hay productos pertenecientes a esa categoria');
        //     return;
        // }

        $this->view->mostrarProductosPorCategoria($productos);
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
            return;
        }

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

    private function comprobarSiExiste($id_producto) {
        return $this->model->getProductoPorId($id_producto);
    }

    private function redirigir($ruta) {
        header('Location: ' . BASE_URL . $ruta);
    }
}