//funcion ajax para verificar la cedula
function verificarCI() {
  const ci = document.getElementById("ci").value;
  let bota = document.getElementById("singup");
  let xhttp = new XMLHttpRequest();

  xhttp.open("POST", "../php/verificarCi.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("ci=" + ci);

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let respuesta = this.responseText;

      if (respuesta == "!registra primero¡") { //no se encuentra en ninguna tabla
        document.getElementById("mensajeCi").innerHTML = `<p class="errormake" style="
                                                          margin: -1rem 0rem 0.5rem 0rem;
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
        bota.setAttribute("disabled", true);
        document.getElementById("mensajeCi").setAttribute("style", "display: flex;height: 3rem;margin: 0rem 2rem 2rem 2rem;justify-content: center;")
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