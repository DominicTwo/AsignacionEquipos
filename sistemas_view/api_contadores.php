<?php
header('Content-Type: application/json');
require '../db/db.php'; 

// 1. Inicializamos la estructura base para garantizar que siempre existan los datos
//    aunque sean 0.
$tipos = ['asignacion', 'cambio', 'cancelacion', 'baja'];
$respuesta = [];

foreach ($tipos as $tipo) {
    $respuesta[$tipo] = [
        'pendiente' => 0,
        'en proceso' => 0,
        'total' => 0
    ];
}

// 2. Consulta agrupada por TIPO y ESTATUS
//    Solo contamos lo que NO está completado (según tu lógica actual)
$sql = "SELECT tipo, estatus, COUNT(*) as cantidad 
        FROM solicitudes 
        WHERE estatus != 'completado'
        GROUP BY tipo, estatus";

$resultado = $db->query($sql);

if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        $t = $fila['tipo'];       // ejemplo: 'asignacion'
        $e = $fila['estatus'];    // ejemplo: 'pendiente' o 'en proceso'
        $cant = (int)$fila['cantidad'];

        // Verificamos que el tipo exista en nuestro array para evitar errores
        if (isset($respuesta[$t])) {
            // Guardamos la cantidad específica (pendiente o en proceso)
            if (isset($respuesta[$t][$e])) {
                $respuesta[$t][$e] = $cant;
            }
            // Sumamos al total de esa categoría
            $respuesta[$t]['total'] += $cant;
        }
    }
}

// 3. Devolver JSON estructurado
echo json_encode($respuesta);
?>