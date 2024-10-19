<?php
require_once './app/models/categorias.model.php';
require_once './app/view/categorias.view.php';

class CategoriaController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new CategoriaModel();
        $this->view = new CategoriaView();
    }

    public function showCategorias() {
        $categorias = $this->model->getCategorias();
        $this->view->showCategorias($categorias);
    }

    public function showItemsByCategory($id_categoria) {
        $productos = $this->model->getItemsByCategory($id_categoria);
        $this->view->showItemsByCategory($productos);

        header('Location: ' . BASE_URL);
    }

    public function deleteCategory($id_categoria) {
        $this->model->deleteCategory($id_categoria);
        header('Location: ' . BASE_URL . 'categorias');
        exit;
    }
}