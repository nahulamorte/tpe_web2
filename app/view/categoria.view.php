<?php

class CategoriaView {
    public $user = null;
    
    public function __construct($user) {
        $this->user = $user;
    }
    
    public function mostrarCategorias($categorias) {
        require 'templates/categorias.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}