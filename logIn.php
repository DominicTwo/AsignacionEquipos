<?php
session_start();
require_once './db/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $usuario_input = $_POST['usuario'];
    $password_input = $_POST['password'];

    $sql = "SELECT id_usuario, nombre, apellidos, password, rol 
            FROM usuarios 
            WHERE (id_usuario = ? OR correo = ?) 
            AND fecha_baja IS NULL";
    
    $stmt = $db->prepare($sql);

    $stmt->bind_param("ss", $usuario_input, $usuario_input);
    
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    $user = $result->fetch_assoc();

    if ($user && password_verify($password_input, $user['password'])) {
                
        $_SESSION['user_id'] = $user['id_usuario'];
        $_SESSION['user_name'] = $user['nombre'] . ' ' . $user['apellidos'];
        $_SESSION['user_area'] = $user['area'];
        $_SESSION['user_rol'] = $user['rol'];
        $_SESSION['logged_in'] = true;

        switch ($user['rol']) {
            case 'admin':
                header("Location: /MAUI");
                break;
            case 'sistemas':
                header("Location: /sistemas_view");
                break;
            case 'asesor':
                header("Location: /asesores_view");
                break;
            default:
                $_SESSION['error'] = "Rol de usuario no reconocido.";
                header("Location: /");
                break;
        }
        
    } else {
        $_SESSION['error'] = "Usuario, contraseña incorrectos o cuenta inactiva.";
        header("Location: /");
    }

    $stmt->close();
    $db->close();
    exit;

} else {
    header("Location: /");
    exit;
}
?>