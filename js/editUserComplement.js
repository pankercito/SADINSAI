//boton de editar
const editar = document.getElementById("editar");

editar.addEventListener("click", bue);

//funcion de boton ocultal todo y enjecutar todas la funciones
function bue() {
  agregarSelectedE(idE);
  //cambiar titulo y variable para complemento
  document.title = "SADINSAI | Editar usuario";

  //ocultar colunmas adicionales para pantalla de editar
  document.getElementById("centro").style.display = "none";
  document.getElementById("columna").style.display = "none";
  document.getElementById("centroEdit").style.display = "unset";
  setTimeout(() => {

    agregarSelectedAll(idC, idS);
  }, 500);
}

//funcion de preselecion de selectores
function agregarSelectedE(valor1) {
  // Obtener los elementos select del DOM
  var selectE = document.getElementById("Estados");

  // Establecer el valor seleccionado en los selectores
  for (var i = 0; i < selectE.options.length; i++) {
    var option = selectE.options[i];
    if (option.value == valor1) {
      option.selected = true;
    }
  }
  // Llamar al evento change en el selector de Estado
  $("#Estados").trigger('change');

}

//funcion de preselecion de selectores
function agregarSelectedAll(valor2, valor3) {
  setTimeout(() => {
    var selectC = document.getElementById("Ciudades");
    var selectS = document.getElementById("Sede");
    for (var i = 0; i < selectC.options.length; i++) {
      var option = selectC.options[i];
      if (option.value == valor2) {
        option.selected = true;
      }
    }
    for (var i = 0; i < selectS.options.length; i++) {
      var option = selectS.options[i];
      if (option.value == valor3) {
        option.selected = true;
      }
    }
  }, 50);
}

//************************************************************************************