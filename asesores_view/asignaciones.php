<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Nueva</title>
  <link rel="stylesheet" href="/src/css/asesores/index.css">
  <link rel="stylesheet" href="/src/css/asesores/navbar.css">
  <link rel="stylesheet" href="/src/css/asesores/cardsAsignaciones.css">
  
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

     <main class="content-wrapper">
    <h1>Mis Asignaciones</h1>

    <!-- Sección: Completadas -->
    <section class="seccion">
      <h2>Completadas</h2>
      <div class="fila">
        <div class="card">
          <div class="card-header">
            <h3>Asignación</h3>
            <span class="estatus completado">Completado</span>
          </div>
          <ul>
            <li><strong>Asesor:</strong> Juan Pérez</li>
            <li><strong>Área:</strong> MediBroker</li>
            <li><strong>Fecha:</strong> 07/10/2025 - 09:45 A.M.</li>
            <li><strong>Persona Asignada:</strong> Laura Gómez</li>
          </ul>
          <p class="nota"><strong>Nota:</strong> Se completó la configuración sin incidencias.</p>
        </div>

        <div class="card">
          <div class="card-header">
            <h3>Asignación</h3>
            <span class="estatus completado">Completado</span>
          </div>
          <ul>
            <li><strong>Asesor:</strong> Carlos Díaz</li>
            <li><strong>Área:</strong> MediBroker</li>
            <li><strong>Fecha:</strong> 06/10/2025 - 04:10 P.M.</li>
            <li><strong>Persona Asignada:</strong> Ana López</li>
          </ul>
          <p class="nota"><strong>Nota:</strong> Instalación finalizada y validada por sistemas.</p>
        </div>
      </div>
    </section>

    <!-- Sección: En Proceso -->
    <section class="seccion">
      <h2>En Proceso</h2>
      <div class="fila">
        <div class="card">
          <div class="card-header">
            <h3>Asignación</h3>
            <span class="estatus proceso">En proceso</span>
          </div>
          <ul>
            <li><strong>Asesor:</strong> Daniela Ruiz</li>
            <li><strong>Área:</strong> MediBroker</li>
            <li><strong>Fecha:</strong> 06/10/2025 - 03:20 P.M.</li>
            <li><strong>Persona Asignada:</strong> Jorge Medina</li>
          </ul>
          <p class="nota"><strong>Nota:</strong> Pendiente validación de acceso al servidor principal.</p>
        </div>
      </div>
    </section>

    <!-- Sección: Pendientes -->
    <section class="seccion">
      <h2>Pendientes</h2>
      <div class="fila">
        <div class="card">
          <div class="card-header">
            <h3>Asignación</h3>
            <span class="estatus pendiente">Pendiente</span>
          </div>
          <ul>
            <li><strong>Asesor:</strong> Ana López</li>
            <li><strong>Área:</strong> MediBroker</li>
            <li><strong>Fecha:</strong> 07/10/2025 - 10:30 A.M.</li>
            <li><strong>Persona Asignada:</strong> Pedro Ramírez</li>
          </ul>
          <p class="nota"><strong>Nota:</strong> A la espera de confirmación del área de sistemas.</p>
        </div>
      </div>
    </section>

  </main>

</body>
</html>
