<?php

$action = 'home'; // acción por defecto

if (!empty($_GET['action'])) { // si viene definida la reemplazamos
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]){
    case 'home':
        showHome();
        break;
    case 'about':
        showAbout();
        break;
    case 'item':
        if (isset($paramas[1])) $id = $params[1];
        showItem($id);
        break;
    case 'categoria':
        showCategoria()
        break;    
    defualt:
        echo('404 Page not found');
        break;
}

/*Tabla de routeo*/
/* URL / destino
/home   | showHome()
/about  | showAbout()
/items/:id  | showItems($id)
/categoria | showCategoria()