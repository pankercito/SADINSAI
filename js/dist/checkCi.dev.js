"use strict";

var xhttp = new XMLHttpRequest();
xhttp.open("POST", "../php/verificarCi.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("ci=" + ciValue);

xhttp.onreadystatechange = function () {
  if (this.readyState == 4 && this.status == 200) {
    var respuesta = this.responseText;

    if (respuesta == "!registra primero¡") {
      //no se encuentra en ninguna tabla
      document.getElementById("mensajeCi").innerHTML = "<a class=\"errormake\">\n                            Estas intentando registrar a una persona que no se encuentra en la empresa \n                            para continuar, primero debe <a href='principal.php?form=true'>agregar personal</a>";
      ciValue.value = '';
      botonEnviar.addAttribute("disabled");
    } // Realiza alguna acción si la CI ya está registrada
    else if (respuesta == "¡La CI ingresada ya está registrada!") {
        botonEnviar.addAttribute("disabled");
        document.getElementById("mensajeCi").innerHTML = respuesta;
      } //si esta vacio
      else if (respuesta == "false") {
          botonEnviar.addAttribute("disabled");
        } //Accion si la ceduala esta en Personal pero no en registro
        else if (respuesta == "true") {
            botonEnviar.removeAttribute("disabled");
            document.getElementById("mensajeCi").innerHTML = "";
          }
  }
};