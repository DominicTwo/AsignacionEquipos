<?php
require_once '../auth.php';
 proteger_ruta(['sistemas']); 
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
            <p class="count-asignaciones count-all">0</p>
        </div>

        <div class="card-content cambio-card">
            <h2 class="title-card title-asignaciones">Cambios</h2>
            <p class="count-cambios count-all">0</p>
        </div>
        <div class="card-content cancelacion-card">
            <h2 class="title-card title-asignaciones">Cancelaciones</h2>
            <p class="count-cancelaciones count-all">0</p>
        </div>

        <div class="card-content bajas-card">
            <h2 class="title-card title-asignaciones">Bajas</h2>
            <p class="count-bajas count-all">0</p>
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

    
    
</body>

</html>