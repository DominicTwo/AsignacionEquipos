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
            <p id="asignacion-total" class="count-main">0</p>
            
            <div class="card-details">
                <div class="detail-item">
                    <span>Pendientes:</span>
                    <span id="asignacion-pendiente" class="detail-num">0</span>
                </div>
                <div class="detail-item">
                    <span>En Proceso:</span>
                    <span id="asignacion-proceso" class="detail-num">0</span>
                </div>
            </div>
        </div>

        <div class="card-content cambio-card">
            <h2 class="title-card title-asignaciones">Cambios</h2>
            <p id="cambio-total" class="count-main">0</p>
            
            <div class="card-details">
                <div class="detail-item">
                    <span>Pendientes:</span>
                    <span id="cambio-pendiente" class="detail-num">0</span>
                </div>
                <div class="detail-item">
                    <span>En Proceso:</span>
                    <span id="cambio-proceso" class="detail-num">0</span>
                </div>
            </div>
        </div>
        
        <div class="card-content cancelacion-card">
            <h2 class="title-card title-asignaciones">Cancelaciones</h2>
            <p id="cancelacion-total" class="count-main">0</p>
            
            <div class="card-details">
                <div class="detail-item">
                    <span>Pendientes:</span>
                    <span id="cancelacion-pendiente" class="detail-num">0</span>
                </div>
                <div class="detail-item">
                    <span>En Proceso:</span>
                    <span id="cancelacion-proceso" class="detail-num">0</span>
                </div>
            </div>
        </div>

        <div class="card-content bajas-card">
            <h2 class="title-card title-asignaciones">Bajas</h2>
            <p id="baja-total" class="count-main">0</p>
            
            <div class="card-details">
                <div class="detail-item">
                    <span>Pendientes:</span>
                    <span id="baja-pendiente" class="detail-num">0</span>
                </div>
                <div class="detail-item">
                    <span>En Proceso:</span>
                    <span id="baja-proceso" class="detail-num">0</span>
                </div>
            </div>
        </div>
    
    </section>

    <section class="view-reports-sistemas">

        
        
    </section>
        
    <script>


    // Control de actualizaciones automáticas (se pausa al abrir modal)
    let pausarUpdate = false; 

    // Sistema de Alertas 
    let ultimoIdConocido = 0; 
    const audioAlerta = new Audio('../src/audio/notificacion.mp3'); 

    // Variables para el manejo del modal de confirmación
    let tempSelect = null;      // Select
    let tempValorPrevio = null; // Valor previo a la seleccion o si le da que no el enano
    let tempIdSolicitud = null; // El aidi de la solicitud

    // SOLICITAR PERMISOS DE NOTIFICACIÓN
    // Hay que picarle para funque, lo escribio aqui por que se me olvidara XD
    document.addEventListener('click', function() {
        if (Notification.permission !== "granted") {
            Notification.requestPermission();
        }
        audioAlerta.load(); // Tiene un aidio de gato xd 
    }, { once: true });


   
    // FUNCIONES DE CARGA DE DATOS Y LOS CONTADORES
    function cargarContadores() {
        fetch('../sistemas_view/api_contadores.php') 
            .then(respuesta => respuesta.json())
            .then(datos => {
                const tipos = ['asignacion', 'cambio', 'cancelacion', 'baja'];

                tipos.forEach(tipo => {
                    if (datos[tipo]) {
                        // Actualizamos los 3 contadores de cada tarjeta si existen en el DOM
                        const elTotal = document.getElementById(tipo + '-total');
                        const elPendiente = document.getElementById(tipo + '-pendiente');
                        const elProceso = document.getElementById(tipo + '-proceso');

                        if (elTotal) elTotal.innerText = datos[tipo].total;
                        if (elPendiente) elPendiente.innerText = datos[tipo]['pendiente'];
                        if (elProceso) elProceso.innerText = datos[tipo]['en proceso'];
                    }
                });
            })
            .catch(error => console.error('Error cargando contadores:', error));
    }

    // Carga los reportes desde la API y genera el HTML.

    function cargarReportes() {
        if (pausarUpdate) return; // Esto es para que no le quite la modal de confirmacion del select 

        fetch('../sistemas_view/api_reportes.php')
            .then(response => response.json())
            .then(data => {
                const contenedor = document.querySelector('.view-reports-sistemas');
                
                if(data.length === 0) {
                    contenedor.innerHTML = '<p style="text-align:center; padding:20px;">No hay solicitudes pendientes.</p>';
                    return;
                }

                // SISTEMA DE ALERTAS 
                // Si el ID más reciente es mayor al que conocíamos, es una solicitud nueva.
                const idMasReciente = parseInt(data[0].id_solicitud);

                if (idMasReciente > ultimoIdConocido) {
                    if (ultimoIdConocido !== 0) { 
                        // Reproducir sonido bien duro por que el chava no escucha
                        audioAlerta.play().catch(e => console.log("Audio bloqueado por falta de interacción"));
                        
                        // Mostrar notificación de escritorio pa cuando este fuera de la pestaña :D un pedo esto
                        if (Notification.permission === "granted") {
                            const noti = new Notification("Nueva Solicitud SAAGE", {
                                body: `Tipo: ${data[0].tipo} - Usuario: ${data[0].nombre_solicitante}`,
                                icon: '../src/img/logo_saage.png'
                            });
                            noti.onclick = () => { window.focus(); noti.close(); };
                        }
                    }
                    ultimoIdConocido = idMasReciente;
                }

                // GENERACIÓN DE HTML 
                let html = '';
                data.forEach(solicitud => {
                    // Datos básicos con valores por defecto
                    const tipoClase = solicitud.tipo.toLowerCase().trim();
                    const solicitante = solicitud.nombre_solicitante || 'Sin nombre';
                    const asignado = solicitud.nombre_asignado || 'Sin asignar';
                    const nota = solicitud.descripcion || 'Sin descripción';
                    const estatusActual = solicitud.estatus.toLowerCase();

                    // LÓGICA DE REGLAS DE ESTATUS
                    // Define qué opciones están habilitadas según el estado actual
                    let opPendiente = '';
                    let opEnProceso = '';
                    let opCompletado = '';
                    let estadoSelect = '';

                    if (estatusActual === 'pendiente') {
                        opPendiente = 'selected';
                        opCompletado = 'disabled'; // No puede saltar a completado
                    } else if (estatusActual === 'en proceso') {
                        opEnProceso = 'selected';
                        opPendiente = 'disabled';  // No puede regresar a pendiente
                    } else if (estatusActual === 'completado') {
                        opCompletado = 'selected';
                        estadoSelect = 'disabled'; // Ya no se puede mover
                    }

                    // Construcción de la tarjeta de reporte
                    html += `
                    <div class="report-info ${tipoClase}">
                        <div class="report-section"> 
                            <div class="report-column">
                                <p class="text-info">Tipo:</p>
                                <p class="text-info">Estatus:</p>
                                <p class="text-info">Fecha:</p>
                            </div>
                            <div class="report-column">
                                <p class="text-info" style="text-transform: capitalize;">${solicitud.tipo}</p>

                                <select class="text-info" style="font-weight: bold;" 
                                    data-id="${solicitud.id_solicitud}"
                                    onfocus="guardarValorPrevio(this)"
                                    onchange="confirmarCambio(this)"
                                    ${estadoSelect}>
                                    
                                    <option value="pendiente" ${opPendiente}>Pendiente</option>
                                    <option value="en proceso" ${opEnProceso}>En Proceso</option>
                                    <option value="completado" ${opCompletado}>Completado</option>
                                </select>

                                <p class="text-info">${solicitud.fecha_creacion}</p>
                            </div>
                        </div>
                        <div class="report-section">
                            <div class="report-column">
                                <p class="text-info">Solicitante:</p>
                                <p class="text-info">Área:</p>
                                <p class="text-info">Asignado a:</p>
                            </div>
                            <div class="report-column">
                                <p class="text-info">${solicitante}</p>
                                <p class="text-info">${solicitud.area_destino}</p>
                                <p class="text-info">${asignado}</p>
                            </div>
                        </div>
                        <div class="report-section">   
                            <div class="report-column"><p class="text-info">Nota:</p></div>
                            <div class="report-column"><p class="text-info">${nota}</p></div>
                        </div>
                    </div>`;
                });

                contenedor.innerHTML = html;
            })
            .catch(error => console.error('Error cargando reportes:', error));
    }


    // 3. INTERACCIÓN Y MANEJO DEL MODAL
 

    // guardamos qué tenía antes por si el chavafio dice que ne
    function guardarValorPrevio(selectElement) {
        tempValorPrevio = selectElement.value;
    }

    // Al cambiar una opción, mostramos el modal y pausamos el refresco automático
    function confirmarCambio(selectElement) {
        pausarUpdate = true;
        tempSelect = selectElement;
        tempIdSolicitud = selectElement.getAttribute('data-id');

        // Mostramos el texto visual en el modal
        const nuevoTexto = selectElement.options[selectElement.selectedIndex].text;
        document.getElementById('modal-nuevo-status').innerText = nuevoTexto;
        document.getElementById('modalConfirmacion').style.display = 'flex';
    }

    // Lógica al presionar "Sí" o "No" en el modal
    function procederCambio(confirmado) {
        document.getElementById('modalConfirmacion').style.display = 'none';

        if (confirmado) {
            // Envío a la Base de Datos
            fetch('../sistemas_view/api_cambiar_estatus.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: tempIdSolicitud, estatus: tempSelect.value })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Actualización inmediata para reflejar cambios
                    cargarContadores();
                    cargarReportes();
                } else {
                    alert("Error: " + data.message);
                    tempSelect.value = tempValorPrevio; // Revertir visualmente
                }
            })
            .catch(err => {
                console.error(err);
                alert("Error de conexión");
                tempSelect.value = tempValorPrevio;
            });
        } else {
            // Usuario canceló: revertimos el select al valor anterior
            tempSelect.value = tempValorPrevio;
        }

        // Reactivamos el ciclo automático
        pausarUpdate = false;
    }



    // 4. INICIO Y CICLO DE VIDA

    
    // Primera carga inmediata
    cargarContadores();
    cargarReportes();

    // Ciclo infinito (cada 5 segundos)
    setInterval(() => {
        cargarContadores();
        cargarReportes(); 
    }, 5000);


    </script>
    <div id="modalConfirmacion" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <h3>Confirmar cambio</h3>
        <p>¿Estás seguro de cambiar el estatus a <span id="modal-nuevo-status" style="font-weight:bold;"></span>?</p>
        
        <div class="modal-buttons">
            <button onclick="procederCambio(true)" class="btn-si">Sí</button>
            <button onclick="procederCambio(false)" class="btn-no">No</button>
        </div>
    </div>
</div>
</body>
</html>