<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Denegado</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin-top: 50px; }
        .container { padding: 20px; border: 1px solid #ccc; display: inline-block; }
        a { color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Acceso Denegado</h1>
        
        <?php if (isset($_SESSION['user_name'])): ?>
            <p>Hola, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>.</p>
        <?php endif; ?>
        
        <p>No tienes los permisos necesarios para acceder a esta página.</p>
        <p>
            <a href="logout.php">Cerrar Sesión</a>
        </p>
    </div>
</body>
</html>