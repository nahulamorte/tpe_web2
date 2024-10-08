<?php 
    require '../app/models/producto.model.php';
    require '../app/views/products.view.php';

    class productController {

        private $model;
        private $view;
    
        public function __construct() {
            $this->model = new ProductModel();
            $this->view = new productsView();
        }

        function showProducts() {
            $productos = $this->model->getProducts();
            $this->view->showProducts($productos);  
        }


    }

?>