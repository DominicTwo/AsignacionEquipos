<?php

require '../db/db.php';

$mensaje = ""; // Inicializamos la variable vacía
if ($db->connect_error) {
    // En producción, evita mostrar el error técnico exacto al usuario final
    $mensaje = "Error de conexión: " . $db->connect_error;
} else {
    $mensaje = "Conexión exitosa a la base de datos.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Conexión</title>
</head>
<body>
    
    <h1>
        <?php echo $mensaje; ?>
    </h1>

</body>
</html>