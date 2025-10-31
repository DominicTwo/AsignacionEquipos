<?php 

  require __DIR__ . '/db/db.php';
  
  $titlePage = 'Iniciar Sesión';
  require __DIR__ . '/src/templates/HeaderHTML.php';
?>
    <div class="left">
      <img src="/src/assets/img/sistemasLogo.jpeg" alt="Logo C.A.S Sistemas">
    </div>

    <div class="right">
      <div class="login-box">
        <h2>Iniciar Sesión</h2>
        <form id="logInForm" action="login.php" method="POST">
          <input type="text" id="usuario" name="usuario" placeholder="Usuario">
          <div class="password-container">
    <input type="password" id="password" name="password" placeholder="Contraseña">
    <span id="togglePassword" class="toggle-icon">👁</span>
</div>
          <button type="submit" id="btnLogin" disabled>Entrar</button>
        </form>
      </div>
    </div>


  <script src="/src/scripts/isValidateEmail.js"></script>
<?php 
  require __DIR__ . '/src/templates/FooterHTML.php';
?>