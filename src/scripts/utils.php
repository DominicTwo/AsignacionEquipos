<?php
function getUsers($db) {
    $sql = "SELECT id, nombre, apellidos, correo, area, rol FROM usuarios";
    return $db->query($sql);
}

function getUsersValidate($db, $name, $password) {
    $sql = "SELECT id_usuario, nombre, apellidos, correo, password, area, rol FROM usuarios WHERE $name";
}

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
?>

