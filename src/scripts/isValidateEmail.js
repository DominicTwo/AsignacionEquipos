document.addEventListener('DOMContentLoaded', () => {

  const logInForm = document.getElementById('logInForm');
  const usuarioInput = document.getElementById('usuario');
  const passwordInput = document.getElementById('password');
  const loginButton = document.getElementById('btnLogin');
  
  const togglePassword = document.getElementById('togglePassword');

  function validarCamposVacios() {
    const usuarioValue = usuarioInput.value.trim();
    const passwordValue = passwordInput.value.trim();

    if (usuarioValue !== '' && passwordValue !== '') {
      loginButton.disabled = false;
    } else {
      loginButton.disabled = true;
    }
  }

  function esEmailValido(email) {
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return emailRegex.test(email);
  }

  usuarioInput.addEventListener('input', validarCamposVacios);
  passwordInput.addEventListener('input', validarCamposVacios);

  logInForm.addEventListener('submit', (event) => {
    const usuarioValue = usuarioInput.value.trim();

    if (!esEmailValido(usuarioValue)) {
      event.preventDefault(); 
      alert('Por favor, ingresa un correo electrónico válido (ej. usuario@dominio.com).');
    }
  });

  togglePassword.addEventListener('click', () => {
    const esPassword = passwordInput.getAttribute('type') === 'password';
    
    if (esPassword) {
      passwordInput.setAttribute('type', 'text');
      togglePassword.textContent = '⌣';
    } else {
      passwordInput.setAttribute('type', 'password');
      togglePassword.textContent = '👁';
    }
  });

});