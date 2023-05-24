const inputEmail = document.getElementById('inputEmail');
const inputPassword = document.getElementById('inputPassword');
const inputUsername = document.getElementById('inputUsername');
const inputPhone = document.getElementById('inputPhone');

inputEmail.addEventListener('focusout', function() {
  if (!isValidEmail(inputEmail.value)) {
    alert('Por favor ingresa un email válido');
    inputEmail.value = '';
  }
});

inputPassword.addEventListener('focusout', function() {
  if (!isValidPassword(inputPassword.value)) {
    alert('Por favor ingresa una contraseña de al menos 8 caracteres');
    inputPassword.value = '';
  }
});

inputUsername.addEventListener('focusout', function() {
  if (!isValidUsername(inputUsername.value)) {
    alert('Por favor ingresa un nombre de usuario válido');
    inputUsername.value = '';
  }
});

inputPhone.addEventListener('focusout', function() {
  if (!isValidPhone(inputPhone.value)) {
    alert('Por favor ingresa un número de teléfono válido (11 dígitos)');
    inputPhone.value = '';
  }
});

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPassword(password) {
  return password.length >= 8;
}

function isValidUsername(username) {
  const usernameRegex = /^[a-zA-Z0-9_-]{3,16}$/;
  return usernameRegex.test(username);
}

function isValidPhone(phone) {
  const phoneRegex = /^[0-9]{11}$/;
  return phoneRegex.test(phone);
}