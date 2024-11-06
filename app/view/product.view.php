<?php

class ProductView {
    private $user = null;
    
    public function __construct($user) {
        $this->user = $user;
    }

    public function mostrarProductos($productos, $proveedores, $categorias) {
        require 'templates/productos.phtml';
    }

    public function mostrarProducto($producto) {
        require 'templates/detalle.phtml';
    }

    public function mostrarProductosPorCategoria($productos, $proveedores, $categorias) {
        require 'templates/productos.phtml';
    }

    public function showProductUpdate($producto, $categorias, $proveedores) {
        require 'templates/formularios/productosupdate.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}