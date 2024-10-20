<?php
require_once './app/controllers/product.controller.php';
require_once './app/controllers/categoria.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/about.controller.php';

$action = 'productos';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty($_GET['action'])) { 
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]){
    case 'productos':
        $controller = new ProductController();
        $controller->showProducts();
        break;
    case 'categorias':
        $controller = new CategoriaController();
        if ($authController->checkLoggedIn()) {
            if (!isset($params[1])) {
                $controller->showCategorias();
            } else if ($params[1] == 'editar' && isset($params[2])) {
                $controller->updateCategory($params[2]);
            } else if ($params[1] == 'eliminar' && isset($params[2])) {
                $controller->deleteCategory($params[2]);
            } else {
                echo "Operación no válida.";
            }
        } else {
            header('Location: ' . BASE_URL . 'showlogin');
            exit();
        }
        break;
    case 'about':
        $controller = new AboutController();
        $controller->showAbout();
        break;
    case 'agregarcategoria':
        if ($authController->checkLoggedIn()) {
            $controller = new CategoriaController();
            $controller->agregarCategoria();
        } else {
            header('Location: ' . BASE_URL . 'showlogin');
            exit();
        }
        break;
    case 'categoriaitems':
        $controller = new CategoriaController();
        $controller->showItemsByCategory($params[1]);
        break;
    case 'showlogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default:
        break;
}

/*Tabla de routeo*/
/* URL / destino
/home   | showHome()s
/about  | showAbout()
/items/:id  | showItems($id)
/categoria | showCategoria() */