// Definir la duración de la sesión en segundos
var duracion_sesion = 300; 

// Definir la duración del tiempo de advertencia en segundos
var duracion_advertencia = 289;

// Función para comprobar el estado de la sesión
function comprobarSesion() {
  // Crear una nueva solicitud XMLHttpRequest
  var xhr = new XMLHttpRequest();

  // Configurar la solicitud
  xhr.open('GET', '../php/comprobarSesion.php', true);

  // Configurar la función de devolución de llamada para manejar la respuesta
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      // La solicitud ha sido completada correctamente
      var respuesta = xhr.responseText;
      if (respuesta == 'activo') {
        // La sesión está activa, actualizar la última actividad
        actualizarUltimaActividad();
      } else {
        // La sesión ha expirado, mostrar la advertencia al usuario
        mostrarAdvertencia();
      }
    }
  };

  // Enviar la solicitud
  xhr.send();
}

//funcion cerrar sesion
function cerrarSesion() {
  fetch('../php/cerrarSesion.php', {
    method: 'POST',
    credentials: 'same-origin' // incluye las cookies en la petición
  }).then(response => {
    // Si la petición es exitosa, redirige al usuario a la página de inicio de sesión
    if (response.redirected) {
      window.location.href = response.url;
    } else {
      console.error('Error al cerrar sesión');
    }
  }).catch(error => {
    console.error(error);
  });
}

// Función para actualizar la última actividad de la sesión
function actualizarUltimaActividad() {
  // Crear una nueva solicitud XMLHttpRequest
  var xhr = new XMLHttpRequest();

  // Configurar la solicitud
  xhr.open('GET', '../php/mantenerSesion.php', true);

  // Enviar la solicitud
  xhr.send();
}

// Función para mostrar la advertencia al usuario
function mostrarAdvertencia() {
  // Mostrar la alerta al usuario
  $.confirm({
    title: 'La sesion esta por finalizar',
    content: 'se cerrará la sesión automáticamente en 10 segundos.',
    autoClose: 'logoutUser|10000', //esto es el tiempo en milisegundos
    buttons: {
      logoutUser: {
        text: 'Cerrar sesion ',
        action: function () {
          cerrarSesion();
        }
      },
      Continuar: function () {
        mantenerSesion();

      }
    }
  });
}

// Función para mantener la sesión activa
function mantenerSesion() {
  // Crear una nueva solicitud XMLHttpRequest
  var xhr = new XMLHttpRequest();

  // Configurar la solicitud
  xhr.open('GET', '../php/actualizarSesion.php', true);

  // Enviar la solicitud
  xhr.send();
}

// Comprobar el estado de la sesión cada segundo
setInterval(comprobarSesion, 1000 * duracion_advertencia);

// Actualizar la última actividad de la sesión al cargar la página
actualizarUltimaActividad();