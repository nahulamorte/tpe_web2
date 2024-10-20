<?php
class ProductView {

    function ShowLocation($action){
        header("Location: ".BASE_URL.$action);
    } 

    public function showProducts($productos){
        require 'templates/products.phtml';
    }

    public function showProductDetail($product){
        require 'templates/detail.phtml';
    }
} 
