<?php
    // require_once '../auth.php';
    // proteger_ruta(['sistemas']); 
    include '../src/templates/Navbar.php';
    require '../db/db.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="../src/css/sistemas/index.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Sistemas</title>
</head>

<body>
    <section class="main-cards-sistemas">             
              
        <div class="card-content asignacion-card">
            <h2 class="title-card title-asignaciones">Asignaciones</h2>
            <p id="cant-asignaciones" class="count-asignaciones count-all">0</p>
        </div>

        <div class="card-content cambio-card">
            <h2 class="title-card title-asignaciones">Cambios</h2>
            <p id="cant-cambios" class="count-cambios count-all">0</p>
        </div>
        
        <div class="card-content cancelacion-card">
            <h2 class="title-card title-asignaciones">Cancelaciones</h2>
            <p id="cant-cancelaciones" class="count-cancelaciones count-all">0</p>
        </div>

        <div class="card-content bajas-card">
            <h2 class="title-card title-asignaciones">Bajas</h2>
            <p id="cant-bajas" class="count-bajas count-all">0</p>
        </div>
    
    </section>

    <section class="view-reports-sistemas">

        
        
    </section>

    <script>
    // --- 1. FUNCIÓN PARA CARGAR CONTADORES (La que ya tenías) ---
    function cargarContadores() {
        // Asegúrate que esta ruta sea correcta según donde guardaste el archivo
        fetch('../sistemas_view/api_contadores.php') 
            .then(respuesta => respuesta.json())
            .then(datos => {
                const map = {
                    'asignacion': 'cant-asignaciones',
                    'cambio': 'cant-cambios',
                    'cancelacion': 'cant-cancelaciones',
                    'baja': 'cant-bajas'
                };
                for (let tipo in map) {
                    let el = document.getElementById(map[tipo]);
                    if(el) el.innerText = datos[tipo] || 0;
                }
            })
            .catch(error => console.error('Error cargando contadores:', error));
    }

    // --- 2. FUNCIÓN PARA CARGAR REPORTES (La nueva) ---
    function cargarReportes() {
        // Asegúrate que esta ruta apunte a donde creaste el archivo del Paso 1
        fetch('../sistemas_view/api_reportes.php')
            .then(response => response.json())
            .then(data => {
                const contenedor = document.querySelector('.view-reports-sistemas');
                let html = '';

                // Si no hay datos, mostramos un mensaje
                if(data.length === 0) {
                    contenedor.innerHTML = '<p style="text-align:center; padding:20px;">No hay solicitudes pendientes.</p>';
                    return;
                }

                // Recorremos cada solicitud recibida de la Base de Datos
                data.forEach(solicitud => {

                    const tipoClase = solicitud.tipo.toLowerCase().trim();

                    // Preparamos datos para evitar "null" en pantalla
                    const solicitante = solicitud.nombre_solicitante || 'Sin nombre';
                    const asignado = solicitud.nombre_asignado || 'Sin asignar';
                    const nota = solicitud.descripcion || 'Sin descripción';

                    // AQUÍ ESTÁ TU PLANTILLA HTML EXACTA
                    // Usamos las comillas invertidas ` ` para insertar variables ${...}
                    html += `
                    <div class="report-info ${tipoClase}">
                        <div class="report-section"> 
                            <div class="report-column">
                                <p class="text-info">Tipo de solicitud:</p>
                                <p class="text-info">Status:</p>
                                <p class="text-info">Fecha:</p>
                            </div>
                            <div class="report-column">
                                <p class="text-info" style="text-transform: capitalize;">${solicitud.tipo}</p>
                                <p class="text-info" style="font-weight: bold;">${solicitud.estatus}</p>
                                <p class="text-info">${solicitud.fecha_creacion}</p>
                            </div>
                        </div>
                        <div class="report-section">
                            <div class="report-column">
                                <p class="text-info">Asesor:</p>
                                <p class="text-info">Area:</p>
                                <p class="text-info">Persona asignada:</p>
                            </div>
                            <div class="report-column">
                                <p class="text-info">${solicitante}</p>
                                <p class="text-info">${solicitud.area_destino}</p>
                                <p class="text-info">${asignado}</p>
                            </div>
                        </div>
                        <div class="report-section">   
                            <div class="report-column">
                                <p class="text-info">Nota:</p>
                            </div>
                             <div class="report-column">
                                <p class="text-info">${nota}</p>
                            </div>
                        </div>
                    </div>
                    <hr style="opacity: 0.2; margin: 10px 0;">
                    `;
                });

                // Inyectamos todo el HTML generado en la sección
                contenedor.innerHTML = html;
            })
            .catch(error => console.error('Error cargando reportes:', error));
    }

    // --- EJECUCIÓN ---
    // Cargamos todo al abrir la página
    cargarContadores();
    cargarReportes();

    // Actualizamos cada 5 segundos
    setInterval(() => {
        cargarContadores();
        cargarReportes();
    }, 5000);

    </script>
</body>
</html>