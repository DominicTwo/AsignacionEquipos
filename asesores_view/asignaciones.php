<?php
header("Refresh:180"); 

require_once '../auth.php';
proteger_ruta(['asesor']);

require '../db/db.php';
require '../src/scripts/utils.php';


$id_usuario_logueado = $_SESSION['user_id'];

$completadas = getSolicitudesPorEstatus($db, $id_usuario_logueado, 'completado');
$en_proceso = getSolicitudesPorEstatus($db, $id_usuario_logueado, 'en proceso');
$pendientes = getSolicitudesPorEstatus($db, $id_usuario_logueado, 'pendiente');

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Nueva</title>
  <link rel="stylesheet" href="/src/css/asesores/index.css">
  <link rel="stylesheet" href="/src/css/asesores/navbar.css">
  <link rel="stylesheet" href="/src/css/asesores/cardsAsignaciones.css">
  
</head>
<body>
<?php require '../src/templates/AsesoresNav.php'; ?>

     <main class="content-wrapper">
    <h1>Mis Asignaciones</h1>

    <!-- Sección: Completadas -->
<section class="seccion">
  <h2>Completadas</h2>
  <div class="fila">
    
    <?php if (empty($completadas)): ?>
        <p>No tienes solicitudes completadas.</p>
    <?php else: ?>
        <?php foreach ($completadas as $sol): ?>
        <div class="card">
            <div class="card-header">
                <h3><?php echo htmlspecialchars(ucfirst($sol['tipo'])); ?></h3>
                <span class="estatus completado"><?php echo htmlspecialchars(ucfirst($sol['estatus'])); ?></span>
            </div>
            <ul>
                <li><strong>Asesor:</strong> <?php echo htmlspecialchars($sol['nombre_asesor']); ?></li>
                <li><strong>Área:</strong> <?php echo htmlspecialchars($sol['area_destino']); ?></li>
                <li><strong>Fecha:</strong> <?php echo formatearFecha($sol['fecha_creacion']); ?></li>
                <li><strong>Persona Asignada:</strong> <?php echo htmlspecialchars($sol['nombre_asignado']); ?></li>
            </ul>
            <p class="nota"><strong>Nota:</strong> <?php echo htmlspecialchars($sol['descripcion']); ?></p>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>

  </div>
</section>

    <!-- Sección: En Proceso -->
  <section class="seccion">
  <h2>En Proceso</h2>
  <div class="fila">
    
    <?php if (empty($en_proceso)): ?>
        <p>No tienes solicitudes en proceso.</p>
    <?php else: ?>
        <?php foreach ($en_proceso as $sol): ?>
        <div class="card">
            <div class="card-header">
                <h3><?php echo htmlspecialchars(ucfirst($sol['tipo'])); ?></h3>
                <span class="estatus en-proceso"><?php echo htmlspecialchars(ucfirst($sol['estatus'])); ?></span>
            </div>
            <ul>
                <li><strong>Asesor:</strong> <?php echo htmlspecialchars($sol['nombre_asesor']); ?></li>
                <li><strong>Área:</strong> <?php echo htmlspecialchars($sol['area_destino']); ?></li>
                <li><strong>Fecha:</strong> <?php echo formatearFecha($sol['fecha_creacion']); ?></li>
                <li><strong>Persona Asignada:</strong> <?php echo htmlspecialchars($sol['nombre_asignado']); ?></li>
            </ul>
            <p class="nota"><strong>Nota:</strong> <?php echo htmlspecialchars($sol['descripcion']); ?></p>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>

  </div>
</section>
    <!-- Sección: Pendientes -->
<section class="seccion">
  <h2>Pendientes</h2>
  <div class="fila">
    
    <?php if (empty($pendientes)): ?>
        <p>No tienes solicitudes pendientes.</p>
    <?php else: ?>
        <?php foreach ($pendientes as $sol): ?>
        <div class="card">
            <div class="card-header">
                <h3><?php echo htmlspecialchars(ucfirst($sol['tipo'])); ?></h3>
                <span class="estatus pendiente"><?php echo htmlspecialchars(ucfirst($sol['estatus'])); ?></span>
            </div>
            <ul>
                <li><strong>Asesor:</strong> <?php echo htmlspecialchars($sol['nombre_asesor']); ?></li>
                <li><strong>Área:</strong> <?php echo htmlspecialchars($sol['area_destino']); ?></li>
                <li><strong>Fecha:</strong> <?php echo formatearFecha($sol['fecha_creacion']); ?></li>
                <li><strong>Persona Asignada:</strong> <?php echo htmlspecialchars($sol['nombre_asignado']); ?></li>
            </ul>
            <p class="nota"><strong>Nota:</strong> <?php echo htmlspecialchars($sol['descripcion']); ?></p>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>

  </div>
</section>

  </main>

</body>
</html>
