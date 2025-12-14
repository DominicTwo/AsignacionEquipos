<?php
// Archivo: api_cambiar_estatus.php
header('Content-Type: application/json');
require '../db/db.php'; 

//Recibir los datos enviados por JS 
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['id']) || !isset($input['estatus'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

$id_solicitud = $db->real_escape_string($input['id']);
$nuevo_estatus = $db->real_escape_string($input['estatus']);

// Verificar el estatus actual en la BD 
$sqlCheck = "SELECT estatus FROM solicitudes WHERE id_solicitud = '$id_solicitud'";
$resCheck = $db->query($sqlCheck);
$row = $resCheck->fetch_assoc();
$estatus_actual = $row['estatus'];

$puede_cambiar = false;

// Replicamos la lógica de negocio aquí:
if ($estatus_actual == 'pendiente' && $nuevo_estatus == 'en proceso') {
    $puede_cambiar = true;
} 
elseif ($estatus_actual == 'en proceso' && $nuevo_estatus == 'completado') {
    $puede_cambiar = true;
}

if (!$puede_cambiar) {
    echo json_encode(['success' => false, 'message' => "Cambio de '$estatus_actual' a '$nuevo_estatus' no permitido."]);
    exit;
}
// Ejecutar el UPDATE
$sqlUpdate = "UPDATE solicitudes SET estatus = '$nuevo_estatus' WHERE id_solicitud = '$id_solicitud'";

if ($db->query($sqlUpdate)) {
    echo json_encode(['success' => true, 'message' => 'Estatus actualizado']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $db->error]);
}
?>