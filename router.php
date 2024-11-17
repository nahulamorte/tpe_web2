<?php

require_once 'app/controller/product.controller.php';
require_once 'app/controller/categoria.controller.php';
require_once 'app/controller/about.controller.php';
require_once 'app/controller/auth.controller.php';
require_once 'libs/response.php';
require_once 'app/middleware/session.auth.middleware.php';
require_once 'app/middleware/verify.auth.middleware.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$res = new Response();

$action = 'productos';

if (!empty($_GET['action'])) { 
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch($params[0]) {
    case 'productos':
        sessionAuthMiddleware($res);
        $product_controller = new ProductController($res);
        if (isset($params[1])) {
            if ($params[1] == 'ver') {
                $product_controller->verDetalle($params[2]);
            } else {
                verifyAuthMiddleware($res);
                switch($params[1]) {
                    case 'actualizar':
                        $product_controller->actualizarProducto($params[2]); // le paso el id el resto sera recibido por get o post
                        break;
                    case 'productupdate':
                        $product_controller->showProductUpdate($params[2]);
                        break;
                    case 'eliminar':
                        $product_controller->eliminarProducto($params[2]);
                        break;
                    case 'agregar':
                        $product_controller->agregarProducto();
                        break;
                }
            }
        } else {
            $product_controller->mostrarProductos($res);
        }
        break;
    case 'categorias':
        // Si tengo un parametro extra verifico segun el caso
        sessionAuthMiddleware($res);
        $categoria_controller = new CategoriaController($res);
        if (isset($params[1])) {
            verifyAuthMiddleware($res);
            switch($params[1]) {
                case 'agregar':
                    $categoria_controller->agregarCategoria(); // lo necesario es obtenido por POST
                    break;
                case 'actualizar':
                    $categoria_controller->actualizarCategoria($params[2]); // paso el id a actualizar
                    break;
                case 'eliminar':
                    $categoria_controller->eliminarCategoria($params[2]); // paso el id a eliminar
                    break;
                case 'categoriaupdate':
                    $categoria_controller->showFormUpdate($params[2]); // recibe el id de la categoria
                    break;
                case 'verproductoscategoria':
                    $product_controller = new ProductController($res);
                    $product_controller->mostrarProductosPorCategoria($params[2]); 
                    break;
            }
        } else {
            $categoria_controller->mostrarCategorias($res);
        }
        break;
    case 'about':
        $about_controller = new AboutController($res);
        $about_controller->mostrarAbout();
        break;
    case 'showlogin': // muestra el formulario de logeo
        $auth_controller = new AuthController();
        $auth_controller->showLogin();
        break;
    case 'login': // verifica el inicio de sesion
        $auth_controller = new AuthController();
        $auth_controller->login();
        break;
    case 'logout':
        $auth_controller = new AuthController();
        $auth_controller->logout();
        break;
    default:
        break;
}