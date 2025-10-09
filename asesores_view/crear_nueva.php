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
            <h2>Asignacion</h2>
            <ul>
                <li>Asesor</li>
                <li>MediBroker</li>
                <li>Tiempo estimado 1 - 3 dias habiles</li>
            </ul>
            <input type="text" name="" id="" placeholder="Colaborador Ej. Pedrito Sola">
            <textarea aria-label="Caja de texto para respuesta" placeholder="Agrega aqui tu nota de asignacion"></textarea>
            <button class="btn btn-ok">Ok</button>
        </div>
    </main>
</body>
</html>
