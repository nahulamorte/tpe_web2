<?php 
    require './app/models/products.model.php';
    require './app/view/products.view.php';

    class ProductController {
        private $model;
        private $view;
    
        public function __construct() {
            $this->model = new ProductModel();
            $this->view = new ProductView();
        }

        function showProducts() {
            $productos = $this->model->getProducts();
            $this->view->showProducts($productos);  
        }
    }
?>