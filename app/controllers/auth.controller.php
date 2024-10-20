<?php 
require_once 'app/models/user.model.php';
require_once 'app/view/auth.view.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new UserModel();
        $this->view = new AuthView();
        session_start();  // Iniciar sesión en el constructor
    }

    // Mostrar el formulario de login
    public function showLogin($error = null){
        $this->view->showLogin($error);
    }

    public function login(){
        // Verificar que los campos de email y password estén completos
        if (empty($_POST['email']) || empty($_POST['password'])) {
            return $this->showLogin('Faltan completar los campos');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->view->showLogin('Falta completar la contraseña');
        }

        $email = $_POST['email'];
        $password = $_POST['password']; 

        // Obtener el usuario desde la base de datos
        $userFromDB = $this->model->getUserFromEmail($email);
        $userFromDB = $this->model->getUserFromEmail($email);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($userFromDB && password_verify($password, $userFromDB->password)) {
            // Iniciar sesión y almacenar datos
            $_SESSION['ID_USER'] = $userFromDB->id_usuario;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            $_SESSION['LAST_ACTIVITY'] = time();
            //User email: 'webadmin', password 'admin'  
            if($userFromDB && password_verify($password, $userFromDB->password)){
                session_start();
                $_SESSION['ID_USER'] = $userFromDB->id_usuario;
                $_SESSION['EMAIL_USER'] = $userFromDB->email;
                $_SESSION['LAST_ACTIVITY'] = time();

                // Redirigir al home o dashboard del admin
                header('Location: ' . BASE_URL . '/admin');
            } else {
                // Mostrar error si las credenciales no coinciden
                return $this->showLogin('Credenciales incorrectas');
                //Redireccion al home.
                header('Location: ' . BASE_URL);
            } 
        }
        else {
            return $this->view->showLogin('Credenciales incorrectas');
        }
    }

    // Proceso de logout

    public function logout(){
        session_destroy();  // Destruir la sesión
        header('Location: ' . BASE_URL);  // Redirigir al home
    }

    // Verificar si el usuario está logueado
    public function checkLoggedIn(){
        if (!isset($_SESSION['EMAIL_USER'])) {
            return false;  // Usuario no logueado
        }

        // Si la sesión ha estado inactiva por más de 1000 segundos, destruir la sesión
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1000)) {
            session_destroy();
            return false;  // Sesión caducada
        }

        $_SESSION['LAST_ACTIVITY'] = time();  // Actualizar el tiempo de actividad
        return true;  // Usuario logueado
    }

    // Verificar credenciales del administrador predeterminado (para pruebas)
    public function verifyAdminUser(){
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Verificar si las credenciales son las del admin de prueba
            if ($email === 'webadmin' && $password === 'admin') {
                $_SESSION['ID_USER'] = 1;  // ID ficticio para el admin
                $_SESSION['EMAIL_USER'] = $email;
                $_SESSION['LAST_ACTIVITY'] = time();

                // Redirigir al área de administración
                header('Location: ' . BASE_URL . '/admin');
            } else {
                $this->showLogin('Credenciales incorrectas para el administrador');
            }
        } else {
            $this->showLogin('Faltan completar los campos');
        }
    }
    
        // Verificar si el usuario está logueado

}
