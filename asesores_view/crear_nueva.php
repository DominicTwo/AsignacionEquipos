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
  <header>
    <a href="/asesores_view" class="logo">
      <img src="/src/assets/img/sistemasLogo.jpeg" alt="Logo Sistemas">
    </a>
    <div class="header-right">
      <button class="notif-btn">🔔</button>
      <a class="btn-asignaciones" href="/asesores_view/asignaciones.php">Mis Asignaciones</a>
      <div class="dropdown">
        <button class="dropdown-btn">Asesor ▾</button>
        <div class="dropdown-content">
          <a href="#">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </header>

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
