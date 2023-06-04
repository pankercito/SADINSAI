const buttonLog = document.getElementById('log');
const sedeSelect = document.getElementById('Sede');
const estadoSelect = document.getElementById('Estados');
const ciudadSelect = document.getElementById('Ciudades');

function enableButton() {
    const inputs = [inputName, inputLastName, inputCi, inputDireccion, inputPhone, inputEmail];
    
    const allInputsLlenos = inputs.every(input => input.value.trim() !== '');
    const allSelectsActivos = estadoSelect.selectedIndex !== 0 && sedeSelect.selectedIndex !== 0 && ciudadSelect.selectedIndex !== 0;
    //La funcion ".toggle" agrega o quita una clase CSS dependiendo de si la clase ya existe o no
    buttonLog.disabled = !(allInputsLlenos && allSelectsActivos);
  }

// Llama a la función enableButton cada vez que se escriba algo en los campos o se seleccione una opción en los selectores
[inputName, inputLastName, inputCi, inputDireccion, inputPhone, inputEmail, estadoSelect, ciudadSelect, sedeSelect].forEach(element => {
  element.addEventListener('input', enableButton);
  element.addEventListener('change', enableButton);
});

//funcion especifica para CI validation
function verificarCI() {
  let ci = document.getElementById("Ci").value;
  let xhttp = new XMLHttpRequest();
  
  xhttp.open("POST", "../php/verificarCi.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("ci=" + ci);
    
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      let respuesta = this.responseText;
      //no se encuentra en ninguna tabla
      if (respuesta == "!registra primero¡"){
        document.getElementById("mensajeCi").innerHTML = "";
      }// Realiza alguna acción si la CI ya está registrada
      else if (respuesta == "¡La CI ingresada ya está registrada!"){
        document.getElementById("mensajeCi").innerHTML =`<p id="pmsj" class='pmsj'>¡La cedula ingresada ya está registrada!</p>`;
        document.getElementById('log').setAttribute("disabled", true);
      }//si esta vacio
      else if (respuesta == "false"){
        document.getElementById("mensajeCi").innerHTML = "";
        document.getElementById('log').setAttribute("disabled", true);
      }//Accion si la ceduala esta en Personal pero no en registro
      else if (respuesta == "true"){        
        document.getElementById("mensajeCi").innerHTML =`<p id="pmsj" class='pmsj'>¡La cedula ingresada ya está registrada!</p>`;
        document.getElementById('log').setAttribute("disabled", true);
      }
    }
  };
}