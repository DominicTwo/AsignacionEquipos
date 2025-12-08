<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
header('Content-Type: application/json');

$ruta_db = '../db/db.php';

if (!file_exists($ruta_db)) {
    echo json_encode([]); 
    exit;
}

require $ruta_db;

if (!isset($db) || $db->connect_error) {
    echo json_encode([]); 
    exit;
}

// Consulta para llenar las tarjetas con reguistros de la base de datos
$sql = "SELECT 
            s.id_solicitud,
            s.tipo,
            s.estatus,
            s.fecha_creacion,
            s.descripcion,
            s.nombre_asignado,
            s.area_destino,
            u.nombre AS nombre_solicitante
        FROM solicitudes s
        LEFT JOIN usuarios u ON s.id_usuario = u.id_usuario
        WHERE s.estatus != 'completado'
        ORDER BY s.fecha_creacion DESC";


$result = $db->query($sql);
$solicitudes = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $solicitudes[] = $row;
    }
}

echo json_encode($solicitudes);
?>