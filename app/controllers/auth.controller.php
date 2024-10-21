<?php 
require_once 'app/models/user.model.php';
require_once 'app/view/auth.view.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function showLogin($error = null){
        $this->view->showLogin($error);
    }

    // Proceso de login
    public function login(){
        if (empty($_POST['email']) || empty($_POST['password'])) {
            return $this->showLogin('Faltan completar los campos');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $userFromDB = $this->model->getUserFromEmail($email);

        if ($userFromDB && password_verify($password, $userFromDB->password)) {
            $_SESSION['ID_USER'] = $userFromDB->id_usuario;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            $_SESSION['LAST_ACTIVITY'] = time();
            $_SESSION['IS_ADMIN'] = ($email === 'webadmin');  // Marcar como admin si es 'webadmin'

            if ($_SESSION['IS_ADMIN']) {
                header('Location: ' . BASE_URL . '/admin');
            } else {
                header('Location: ' . BASE_URL);
            }
            exit();
        } else {
            return $this->showLogin('Credenciales incorrectas');
        }
    }

    public function logout(){
        session_destroy();  // Destruir la sesión
        header('Location: ' . BASE_URL);  // Redirigir al home
        exit();
    }

    public function checkLoggedIn(){
        if (!isset($_SESSION['EMAIL_USER'])) {
            return false;  // Usuario no logueado
        }

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1000)) {
            session_destroy();
            return false;  // Sesión caducada
        }

        $_SESSION['LAST_ACTIVITY'] = time();  // Actualizar el tiempo de actividad
        return true;  // Usuario logueado
    }

    public function checkAdmin() {
        return isset($_SESSION['IS_ADMIN']) && $_SESSION['IS_ADMIN'] === true;
    }

    public function verifyAdminUser(){
        if (!isset($_POST['email']) || !isset($_POST['password'])) {
            return $this->showLogin('Faltan completar los campos');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email === 'webadmin' && $password === 'admin') {
            $_SESSION['ID_USER'] = 1;  // ID ficticio para el admin
            $_SESSION['EMAIL_USER'] = $email;
            $_SESSION['IS_ADMIN'] = true;
            $_SESSION['LAST_ACTIVITY'] = time();

            header('Location: ' . BASE_URL . '/admin');
            exit();
        } else {
            return $this->showLogin('Credenciales incorrectas para el administrador');
        }
    }
}