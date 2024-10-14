<?php
require_once './app/controllers/product.controller.php';

$action = 'productos';

// base_url para redirecciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

if (!empty($_GET['action'])) { 
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]){
    case 'productos':
        $controller = new productController;
        $controller->showProducts();
        break;

    // case 'item':
    //     if (isset($paramas[1])) $id = $params[1];
    //     showItem($id);
    //     break;
    // case 'categoria':
    //     showCategoria();
    //     break;    
    default:
        $controller = new productController();
        // $controller-> showError();
        //echo('404 Page not found');//HACER TEMPLATE PARA ERROR 
        break;
}

/*Tabla de routeo*/
/* URL / destino
/home   | showHome()
/about  | showAbout()
/items/:id  | showItems($id)
/categoria | showCategoria() */