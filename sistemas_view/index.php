<?php
// require_once '../auth.php';
// proteger_ruta(['sistemas']); protege las rutas
 include '../src/templates/Navbar.php';
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

        </div>

        <div class="card-content cambio-card">
            <h2 class="title-card title-asignaciones">Cambios</h2>
        </div>

        <div class="card-content cancelacion-card">
            <h2 class="title-card title-asignaciones">Cancelaciones</h2>
        </div>

        <div class="card-content bajas-card">
            <h2 class="title-card title-asignaciones">Bajas</h2>
        </div>
    
    </section>

    <section class="view-reports-sistemas">

        <div class="report-info">

            <div class="report-section">
                <p class="text-info">Asignacion</p>
                <p class="text-info">Status : En Proceso</p>
                <p class="text-info">Fecha: Hoy XD</p>
            </div>

            <div class="report-section">
                <p class="text-info">Asesor: Lugo Hernandez Feernando</p>
                <p class="text-info">Area: Sistemas</p>
                <p class="text-info">Persona asignada: Lugo Hernandez Fernando</p>
            </div>

            <div class="report-section">
                <p class="text-info">Nota:</p>
                <p class="text-info"> No funciona la pici XD</p>
            </div>
        
        </div>
    </section>

    
    
</body>

</html>