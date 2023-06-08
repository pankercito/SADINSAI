"use strict";

//funcion ajax para verificar la cedula
function verificarCI() {
  var ci = document.getElementById("sCi").value;
  var bota = document.getElementById("soli");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../php/verificarCi.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("ci=" + ci);

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var respuesta = this.responseText;

      if (respuesta == "!registra primero¡") {
        //no se encuentra en ninguna tabla
        document.getElementById("mensajeCi").innerHTML = "<p class=\"errormake\" style=\"\n                                                            margin: -2.7rem -14rem 0rem 14rem;\n                                                            position: absolute;\n                                                            text-decoration: none;\">\n        Por favor ingresa una cedula valida o <a href=\"anadir.php?form=true\" style=\"text-decoration: none;\n                                                                                    font-weight: 700;\n                                                                                    color: #ffc107de;\">\n                                                                                    agrega personal</a></p>";
        ci.value = '';
        bota.setAttribute("disabled", true);
      } // Realiza alguna acción si la CI ya está registrada
      else if (respuesta == "¡La CI ingresada ya está registrada!") {
          bota.removeAttribute("disabled");
          document.getElementById("mensajeCi").innerHTML = "";
        } //si esta vacio
        else if (respuesta == "false") {
            bota.setAttribute("disabled", true);
            document.getElementById("mensajeCi").innerHTML = "";
          } //Accion si la ceduala esta en Personal pero no en registro
          else if (respuesta == "true") {
              bota.removeAttribute("disabled");
              document.getElementById("mensajeCi").innerHTML = "";
            }
    }
  };
}