<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Denegado</title>
    <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #6a1b9a, #9c27b0, #ba68c8);
      color: #fff;
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }

    .container {
      background-color: rgba(255, 255, 255, 0.15);
      padding: 40px 60px;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
      backdrop-filter: blur(8px);
      max-width: 400px;
      width: 90%;
      animation: fadeIn 0.8s ease;
    }

    h1 {
      font-size: 2em;
      margin-bottom: 10px;
      color: #ffffff;
    }

    p {
      margin: 10px 0;
      font-size: 1.1em;
    }

    a {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      color: #6a1b9a;
      background-color: #fff;
      text-decoration: none;
      border-radius: 25px;
      font-weight: 600;
      transition: 0.3s;
    }

    a:hover {
      background-color: #f3e5f5;
      color: #4a148c;
      transform: scale(1.05);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
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