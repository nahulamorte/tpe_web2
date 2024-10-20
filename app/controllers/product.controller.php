<?php 
    require 'app/models/products.model.php';
    require 'app/view/products.view.php';

    class productController {

        private $model;
        private $view;
    
        public function __construct() {
            $this->model = new ProductModel();
            $this->view = new productView();
        }

        function showProducts() {
            $productos = $this->model->getProducts();
            $this->view->showProducts($productos);  
        }

        public function showProductsById($id){
            $this->model->getProductById($id);
            $this->view->showProductDetail($id);
        }

        
    // Función para mostrar el detalle de un producto
    public function showProductDetail($id_producto) {
        // Obtener el producto desde el modelo
        $product = $this->model->getProductById($id_producto);

        if ($product) {
            // Cargar la vista y pasar los datos del producto
            $this->view->showProductDetail($id_producto);
        } else {
            // Si no existe el producto, mostrar un error
        }
    }


    }

?>