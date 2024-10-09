<?php 
require_once '../models/user.model.php';
require_once '../views/auth.view.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin(){
        //Muestro el formulario
        $this->view->showLogin();
    }

    public function login(){
        if (!isset($_POST['email']) || empty($_POST['email'])){
            return $this->view->showLogin('Falta completar el nombre de usuario');
        }


    $email = $_POST['email'];
    $password = $_POST['password']; 

    $userFromDB = $this->model->getUserFromEmail($email);

    //User email: 'webadmin', password 'admin'  
    if($userFromDB && password_verify($password, $userFromDB->password)){
        session_start();
        $_SESSION['ID_USER'] = $userFromDB->id;
        $_SESSION['EMAIL_USER'] = $userFromDB->email;
        $_SESSION['LAST_ACTIVITY'] = time();

        //Redireccion al home.
        header('Location: ' . BASE_URL);
    } else {
        return $this->view->showLogin('Credenciales incorrectas');
        }
    }


    public function logout(){
        session_start();
        session_destroy();
        header('Location: ' . BASE_URL); //Redireccion al home
    }
}
