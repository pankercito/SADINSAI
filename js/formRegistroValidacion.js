const inputName = document.getElementById('Name');
const inputLastName = document.getElementById('Apellido');
const inputCi = document.getElementById('Ci');
const inputDireccion = document.getElementById('Direccion');
const inputPhone = document.getElementById('Phone');
const inputEmail = document.getElementById('Email');

inputEmail.addEventListener('focusout', function () {
  if (!isValidEmail(inputEmail.value)) {
    inputEmail.value = '';
  }
});

inputDireccion.addEventListener('focusout', function () {
  if (!isValidDireccion(inputDireccion.value)) {
    inputDireccion.value = '';
  }
});

inputName.addEventListener('focusout', function () {
  if (!isValidName(inputName.value)) {
    inputName.value = '';
  }
});

inputLastName.addEventListener('focusout', function () {
  if (!isValidLastName(inputLastName.value)) {
    inputLastName.value = '';
  }
});

inputPhone.addEventListener('focusout', function () {
  if (!isValidPhone(inputPhone.value)) {
    inputPhone.value = '';
  }
});

inputCi.addEventListener('focusout', function () {
  if (!isValidCi(inputCi.value)) {
    inputCi.value = '';
  }
});

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidName(name) {
  const nameRegex = /^([a-zA-ZáéíóúñÁÉÍÓÚüÜ]+\s){0,2}[a-zA-ZáéíóúñÁÉÍÓÚüÜ]{3,15}$/;
  return nameRegex.test(name);
}

function isValidLastName(lastname) {
  const lastnameRegex = /^([a-zA-ZáéíóúñÁÉÍÓÚüÜ]+\s){0,2}[a-zA-ZáéíóúñÁÉÍÓÚüÜ]{3,15}$/;
  return lastnameRegex.test(lastname);
}

function isValidPhone(phone) {
  const phoneRegex = /^[0-9]{11}$/;
  return phoneRegex.test(phone);
}

function isValidDireccion(direccion) {
  const direccionRegex = /^[\wáéíóúñÁÉÍÓÚüÜ#,. ]+$/u;
  return direccionRegex.test(direccion);
}

function isValidCi(ci) {
  const ciRegex = /^[0-9]{7,8}$/;
  return ciRegex.test(ci);
}