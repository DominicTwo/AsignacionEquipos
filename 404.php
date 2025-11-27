<?php

http_response_code(404);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página no encontrada - Error 404</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .error-container {
            background-color: #ffffff;
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 90%;
        }
        h1 {
            font-size: 100px;
            margin: 0;
            color: #ff6b6b;
            line-height: 1;
            font-weight: 800;
        }
        h2 {
            font-size: 24px;
            margin-top: 10px;
            color: #333;
        }
        p {
            color: #666;
            margin: 20px 0 30px 0;
            font-size: 16px;
            line-height: 1.5;
        }
        .url-error {
            background-color: #ffecec;
            color: #d63031;
            padding: 5px 10px;
            border-radius: 4px;
            font-family: monospace;
            word-break: break-all;
        }
        .btn-home {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: bold;
            transition: transform 0.2s, background-color 0.2s;
        }
        .btn-home:hover {
            background-color: #000;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="error-container">
        <h1>404</h1>
        
        <h2>¡Ups! Página no encontrada</h2>
        
        <p>
            Lo sentimos, no pudimos encontrar la página:<br>
            <span class="url-error"><?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?></span>
        </p>
        
        <p>Es posible que el enlace esté roto o que la página haya sido eliminada.</p>
        
        <a href="/" class="btn-home">Volver al Inicio</a>
    </div>

</body>
</html>