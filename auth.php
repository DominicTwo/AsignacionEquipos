<?php
// auth.php
session_start(); // Asegura que la sesión esté iniciada en cada página

/**
 * Protege una página, verificando el login y los roles permitidos.
 *
 * @param array $roles_permitidos Un array con los roles que pueden ver la página.
 * Ej: ['admin'] o ['admin', 'sistemas']
 */
function proteger_ruta(array $roles_permitidos) {

    // 1. Verificar si el usuario HA INICIADO SESIÓN
    //    Usamos 'logged_in' que definimos en login.php
    if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        // No ha iniciado sesión. Lo mandamos al login con un error.
        $_SESSION['error'] = 'Debes iniciar sesión para ver esta página.';
        header("Location: /");
        exit;
    }

    // 2. Verificar si el usuario tiene el ROL PERMITIDO
    //    Comprobamos si el rol del usuario NO está en la lista de permitidos
    if (!isset($_SESSION['user_rol']) || !in_array($_SESSION['user_rol'], $roles_permitidos)) {
        // Sí inició sesión, pero no tiene permiso.
        // Lo mandamos a una página de "acceso denegado".
        header("Location: /sin_permiso.php");
        exit;
    }
    
    // Si pasa ambas verificaciones, el script continúa
    // y la página protegida se mostrará.
}
?>