<?php
require_once 'app/model/user.model.php';
require_once 'app/view/auth.view.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel(); // tiene el nombre de la entidad q trae de la db 
        $this->view = new AuthView();
    }

    public function showLogin() {
        $this->view->showLogin();
    }

    public function login() {
        // recibo mis datos por post
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->view->showLogin('Falto completar el campo email');
        }

        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falto completar el campo contraseña');   
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->model->getUser($email);

        if ($user && password_verify($password, $user->password)) {
            // guarda en la sesion el id del usuario
            session_start();
            $_SESSION['ID_USER'] = $user->id;
            $_SESSION['EMAIL_USER'] = $user->email;
            $_SESSION['LAST_ACTIVITY'] = time();
    
            // Redirijo al home
            header('Location: ' . BASE_URL);
        } else {
            return $this->view->showLogin('Credenciales incorrectas');
        }
    }
    
    public function logout() {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        
        header('Location: ' . BASE_URL);
    }
}