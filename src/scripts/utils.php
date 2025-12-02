<?php

// Obtiene las solicitudes por estatus
function getSolicitudesPorEstatus($db, $id_usuario, $estatus, $procesado = 0) {
    
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
                s.estatus = ? 
            AND 
                s.procesado = ?";

    if ($id_usuario !== null) {
        $sql .= " AND s.id_usuario = ?";
    }

    $sql .= " ORDER BY s.fecha_creacion DESC";

    $stmt = $db->prepare($sql);
    if ($stmt === false) {
        return [];
    }

    if ($id_usuario !== null) {

        $stmt->bind_param("sis", $estatus, $procesado, $id_usuario);
    } else {
        $stmt->bind_param("si", $estatus, $procesado);
    }
    
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
function crearSolicitud($db, $id_usuario, $tipo, $nombre_asignado, $area_destino, $descripcion, $equipo_id = null, $id_origen = null) {
    
    $sql = "INSERT INTO solicitudes (id_usuario, tipo, nombre_asignado, area_destino, descripcion, equipo_id) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    $stmt = $db->prepare($sql);
    
    if (!$stmt) {
        return ["exito" => false, "mensaje" => "Error en la preparación de la consulta: " . $db->error];
    }

    $stmt->bind_param("sssssi", $id_usuario, $tipo, $nombre_asignado, $area_destino, $descripcion, $equipo_id);

    if ($stmt->execute()) {
        $id_nuevo = $stmt->insert_id;
        $stmt->close();

        if ($id_origen !== null) {
            $sql_update = "UPDATE solicitudes SET procesado = 1 WHERE id_solicitud = ?";
            $stmt_update = $db->prepare($sql_update);
            
            if ($stmt_update) {
                $stmt_update->bind_param("i", $id_origen);
                $stmt_update->execute();
                $stmt_update->close();
            }
        }

        return ["exito" => true, "mensaje" => "Solicitud creada correctamente", "id" => $id_nuevo];
    } else {
        $error = $stmt->error;
        $stmt->close();
        return ["exito" => false, "mensaje" => "Error al ejecutar la inserción: " . $error];
    }
}


// Actualiza el estatus de la asignación
function actualizarEstatus($bd, $idSolicitud, $nuevoEstatus) {
    $estatusPermitidos = ['pendiente', 'en proceso', 'completado'];

    if (!in_array($nuevoEstatus, $estatusPermitidos)) {
        return "Error: El estatus no es válido.";
    }

    $sql = "UPDATE solicitudes SET estatus = ? WHERE id_solicitud = ?";

    if ($stmt = mysqli_prepare($bd, $sql)) {
        
        mysqli_stmt_bind_param($stmt, "si", $nuevoEstatus, $idSolicitud);

        if (mysqli_stmt_execute($stmt)) {
            $filas = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            
            if ($filas > 0) {
                return true;
            } else {
                return "No hubo cambios (ID incorrecto o el estatus ya era ese).";
            }
        } else {
            $error = mysqli_error($bd);
            mysqli_stmt_close($stmt);
            return "Error al ejecutar: " . $error;
        }
    } else {
        return "Error en la consulta: " . mysqli_error($bd);
    }
}

function formatearFecha($fecha_db) {
    if (!$fecha_db) {
        return 'N/A';
    }
    $fecha = new DateTime($fecha_db);
    return $fecha->format('d/m/Y - h:i A');
}
?>  