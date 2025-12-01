<?php
 // require_once '../auth.php';
 // proteger_ruta(['sistemas']); 
    include '../src/templates/Navbar.php';
    require '../db/db.php';

    $totalAsignaciones = 0;
    $totalCambios = 0;
    $totalCancelaciones = 0;
    $totalBajas = 0;
    

    // Consulta para obtener los totales de cada tipo de solicitud pendiente
    $sql = "SELECT 
                SUM(CASE WHEN tipo = 'asignacion' THEN 1 ELSE 0 END) as total_asignaciones,
                SUM(CASE WHEN tipo = 'cambio'     THEN 1 ELSE 0 END) as total_cambios,
                SUM(CASE WHEN tipo = 'cancelacion' THEN 1 ELSE 0 END) as total_cancelaciones,
                SUM(CASE WHEN tipo = 'baja'       THEN 1 ELSE 0 END) as total_bajas
            FROM solicitudes 
            WHERE estatus = 'pendiente'";
    //Obtener los resultados de la consulta
    $resultado = $db->query($sql);

    if ($resultado) {
        $fila = $resultado->fetch_assoc();

        $totalAsignaciones  = intval($fila['total_asignaciones']);
        $totalCambios       = intval($fila['total_cambios']);
        $totalCancelaciones = intval($fila['total_cancelaciones']);
        $totalBajas         = intval($fila['total_bajas']);
    }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../src/css/sistemas/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <section class="main-cards-sistemas">       
              
        <div class="card-content asignacion-card">
            <h2 class="title-card title-asignaciones">Asignaciones</h2>
            <p class="count-asignaciones count-all"><?php echo $totalAsignaciones ?></p>
        </div>

        <div class="card-content cambio-card">
            <h2 class="title-card title-asignaciones">Cambios</h2>
            <p class="count-cambios count-all"><?php echo $totalCambios ?></p>
        </div>
        <div class="card-content cancelacion-card">
            <h2 class="title-card title-asignaciones">Cancelaciones</h2>
            <p class="count-cancelaciones count-all"><?php echo $totalCancelaciones ?></p>
        </div>

        <div class="card-content bajas-card">
            <h2 class="title-card title-asignaciones">Bajas</h2>
            <p class="count-bajas count-all"><?php echo $totalBajas ?></p>
        </div>
    
    </section>

    <section class="view-reports-sistemas">

        <div class="report-info">
            <div class="report-section"> 
                <div class="report-column">
                    <p class="text-info">Tipo de solicitud:</p>
                    <p class="text-info">Status:</p>
                    <p class="text-info">Fecha:</p>
                </div>
                <div class="report-column">
                    <p class="text-info">Asignacion</p>
                    <p class="text-info">En Proceso</p>
                    <p class="text-info">Hoy XD</p>
                </div>
            </div>
            <div class="report-section">
                <div class="report-column">
                    <p class="text-info">Asesor:</p>
                    <p class="text-info">Area:</p>
                    <p class="text-info">Persona asignada:</p>
                </div>
                <div class="report-column">
                    <p class="text-info">Lugo Hernandez Fernando</p>
                    <p class="text-info">Sistemas</p>
                    <p class="text-info">Lugo Hernandez Fernando</p>
                </div>
            </div>
            <div class="report-section">   
                <div class="report-column">
                    <p class="text-info">Nota:</p>
                </div>
                 <div class="report-column">
                    <p class="text-info">No funciona la pici xd</p>
                </div>
            </div>
        </div>
        

    </section>
    <h1>
    </h1>
    
    
</body>

</html>