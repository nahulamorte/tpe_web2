<?php
class ProductView {

    function ShowLocation($action){
        header("Location: ".BASE_URL.$action);
    } 

    public function showProducts($productos){
        require 'templates/products.phtml';
    }

    public function showProductDetail($id_producto){
        require './templates/detail.phtml';
    }
} 
