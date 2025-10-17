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
        <form action="login.php" method="POST">
          <input type="text" id="usuario" name="usuario" placeholder="Usuario" onkeyup="validarInputs()">
          <input type="password" id="password" name="password" placeholder="Contraseña" onkeyup="validarInputs()">
          <button type="submit" id="btnLogin" disabled>Entrar</button>
        </form>
      </div>
    </div>

      <script>
    function validarInputs() {
      const user = document.getElementById("usuario").value.trim();
      const pass = document.getElementById("password").value.trim();
      document.getElementById("btnLogin").disabled = (user === "" || pass === "");
    }
  </script>
<?php 
  require __DIR__ . '/src/templates/FooterHTML.php';
?>