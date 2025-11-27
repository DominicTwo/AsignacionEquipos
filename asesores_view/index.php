<?php
require_once '../auth.php';
proteger_ruta(['asesor']);

require '../db/db.php';

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
      <a href="/asesores_view/crear_nueva.php?type=asignacion" class="card">Asignacion</a>
      <a href="/asesores_view/crear_nueva.php?type=cancelacion" class="card">Cancelación</a>
      <a href="/asesores_view/crear_nueva.php?type=cambio" class="card">Cambio</a>
      <a href="/asesores_view/crear_nueva.php?type=baja" class="card">Baja</a>
    </div>
  </main>

</body>
</html>
