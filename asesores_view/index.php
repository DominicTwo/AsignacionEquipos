<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Nueva</title>
  <link rel="stylesheet" href="/src/css/asesores/index.css">
  <link rel="stylesheet" href="/src/css/asesores/navbar.css">
  <link rel="stylesheet" href="/src/css/asesores/linksCards.css">
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
          <a href="/cerrarSesion.php">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <h1>Crear Nueva</h1>
    <div class="grid-container">
      <a href="/asesores_view/crear_nueva.php" class="card">Asignacion</a>
      <a href="/asesores_view/crear_nueva.php" class="card">Cancelacion</a>
      <a href="/asesores_view/crear_nueva.php" class="card">Cambio</a>
      <a href="/asesores_view/crear_nueva.php" class="card">Baja</a>
    </div>
  </main>
</body>
</html>
