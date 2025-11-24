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

    <?php  ?>

     <main class="main-cards-sistemas">       
              
        <div class="card-content asignacion-card">
            <h2 class="title-card title-asignaciones">Asignaciones</h2>
        </div>

        <div class="card-content cambios-card">
            <h2 class="title-card title-asignaciones">Cambios</h2>
        </div>

        <div class="card-content cancelaciones-card">
            <h2 class="title-card title-asignaciones">Cancelaciones</h2>
        </div>

        <div class="card-content bajas-card">
            <h2 class="title-card title-asignaciones">Bajas</h2>
        </div>

    </main>       
</body>

</html>