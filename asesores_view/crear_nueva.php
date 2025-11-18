<?php
require_once '../auth.php';
proteger_ruta(['asesor']);

$type = $_GET['type'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva</title>
    <link rel="stylesheet" href="/src/css/asesores/index.css">
    <link rel="stylesheet" href="/src/css/asesores/navbar.css">
    <link rel="stylesheet" href="/src/css/asesores/formsCard.css">
</head>

<body>
    <?php require '../src/templates/AsesoresNav.php'; ?>

<main class="content-wrapper">
    <div class="assignment-card">
        <h2>
            <?php
                switch ($type) {
                    case 'asig':
                        echo "Asignación";
                        break;
                    case 'undo':
                        echo "Cancelación";
                        break;
                    case 'shift':
                        echo "Cambio";
                        break;
                    case 'drop':
                        echo "Baja";
                        break;
                    default:
                        echo "Tipo desconocido.";
                        break;
                }
            ?>
        </h2>
        
        <ul>
            <li><?php echo htmlspecialchars($_SESSION['user_name']); ?></li>
            <li><?php echo htmlspecialchars($_SESSION['user_area']); ?></li>
            <li>Tiempo estimado 1 - 3 dias habiles</li>
        </ul>

        <?php if ($type != 'asig'): ?>
            
            <div class="data-card-details">
                <p><strong>Estado actual:</strong> Procesando solicitud...</p>
                <p><strong>Detalles:</strong> Aquí irían los datos de lectura.</p>
            </div>

        <?php else: ?>

            <form action="">
                <input type="text" name="" id="" placeholder="Colaborador Ej. Pedrito Sola">
                <textarea aria-label="Caja de texto para respuesta" placeholder="Agrega aqui tu nota de asignacion"></textarea>
                <button type="submit" class="btn btn-ok" disabled>Ok</button>
            </form>

        <?php endif; ?>
        
    </div>
</main>

</body>

</html>