<?php 

class CategoriaView {
    public function showCategorias($categorias) {
        require 'templates/listacategorias.phtml';
    }

    public function showItemsByCategory($productos) {
        require 'templates/products.phtml';
    }
}