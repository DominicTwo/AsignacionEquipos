<?php
require_once '../auth.php';
proteger_ruta(['asesor']);

require '../db/db.php';
require '../src/scripts/utils.php';

$type = $_GET['type'] ?? 'asig';
$id_usuario_logueado = $_SESSION['user_id'];

// 1. Obtenemos todas las listas primero
$completadas = getSolicitudesPorEstatus($db, $id_usuario_logueado, 'completado');
$en_proceso  = getSolicitudesPorEstatus($db, $id_usuario_logueado, 'en proceso');
$pendientes  = getSolicitudesPorEstatus($db, $id_usuario_logueado, 'pendiente');

// 2. Lógica de Filtrado
$lista_solicitudes = [];
$titleMain = "";

switch ($type) {
    case 'asig':
        $titleMain = "Asignación";
        break;

    case 'undo': // Cancelación
        $titleMain = "Cancelación";
        $lista_solicitudes = array_merge($pendientes, $en_proceso);
        break;

    case 'shift': // Cambio
        $titleMain = "Cambio";
        $lista_solicitudes = array_filter($completadas, function($sol) {
            return $sol['tipo'] === 'asignacion';
        });
        break;

    case 'drop': // Baja
        $titleMain = "Baja";
        $lista_solicitudes = array_filter($completadas, function($sol) {
            return $sol['tipo'] === 'asignacion';
        });
        break;

    default:
        $titleMain = "Tipo desconocido";
        break;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión - <?php echo $titleMain ?></title>
    <link rel="stylesheet" href="/src/css/asesores/index.css">
    <link rel="stylesheet" href="/src/css/asesores/navbar.css">
    <link rel="stylesheet" href="/src/css/asesores/formsCard.css">
    <link rel="stylesheet" href="/src/css/asesores/cardsAsignaciones.css">
    <style>
        .btn-action {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #864E95;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
            font-size: 0.9rem;
        }
        .btn-action:hover { background-color: #0056b3; }
    </style>
</head>
<body>

    <?php require '../src/templates/AsesoresNav.php'; ?>

    <?php if ($type != 'asig'): ?>
        <main class="content-wrapper">
            <section class="seccion">
                <h2>Selecciona para: <?php echo htmlspecialchars($titleMain) ?></h2>
                <div class="fila">
                    
                    <?php if (empty($lista_solicitudes)): ?>
                        <p><strong>No se encontraron solicitudes aptas para <?php echo htmlspecialchars($titleMain); ?>.</strong></p>
                    <?php else: ?>
                        <?php foreach ($lista_solicitudes as $sol): ?>
                        <div class="card">
                            <div class="card-header">
                                <h3><?php echo htmlspecialchars(ucfirst($sol['tipo'])); ?></h3>
                                <span class="estatus <?php echo str_replace(' ', '-', strtolower($sol['estatus'])); ?>">
                                    <?php echo htmlspecialchars(ucfirst($sol['estatus'])); ?>
                                </span>
                            </div>
                            <ul>
                                <li><strong>Asesor:</strong> <?php echo htmlspecialchars($sol['nombre_asesor']); ?></li>
                                <li><strong>Área:</strong> <?php echo htmlspecialchars($sol['area_destino']); ?></li>
                                <li><strong>Fecha:</strong> <?php echo formatearFecha($sol['fecha_creacion']); ?></li>
                                <li><strong>Asignado a:</strong> <?php echo htmlspecialchars($sol['nombre_asignado'] ?? 'Sin asignar'); ?></li>
                                <?php if(isset($sol['modelo_equipo'])): ?>
                                    <li><strong>Equipo:</strong> <?php echo htmlspecialchars($sol['modelo_equipo']); ?></li>
                                <?php endif; ?>
                            </ul>
                            
                            <p class="nota"><strong>Nota:</strong> <?php echo htmlspecialchars($sol['descripcion']); ?></p>
                            
                            <div style="text-align: right;">
                                <a href="editar_solicitud.php?id=<?php echo $sol['id_solicitud']; ?>&accion=<?php echo $type; ?>" class="btn-action">
                                    Gestionar <?php echo $titleMain; ?>
                                </a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                </div>
            </section>
        </main>

    <?php else: ?>
        <main class="content-wrapperr">
            <div class="assignment-card">
                <h2><?php echo $titleMain ?></h2>
                <ul>
                    <li><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuario'); ?></li>
                    <li><?php echo htmlspecialchars($_SESSION['user_area'] ?? 'Área'); ?></li>
                    <li>Tiempo estimado 1 - 3 dias hábiles ñiñiñi xd</li>
                </ul>

                <form action="procesar_asignacion.php" method="POST"> <input type="text" name="colaborador" placeholder="Colaborador Ej. Pedrito Sola" required>
                    <textarea name="nota" aria-label="Caja de texto para respuesta" placeholder="Agrega aqui tu nota de asignacion" required></textarea>
                    <button type="submit" class="btn btn-ok">Ok</button>
                </form>
            </div>
        </main>
    <?php endif; ?>

</body>
</html>