<?php
// require_once '../auth.php';
// proteger_ruta(['sistemas']); protege las rutas
 require '../src/templates/NavBar.php'
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
     <main class="main-cards-sistemas">
        <section class="section-main">
            <a href="ViewAsignaciones.php" class="link-cards">
                <div class="card-content asignacion-card">
                <h2 class="title-card title-asignaciones">Asignacionesss</h2>
                </div>
            </a>
            <a href="ViewAsignaciones.php" class="link-cards">
                <div class="card-content cambio-card" >
                <h2 class="title-card">Cambios</h2>
                </div>
            </a>
            <a href="ViewAsignaciones.php" class="link-cards">
                <div class="card-content cancelacion-card">
                <h2 class="title-card">Cancelaciones</h2>
                </div>
            </a>
            <a href="ViewAsignaciones.php" class="link-cards">
                <div class="card-content bajas-card">
                <h2 class="title-card">Bajas</h2>
                </div>
            </a>
            
        </section>
    </main>       
</body>
</html>