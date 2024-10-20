<?php 

require 'app/models/products.model.php';
require 'app/view/products.view.php';

    class productController {

        private $model;
        private $view;
        private $authController;
    
        public function __construct() {
            $this->model = new ProductModel();
            $this->view = new productView();
            $this->authController = new AuthController();
        }

    function showProducts() {
        $productos = $this->model->getProducts();
        $this->view->showProducts($productos);  
    }

        public function showProductsById($id){
            $this->model->getProductById($id);
            $this->view->showProductDetail($id);
        }

        
        public function showProductDetail($id_producto) {
            $product = $this->model->getProductById($id_producto);

            if ($product) {
                $this->view->showProductDetail($id_producto);
            } else {
            }
        }

        public function addProduct() {
            if (!$this->authController->checkLoggedIn()) {
                header('Location: ' . BASE_URL . '/login');
                exit();
            }
            if (!isset($_POST['id_categoria']) || !isset($_POST['nombre']) || !isset($_POST['descripcion']) ||
                !isset($_POST['precio']) || !isset($_POST['peso_neto']) || !isset($_POST['fecha_empaquetado']) ||
                !isset($_POST['fecha_vencimiento']) || !isset($_POST['stock']) || !isset($_POST['proveedor'])) {
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

            $success = $this->model->addItems($id_categoria, $nombre, $descripcion, $precio, $peso_neto,
                                            $fecha_empaquetado, $fecha_vencimiento, $stock, $proveedor);

                header('Location: ' . BASE_URL . '/productos');
        }

            public function deleteCategory($id) {
                if (!$this->authController->checkLoggedIn()) {
                    header('Location: ' . BASE_URL . '/login');
                    exit();
                }

                $this->model->deleteProduct($id);
                header('Location: ' . BASE_URL . 'categorias');
                exit;
            }
        
            public function updateProduct($id_producto, $id_categoria, $nombre, $descripcion, $precio, 
            $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock, $proveedor) {
                
                if (!$this->authController->checkLoggedIn()) {
                    header('Location: ' . BASE_URL . '/login');
                    exit();
                }
                
                $this->model->updateProduct($id_producto, $id_categoria, $nombre, $descripcion, $precio, 
                $peso_neto, $fecha_empaquetado, $fecha_vencimiento, $stock, $proveedor);
                header('Location: ' . BASE_URL . 'categorias');
            }


    }

?>