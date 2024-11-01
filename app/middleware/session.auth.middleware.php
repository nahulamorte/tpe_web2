<?php
    function sessionAuthMiddleware($res) {
        session_start();
        if (isset($_SESSION['ID'])) {
            $res->user = new stdClass();
            $res->user->id_usuario = $_SESSION['ID'];
            $res->user->usuario = $_SESSION['USUARIO'];
            $res->user->rol = $_SESSION['ROL'];
            return;
        }
    }
?>