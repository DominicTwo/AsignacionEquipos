<?php 

session_start();

header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache");
header("Expires: 0");


require __DIR__ . '/db/db.php';
 
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    
    if (isset($_SESSION['user_rol'])) {
        switch ($_SESSION['user_rol']) {
            case 'admin':
                header("Location: /MAUI"); 
                break;
            case 'sistemas':
                header("Location: /sistemas_view");
                break;
            case 'asesor':
                header("Location: /asesores_view");
                break;
            default:
                header("Location: /logOut.php");
                break;
        }
    } else {
        header("Location: logOut.php");
    }
    
    exit; 
}

$error_message = ''; 
if (isset($_SESSION['error'])) {
    
    $error_message = $_SESSION['error'];
    
    unset($_SESSION['error']); 
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicia Sesión</title>
  <link rel="stylesheet" href="/src/css/login.css">
</head>
  <body>
    <div class="left">
      <img src="/src/assets/img/sistemasLogo.jpeg" alt="Logo C.A.S Sistemas">
    </div>

    <div class="right">
      <div class="login-box">
        <h2>Iniciar Sesión</h2>
        
        <?php if ($error_message): ?>
        <p class="error"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>

    <form id="logInForm" action="./logIn.php" method="POST">
        <input type="text" id="usuario" name="usuario" placeholder="Usuario o Correo" required>
        <div class="password-container">
            <input type="password" id="password" name="password" placeholder="Contraseña" required>
            <span id="togglePassword" class="toggle-icon">👁</span>
        </div>
        <button type="submit" id="btnLogin">Entrar</button> 
    </form>
      </div>
    </div>

  <script src="/src/scripts/isValidateEmail.js"></script>
</body>
</html>