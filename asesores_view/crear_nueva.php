<?php
require_once '../auth.php';
proteger_ruta(['asesor']);

require '../db/db.php';
require '../src/scripts/utils.php';

$type = $_GET['type'] ?? 'asignacion';
$id_ref = $_GET['id_ref'] ?? null; 

$id_usuario_logueado = $_SESSION['user_id'];

$completadas = getSolicitudesPorEstatus($db, $id_usuario_logueado, 'completado');
$en_proceso  = getSolicitudesPorEstatus($db, $id_usuario_logueado, 'en proceso');
$pendientes  = getSolicitudesPorEstatus($db, $id_usuario_logueado, 'pendiente');

$lista_solicitudes = [];
$titleMain = "";

switch ($type) {
    case 'asignacion':
        $titleMain = "Asignación";
        break;

    case 'cancelacion':
        $titleMain = "Cancelación";
        $todas_activas = array_merge($pendientes, $en_proceso);
        $lista_solicitudes = array_filter($todas_activas, function($sol) {
            return $sol['tipo'] !== 'cancelacion';
        });
        break;

    case 'cambio':
        $titleMain = "Cambio";
        $lista_solicitudes = array_filter($completadas, function($sol) {
            return $sol['tipo'] === 'asignacion' || $sol['tipo'] === 'cambio';
        });
        break;

    case 'baja':
        $titleMain = "Baja";
        $lista_solicitudes = array_filter($completadas, function($sol) {
            return $sol['tipo'] === 'asignacion' || $sol['tipo'] === 'cambio';
        });
        break;

    default:
        $titleMain = "Desconocido";
        break;
}

$datos_precargados = [
    'colaborador' => '',
    'nota' => ''
];

if ($id_ref) {

    foreach ($lista_solicitudes as $sol) {
        if ($sol['id_solicitud'] == $id_ref) {
            $datos_precargados['colaborador'] = $sol['nombre_asignado'];
            $datos_precargados['nota'] = "Solicitud de " . $titleMain . " para el equipo: " . ($sol['modelo_equipo'] ?? 'N/A');
            break;
        }
    }
}

$mostrar_formulario = ($type === 'asignacion' || !empty($id_ref));

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
            cursor: pointer;
        }
        .btn-action:hover { background-color: #6a3d75; }
        .back-link { display: block; margin-bottom: 15px; color: #666; text-decoration: none; }
    </style>
</head>
<body>

    <?php require '../src/templates/AsesoresNav.php'; ?>

    <?php if (!$mostrar_formulario): ?>
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
                                <a href="?type=<?php echo $type; ?>&id_ref=<?php echo $sol['id_solicitud']; ?>" class="btn-action">
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
                
                <?php if($id_ref): ?>
                    <a href="?type=<?php echo $type ?>" class="back-link">← Volver a la lista</a>
                <?php endif; ?>

                <h2><?php echo $titleMain ?></h2>
                <ul>
                    <li><?php echo htmlspecialchars($_SESSION['user_name'] ?? 'Usuario'); ?></li>
                    <li><?php echo htmlspecialchars($_SESSION['user_area'] ?? 'Área'); ?></li>
                    <li>Tiempo estimado 1 - 3 dias hábiles</li>
                </ul>

                <form action="./procesar_asignacion.php?type=<?php echo $type ?>" method="POST">
                    
                    <?php if($id_ref): ?>
                        <input type="hidden" name="id_origen" value="<?php echo htmlspecialchars($id_ref); ?>">
                    <?php endif; ?>

                    <input type="text" 
                           name="colaborador" 
                           placeholder="Colaborador Ej. Pedrito Sola" 
                           value="<?php echo htmlspecialchars($datos_precargados['colaborador']); ?>"
                           required>

                    <textarea name="nota" 
                              aria-label="Caja de texto para respuesta" 
                              placeholder="Agrega aqui tu nota de <?php echo strtolower($titleMain); ?>" 
                              required><?php echo htmlspecialchars($datos_precargados['nota']); ?></textarea>
                    
                    <button type="submit" class="btn btn-ok">
                        Confirmar <?php echo $titleMain ?>
                    </button>
                </form>
            </div>
        </main>
    <?php endif; ?>

</body>
</html>