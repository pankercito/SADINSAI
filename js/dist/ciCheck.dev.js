"use strict";

//funcion ajax para verificar la cedula
function verificarCI() {
  var ci = document.getElementById("ci").value;
  var bota = document.getElementById("singup");
  var xhttp = new XMLHttpRequest();
  xhttp.open("POST", "../php/verificarCi.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("ci=" + ci);

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      var respuesta = this.responseText;

      if (respuesta == "!registra primero¡") {
        //no se encuentra en ninguna tabla
        document.getElementById("mensajeCi").innerHTML = "<p class=\"errormake\" style=\"\n                                                          margin: -1rem 0rem 0.5rem 0rem;\n                                                          position: absolute;\n                                                          white-space: pre-line;\n                                                          text-decoration: none;\n                                                          text-align: center;\">\n                                                          Estas intentando registrar a una persona que no se encuentra en la empresa \n                                                          para continuar, primero debe \n                                                          <a href='anadir.php?form=true'\n                                                          style=\"\n                                                          text-decoration: none;\n                                                          font-weight: 700;\n                                                          color: #444444;\">agregar personal</a></p>";
        bota.setAttribute("disabled", true);
        document.getElementById("mensajeCi").setAttribute("style", "display: flex;height: 3rem;margin: 0rem 2rem 2rem 2rem;justify-content: center;");
      } // Realiza alguna acción si la CI ya está registrada
      else if (respuesta == "¡La CI ingresada ya está registrada!") {
          bota.setAttribute("disabled", true);
          document.getElementById("mensajeCi").innerHTML = "¡Esta persona ya esta registrada!";
          document.getElementById("mensajeCi").removeAttribute("style");
        } //si esta vacio
        else if (respuesta == "false") {
            document.getElementById("mensajeCi").removeAttribute("style");
            document.getElementById("mensajeCi").innerHTML = "";
            bota.setAttribute("disabled", true);
          } //Accion si la ceduala esta en Personal pero no en registro
          else if (respuesta == "true") {
              document.getElementById("mensajeCi").removeAttribute("style");
              bota.removeAttribute("disabled");
              document.getElementById("mensajeCi").innerHTML = "";
            }
    }
  };
}