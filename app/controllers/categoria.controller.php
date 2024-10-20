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

    public function updateCategory($id_categoria) {
        $this->model->updateCategory($id_categoria);
        header('Location: ' . BASE_URL . 'categorias');
    }

    public function agregarCategoria() {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el título');
        }
    
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Falta completar la prioridad');
        }

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $categorias = $this->model->getCategorias();

        if (!$this->categoriaExiste($categorias, $nombre)) {
            $this->model->agregar($nombre, $descripcion);
        }

        header('Location: ' . BASE_URL . 'categorias');
    }

    private function categoriaExiste($categorias, $nombre) {
        foreach ($categorias as $categoria) {
            if ($categoria->nombre  === $nombre) {
                return true;
            }
        }
        return false;
    }
}