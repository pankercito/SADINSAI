const buttonLog = document.getElementById('log');
const departamento = document.getElementById('Depa');
const cargo = document.getElementById('Cargo');
const sedeSelect = document.getElementById('Sede');
const estadoSelect = document.getElementById('Estados');
const ciudadSelect = document.getElementById('Ciudades');

function enableButton() {
  const inputs = [inputName, inputLastName, inputCi, inputDireccion, inputPhone, inputEmail, inputGrado];

  const allInputsLlenos = inputs.every(input => input.value.trim() !== '');
  const allSelectsActivos = estadoSelect.selectedIndex !== 0 && sedeSelect.selectedIndex !== 0 && departamento.selectedIndex !== 0 && cargo.selectedIndex !== 0 && ciudadSelect.selectedIndex !== 0;
  //La funcion ".toggle" agrega o quita una clase CSS dependiendo de si la clase ya existe o no
  buttonLog.disabled = !(allInputsLlenos && allSelectsActivos);
}

// Llama a la función enableButton cada vez que se escriba algo en los campos o se seleccione una opción en los selectores
[inputName, inputLastName, inputCi, inputDireccion, inputPhone, inputEmail, inputGrado, estadoSelect, ciudadSelect, departamento, cargo, sedeSelect].forEach(element => {
  element.addEventListener('input', enableButton);
  element.addEventListener('change', enableButton);
});

//funcion especifica para CI validation
function verificarCI() {
  let ci = document.getElementById("Ci").value;

  $.ajax({
    url: "../php/verificarCi.php",
    type: "post",
    data: {
      'ci': ci
    },
    success: function (responseText) {
      let respuesta = responseText;

      switch (respuesta) {
        case "¡La CI ingresada ya está registrada!":
          document.getElementById("mensajeCi").innerHTML = `<h6 class='pmsj'>¡La cedula ingresada ya está registrada!</h6>`;
          document.getElementById('log').setAttribute("disabled", true);
          break;
        case "true":
          document.getElementById("mensajeCi").innerHTML = `<h6 class='pmsj'>¡La cedula ingresada ya está registrada!</h6>`;
          document.getElementById('log').setAttribute("disabled", true);
          break
        case "":
          document.getElementById("mensajeCi").innerHTML = "";
          document.getElementById('log').setAttribute("disabled", true)
          break
        default:
          document.getElementById("mensajeCi").innerHTML = "";
          document.getElementById('log').setAttribute("disabled", true)
          break;
      }
    },
  });
}