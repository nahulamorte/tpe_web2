<?php

class CategoriaView {
    private $user = null;
    
    public function __construct($user) {
        $this->user = $user;
    }
    
    public function mostrarCategorias($categorias) {
        require 'templates/categorias.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }

    public function showCategoriaUpdate($categoria) {
        require 'templates/formularios/categoriasupdate.phtml';
    }
}