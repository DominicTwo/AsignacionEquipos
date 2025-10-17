<?php
require '../db/db.php';
require '../src/scripts/utils.php';

$resultado = getUsers($db);


    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            echo $fila['nombre'] . " " . $fila['apellidos'] . " - " . $fila['area'] . " (" . $fila['rol'] . ")<br>";
        }
    } else {
        echo "No hay usuarios registrados.";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Nueva</title>
  <link rel="stylesheet" href="/src/css/asesores/index.css">
  <link rel="stylesheet" href="/src/css/asesores/navbar.css">
  <link rel="stylesheet" href="/src/css/asesores/linksCards.css">
</head>
<body>

<?php require '../src/templates/AsesoresNav.php'; ?>

  <main>
    <h1>Crear Nueva</h1>
    <div class="grid-container">
      <a href="/asesores_view/crear_nueva.php?type=asig" class="card">Asignacion</a>
      <a href="/asesores_view/crear_nueva.php?type=undo" class="card">Cancelación</a>
      <a href="/asesores_view/crear_nueva.php?type=shift" class="card">Cambio</a>
      <a href="/asesores_view/crear_nueva.php?type=drop" class="card">Baja</a>
    </div>
  </main>
</body>
</html>
