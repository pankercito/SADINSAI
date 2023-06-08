//funcion ajax para verificar la cedula
function verificarCI() {
    const ci = document.getElementById("sCi").value;
    let bota = document.getElementById("soli");
    let xhttp = new XMLHttpRequest();
    
    xhttp.open("POST", "../php/verificarCi.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("ci=" + ci);
      
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        let respuesta = this.responseText;
  
        if (respuesta == "!registra primero¡"){//no se encuentra en ninguna tabla
          document.getElementById("mensajeCi").innerHTML = `<p class="errormake" style="
                                                            margin: -2.7rem -14rem 0rem 14rem;
                                                            position: absolute;
                                                            text-decoration: none;">
        Por favor ingresa una cedula valida o <a href="anadir.php?form=true" style="text-decoration: none;
                                                                                    font-weight: 700;
                                                                                    color: #ffc107de;">
                                                                                    agrega personal</a></p>`;
          ci.value = '';
          bota.setAttribute("disabled", true);
        }// Realiza alguna acción si la CI ya está registrada
        else if (respuesta == "¡La CI ingresada ya está registrada!"){        
          bota.removeAttribute("disabled");
          document.getElementById("mensajeCi").innerHTML = "";
        }//si esta vacio
        else if (respuesta == "false"){
          bota.setAttribute("disabled", true);
          document.getElementById("mensajeCi").innerHTML = "";
        }//Accion si la ceduala esta en Personal pero no en registro
        else if (respuesta == "true"){
          bota.removeAttribute("disabled");
          document.getElementById("mensajeCi").innerHTML = "";
        }
      }
    };
  }