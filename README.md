# Sistema de Gestión de Equipos y Solicitudes

## Descripción general

Este proyecto es un **sistema de gestión interna** diseñado para controlar la **asignación, cambio, baja y cancelación de equipos de cómputo** entre asesores y el área de sistemas.  
Incluye funcionalidades administrativas, control de inventario y trazabilidad completa de las acciones realizadas sobre cada solicitud.

El sistema está estructurado para permitir que:

- Los **asesores** creen solicitudes.
- El **área de sistemas** gestione las solicitudes y actualice su estado.
- Se mantenga un **historial** de todas las acciones realizadas para auditoría.
- Exista un **administrador** con control total sobre usuarios, inventario y solicitudes.

---

## Funcionalidades principales hasta el momento

### 1. Gestión de usuarios
- Registro y consulta de usuarios.
- Roles definidos: `admin`, `sistemas`, `asesor`.
- Control de fechas de registro y baja.
- Ejemplo de usuario administrador: Fernando Lugo Hernández.

### 2. Gestión de inventario
- Registro de equipos de cómputo (marca, modelo, número de serie).
- Control de estatus: `libre` o `asignada`.
- Asociación con solicitudes de asignación o cambios.

### 3. Gestión de solicitudes
- Tipos de solicitud: `asignación`, `cambio`, `baja`, `cancelación`.
- Registro del usuario que crea la solicitud y del destinatario del equipo.
- Control de fechas de creación y terminación.
- Integración con inventario para validar disponibilidad de equipos.

### 4. Historial de acciones
- Registro de fechas de asignación, cancelación, cambio y baja.
- Relación con el usuario que realiza la acción y la solicitud correspondiente.
- Permite seguimiento completo de cada movimiento de equipo.

---

## Estructura de la base de datos

**Tablas principales:**

1. `usuarios`: Información de usuarios y roles (admin, sistemas, asesor).  
2. `inventario`: Equipos de cómputo disponibles o asignados.  
3. `solicitudes`: Control de solicitudes y su estado.  
4. `historial`: Registro de acciones sobre cada solicitud.

**Relaciones:**
- Un usuario puede crear muchas solicitudes.
- Una solicitud puede involucrar un equipo del inventario.
- Cada acción sobre una solicitud se registra en el historial.

---

## Flujo del sistema

1. El **asesor** crea una solicitud (asignación, cambio, baja o cancelación).  
2. El sistema registra la solicitud como **pendiente**.  
3. El **personal de sistemas** procesa la solicitud y actualiza su estado (`en_proceso`, `completada`, `cancelada`).  
4. Las acciones se registran automáticamente en el **historial**.  
5. Los equipos asignados se marcan como **asignados** y se liberan cuando corresponda (baja o cancelación).

---

## Tecnologías utilizadas

- **Backend:** PHP 8+  
- **Base de datos:** MySQL 8+  
- **Frontend:** HTML, CSS, JavaScript  
- **Herramientas:** phpMyAdmin, Visual Studio Code, XAMPP/WAMP  

---

## Roles del sistema

| Rol       | Permisos principales |
|-----------|---------------------|
| **Admin**    | Acceso completo: gestión de usuarios, inventario y solicitudes. |
| **Sistemas** | Gestiona solicitudes y modifica inventario. |
| **Asesor**   | Crea solicitudes y consulta el estado de las propias. |

---

## Estado actual del proyecto

- Base de datos creada y normalizada.  
- Tablas: `usuarios`, `inventario`, `solicitudes`, `historial`.  
- Roles definidos: `admin`, `sistemas`, `asesor`.  
- Funcionalidades básicas de inserción y consulta implementadas.  
- Ejemplos de usuarios y equipos insertados para pruebas.  

---

## Próximos pasos

- Implementar login y control de sesiones según rol.  
- Automatizar actualización de estatus de inventario mediante triggers.  
- Generar reportes y vistas consolidadas para sistemas y administración.  
- Mejorar la interfaz gráfica del módulo de administración.
