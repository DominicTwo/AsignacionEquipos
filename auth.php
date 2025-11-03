<?php
session_start();

function proteger_ruta(array $roles_permitidos) {

    // 1. Verificar si el usuario HA INICIADO SESIÓN
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        $_SESSION['error'] = 'Debes iniciar sesión para ver esta página.';
        header("Location: /");
        exit;
    }

    // 2. Verificar si el usuario tiene el ROL PERMITIDO
    if (!isset($_SESSION['user_rol']) || !in_array($_SESSION['user_rol'], $roles_permitidos)) {

        header("Location: /sin_permiso.php");
        exit;
    }

}
?>