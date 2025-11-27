<?php
require_once '../auth.php';
proteger_ruta(['asesor']);

require '../db/db.php';
require '../src/scripts/utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php?error=acceso_invalido');
    exit;
}

$tipo = $_GET['type'] ?? 'asignacion';
$id_usuario = $_SESSION['user_id'];
$area_destino = $_SESSION['user_area'] ?? 'General';

$colaborador = trim($_POST['colaborador']);
$nota = trim($_POST['nota']);
$id_origen = $_POST['id_origen'] ?? null;

if (empty($colaborador) || empty($nota)) {
    header("Location: index.php?type=$tipo&error=campos_vacios");
    exit;
}

$equipo_id = null;

if ($id_origen) {
    
    $sql_equipo = "SELECT equipo_id FROM solicitudes WHERE id_solicitud = ? LIMIT 1";
    $stmt_eq = $db->prepare($sql_equipo);
    
    if ($stmt_eq) {
        $stmt_eq->bind_param("i", $id_origen);
        $stmt_eq->execute();
        $res_eq = $stmt_eq->get_result();
        if ($fila = $res_eq->fetch_assoc()) {
            $equipo_id = $fila['equipo_id'];
        }
        $stmt_eq->close();
    }
    
}

$resultado = crearSolicitud(
    $db, 
    $id_usuario, 
    $tipo,          
    $colaborador,   
    $area_destino, 
    $nota,        
    $equipo_id      
);

if ($resultado['exito']) {
    header("Location: index.php?msg=solicitud_creada");
} else {
    header("Location: index.php?type=$tipo&error=error_bd");
}
exit;
?>