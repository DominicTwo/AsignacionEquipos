# Módulo Administrativo de Usuarios e Inventarios (MAUI)

## Descripción general

El **Módulo Administrativo de Usuarios e Inventarios (MAUI)** es una parte esencial del sistema de gestión interna que permite administrar tanto a los **usuarios** (asesores y personal de sistemas) como el **inventario de equipos de cómputo**.  

Su propósito principal es mantener un control centralizado de las asignaciones, cambios, bajas y cancelaciones de equipos entre el área de **Sistemas** y los **Asesores** de distintas áreas, asegurando trazabilidad, organización y transparencia en cada solicitud.

---

## Funcionalidades principales

### 1. Gestión de usuarios
- Registro, consulta y baja de usuarios (asesores y personal de sistemas).
- Almacenamiento seguro de contraseñas.
- Control por roles (asesor / sistemas).
- Registro automático de fecha de alta y baja.

### 2. Gestión de inventario
- Alta y control de equipos de cómputo (marca, modelo, número de serie).
- Seguimiento del estado del equipo (`libre`, `asignada`).
- Asociación directa de equipos con solicitudes.

### 3. Gestión de solicitudes
- Creación de solicitudes de **asignación**, **cambio**, **baja** y **cancelación**.
- Control de estatus (pendiente, en proceso, completada, cancelada).
- Asociación con usuario creador y equipo asignado.
- Registro de fechas de creación y finalización.

### 4. Historial de acciones
- Registro automático de acciones sobre cada solicitud.
- Control de fechas de asignación, cambio, baja o cancelación.
- Trazabilidad completa entre usuarios, solicitudes y equipos.

---

## Estructura de la base de datos

**Tablas principales:**
- `usuarios`: Información de los usuarios del sistema.
- `inventario`: Equipos disponibles o asignados.
- `solicitudes`: Control de solicitudes creadas y su estado.
- `historial`: Registro de acciones y eventos realizados.

---

## Estructura de la carpeta

