<?php 
require_once 'app/model/categoria.model.php';
require_once 'app/model/product.model.php';
require_once 'app/view/categoria.view.php';

class CategoriaController {
    private $model;
    private $view;

    // conecto al modelo y a la vista
    public function __construct($res) {
        $this->model = new CategoriaModel();
        $this->view = new CategoriaView($res->user);
    }

    public function mostrarCategorias() {
        $categorias = $this->model->getCategorias();
        // Envio el array con los datos a la vista
        $this->view->mostrarCategorias($categorias);
    }

    public function eliminarCategoria($id_categoria) {
        if (!$this->comprobarSiExiste($id_categoria)) {
            return $this->view->showError('La categoria no existe');
        }

        $this->model->eliminarCategoria($id_categoria);
        // Despues de eliminar redirijo a la lista de categorias
        $this->redirigir('categorias');
    }

    public function agregarCategoria() {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el campo: nombre');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Falta completar el campo: descripcion');
        }

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];

        $this->model->agregarCategoria($nombre, $descripcion);
        $this->redirigir('categorias');
    }

    public function actualizarCategoria($id_categoria) {        
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el campo: nombre');
        }
        if (!isset($_POST['descripcion']) || empty($_POST['descripcion'])) {
            return $this->view->showError('Falta completar el campo: descripcion');
        }

        $nombre = htmlspecialchars($_POST['nombre']);
        $descripcion = htmlspecialchars($_POST['descripcion']);

        $this->model->actualizarCategoria($id_categoria, $nombre, $descripcion);
        $this->redirigir('categorias');
    }

    private function comprobarSiExiste($id_categoria) {
        return $this->model->getCategoria($id_categoria);
    }

    private function redirigir($ruta) {
        header('Location: ' . BASE_URL . $ruta);
    }
}