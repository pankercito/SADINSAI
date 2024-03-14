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
            if (respuesta != 'activo') {
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
                actualizarSesion();
            }
        }
    });
}

// Función para mantener la sesión activa
function actualizarSesion() {
    // Crear una nueva solicitud XMLHttpRequest
    var xhr = new XMLHttpRequest();

    // Configurar la solicitud
    xhr.open('GET', '../php/actualizarSesion.php', true);

    // Enviar la solicitud
    xhr.send();
}

// Comprobar el estado de la sesión cada segundo // se escribe en milisegundos el tiempo
setInterval(comprobarSesion, 33000);