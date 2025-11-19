<?php

// Obtiene las solicitudes por estatus
function getSolicitudesPorEstatus($db, $id_usuario, $estatus) {
    
    $sql = "SELECT 
                s.id_solicitud,
                s.tipo,
                s.estatus,
                s.descripcion,
                s.fecha_creacion,
                s.nombre_asignado,
                s.area_destino, 
                u.nombre AS nombre_asesor,
                i.marca AS marca_equipo,
                i.modelo AS modelo_equipo
            FROM 
                solicitudes s
            JOIN 
                usuarios u ON s.id_usuario = u.id_usuario
            LEFT JOIN 
                inventario i ON s.equipo_id = i.id_equipo
            WHERE 
                s.id_usuario = ? 
            AND 
                s.estatus = ?
            ORDER BY 
                s.fecha_creacion DESC";

    $stmt = $db->prepare($sql);
    if ($stmt === false) {
        return [];
    }

    $stmt->bind_param("ss", $id_usuario, $estatus);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $solicitudes = []; 

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $solicitudes[] = $row; 
        }
    }
    
    $stmt->close();
    return $solicitudes;
}

// Crea una solicitud
function crearSolicitud($db, $id_usuario, $tipo, $nombre_asignado, $area_destino, $descripcion, $equipo_id = null) {
    
    // 1. Definimos la consulta SQL
    $sql = "INSERT INTO solicitudes (id_usuario, tipo, nombre_asignado, area_destino, descripcion, equipo_id) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    // 2. Preparamos la sentencia
    $stmt = $db->prepare($sql);
    
    if (!$stmt) {
        return ["exito" => false, "mensaje" => "Error en la preparación de la consulta: " . $db->error];
    }

    // 3. Vinculamos los parámetros (s = string, i = integer)

    $stmt->bind_param("sssssi", $id_usuario, $tipo, $nombre_asignado, $area_destino, $descripcion, $equipo_id);

    // 4. Ejecutamos
    if ($stmt->execute()) {
        $id_nuevo = $stmt->insert_id;
        $stmt->close();
        return ["exito" => true, "mensaje" => "Solicitud creada correctamente", "id" => $id_nuevo];
    } else {
        $error = $stmt->error;
        $stmt->close();
        return ["exito" => false, "mensaje" => "Error al ejecutar la inserción: " . $error];
    }
}

// Formatea la fecha de la BD
function formatearFecha($fecha_db) {
    if (!$fecha_db) {
        return 'N/A';
    }
    $fecha = new DateTime($fecha_db);
    return $fecha->format('d/m/Y - h:i A');
}
?>

