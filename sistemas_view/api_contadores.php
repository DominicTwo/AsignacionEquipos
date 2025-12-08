<?php
header('Content-Type: application/json');
require '../db/db.php'; 

// 1. Array base con tus tipos exactos (singular, minúscula) inicializados en 0
$respuesta = [
    'asignacion'  => 0,
    'cambio'      => 0,
    'cancelacion' => 0,
    'baja'        => 0
];

// 2. Consulta agrupada (Muy rápida)
$sql = "SELECT tipo, COUNT(*) as total 
        FROM solicitudes 
        WHERE estatus != 'completado' 
        GROUP BY tipo";

$resultado = $db->query($sql);
if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $tipo = $fila['tipo'];
        // Actualizar el conteo en el array de respuesta
        if (isset($respuesta[$tipo])) {
            $respuesta[$tipo] = $fila['total'];
        }
    }
}

// 3. Devolver JSON limpio
echo json_encode($respuesta);
?>