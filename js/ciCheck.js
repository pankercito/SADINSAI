//funcion ajax para verificar la cedula
function verificarCI() {
  const ci = document.getElementById("ci").value;

  // Use the $.ajax() method to send the request
  $.ajax({
    url: "../php/verificarCi.php",
    type: "POST",
    data: {
      ci: ci
    },
    success: function (respuesta) {
      if (respuesta == "!registra primero¡") { //no se encuentra en ninguna tabla
        document.getElementById("mensajeCi").innerHTML = `<p class="errormake" style="
                                                          margin: -2rem 0rem 0.5rem 0rem;
                                                          position: absolute;
                                                          white-space: pre-line;
                                                          text-decoration: none;
                                                          text-align: center;">
                                                          Estas intentando registrar a una persona que no se encuentra en la empresa 
                                                          para continuar, primero debe 
                                                          <a href='anadir.php?form=true'
                                                          style="
                                                          text-decoration: none;
                                                          font-weight: 700;
                                                          color: #444444;">agregar personal</a></p>`;
        document.getElementById("mensajeCi").setAttribute("style", "display: flex;height: 3rem;margin: 0rem 2rem 2rem 2rem;justify-content: center;")
      } // Realiza alguna acción si la CI ya está registrada
      else if (respuesta == "¡La CI ingresada ya está registrada!") {
        document.getElementById("mensajeCi").innerHTML = "¡Esta persona ya esta registrada!";
        document.getElementById("mensajeCi").removeAttribute("style");
      } //si esta vacio
      else if (respuesta == "false") {
        document.getElementById("mensajeCi").innerHTML = "";
      } //Accion si la ceduala esta en Personal pero no en registro
      else if (respuesta == "true") {
        document.getElementById("mensajeCi").innerHTML = "";
      }
    }
  });
}
