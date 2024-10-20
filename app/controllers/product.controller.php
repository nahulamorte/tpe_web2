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

    public function showProductDetail($id_producto) {
        $product = $this->model->getProductById($id_producto);

        if ($product) {
            $this->view->showProductDetail($product);
        }
    }
}