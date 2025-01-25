<?php

class SessionUtils {

    static function startSessionIfNotStarted() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start([
                'cookie_lifetime' => 86400,
            ]);
        }
    }

    static function destroySession() {
        $_SESSION = array();

        if (session_id() != "" || isset($_COOKIE[session_name()]))
            setcookie(session_name(), '', time() - 2592000, '/');

        session_destroy();
    }

    static function setSession($user,$tipoUser) {
        SessionUtils::startSessionIfNotStarted();
        $_SESSION['user'] = $user;
        $_SESSION['tipoUser'] = $tipoUser;

        if (!isset($_SESSION['CREATED'])) {
            $_SESSION['CREATED'] = time();
        } else if (time() - $_SESSION['CREATED'] > 1800) {
            session_regenerate_id(true);    
            $_SESSION['CREATED'] = time(); 
        }
    }
}

?>