"use strict";

//boton de editar
var editar = document.getElementById("editar");
editar.addEventListener("click", bue); //funcion de boton ocultal todo y enjecutar todas la funciones

function bue() {
  //donde imprimire la plantilla
  centro = document.getElementById("centro"); //cambiar titulo y variable para complemento

  document.title = "SADINSAI | Editar usuario"; //ocultar colunmas adicionales para pantalla de editar

  document.getElementById("perfil").style.display = "none";
  document.getElementById("columna").style.display = "none";
  document.getElementById("centro").className = document.getElementById("centro").className.replace("col-lg-9", "col-lg-11");
  mostrarPhp();
} //funcion para mostrar plantilla


function mostrarPhp() {
  var xhr = new XMLHttpRequest(); //optener el get

  var get = location.search.substring(1); //solicitud al documento

  xhr.open("GET", "../layout/editarUsuario.php?" + get, true);

  xhr.onload = function () {
    //verificacion de solicitud
    if (xhr.status === 200) {
      centro.innerHTML = xhr.responseText;
    } else {
      centro.innerHTML = "error al mostrar informaci&oacute;n, recargue la pagina";
    }
  }; //enviar solicitud


  xhr.send();
}