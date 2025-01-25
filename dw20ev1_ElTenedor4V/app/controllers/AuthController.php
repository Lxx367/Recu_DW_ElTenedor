<?php
$_authController = new AuthController;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && isset($_POST["password"])) {

    $_authController->login($_POST["email"], $_POST["password"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST["type"] == "logout"){
    $_authController->logout();
}

class AuthController {

    public function login($email, $password) {
        require_once '../../persistance/DAO/UserDAO.php';
        require_once '../models/User.php';

        $userDAO = new UserDAO();
        $user = $userDAO->findByEmail($email);
        
        if ($user == null){
            header('Location: ../views/public/index.php?error=UsuarioIncorrecto');
            exit();
        }

        if ($user->verifyPassword($password)) {
            session_start();
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['type'] = $user->getType();
            header("Location: ../../index.php");
            exit();
            return true;
        }else{
            header('Location: ../views/public/index.php?error=ContraseñaIncorrecta');
            exit();
        }
        return false;
    }
    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ../views/public/index.php");
        exit();
    }
    public function getRole() {
        session_start();
        return isset($_SESSION['type']) ? $_SESSION['type'] : null;
    }
    
    public static function validateUser() {

        if (!isset($_SESSION['email']) || !isset($_SESSION['type'])) {
            return false;
        }

        $userRole = $_SESSION['email'];
        if ($userRole === 'gestor') {
            return "gestor";
        }else if ($userRole === 'admin') {
            return "admin"; 
        }
        return false; 
    }
}
