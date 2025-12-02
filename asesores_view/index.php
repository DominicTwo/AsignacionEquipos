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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php if (isset($_GET['msg'])): ?>
    <script>
      Swal.fire({
        title: '¡Solicitud Creada!',
        text: 'La solicitud se ha registrado exitosamente.',
        icon: 'success',
        confirmButtonText: 'Aceptar',
        confirmButtonColor: '#3085d6'
      }).then((result) => {
        if (result.isConfirmed || result.isDismissed) {
             window.history.replaceState(null, null, window.location.pathname);
        }
      });
    </script>
  <?php endif; ?>

</body>
</html>