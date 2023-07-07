"use strict";

//funcion de MODAL CONFIRM en editar usuario
// Obtener el formulario por su ID
var form = document.getElementById("editForm"); // Agregar un controlador de eventos para el evento submit

form.addEventListener("submit", function (event) {
  // Detener el envío del formulario
  event.preventDefault(); // Obtener el valor y el texto de la opción seleccionada en el selector de estado

  var estadoSelect = document.getElementById("Estados");
  var estadoOption = estadoSelect.options[estadoSelect.selectedIndex];
  var estadoValue = estadoOption.value;
  var estadoText = estadoOption.textContent; // Obtener el valor y el texto de la opción seleccionada en el selector de ciudad

  var ciudadSelect = document.getElementById("Ciudades");
  var ciudadOption = ciudadSelect.options[ciudadSelect.selectedIndex];
  var ciudadValue = ciudadOption.value;
  var ciudadText = ciudadOption.textContent; // Obtener el valor y el texto de la opción seleccionada en el selector de sede

  var sedeSelect = document.getElementById("Sede");
  var sedeOption = sedeSelect.options[sedeSelect.selectedIndex];
  var sedeValue = sedeOption.value;
  var sedeText = sedeOption.textContent; // Crear un objeto con los datos del formulario

  var formData = {
    "cedula": document.getElementById("Ci").value,
    "nombre": document.getElementById("Name").value,
    "apellido": document.getElementById("Apellido").value,
    "telefono": document.getElementById("Phone").value,
    "estado": estadoText,
    "ciudad": ciudadText,
    "sede": sedeText,
    "email": document.getElementById("Email").value,
    "direccion": document.getElementById("Direccion").value
  }; // Función para crear los elementos HTML y agregarlos al MODAL

  function mostrarDatosFormulario() {
    var tableHtml = '<table>' + '<tr>' + '<th>Campo</th>' + '<th style="width:1rem;"></th>' + '<th>Antes</th>' + '<th style="width:1rem;"></th>' + '<th>Después</th>' + '</tr>'; //variable booleana para condicionales

    var hasChanges = false; //Se utiliza el método $.each() de jQuery para iterar sobre cada campo del objeto formData.

    $.each(formData, function (key, value) {
      var beforeValue = datosFormularioPre[key]; //Se utiliza una condición if para verificar si el valor del campo ha cambiado.

      if (value !== beforeValue) {
        tableHtml += '<tr>' + '<td>' + key + '</td>' + '<th style="width:1rem;"></th>' + '<td>' + beforeValue + '</td>' + '<th style="width:1rem;"></th>' + '<td>' + value + '</td>' + '</tr>';
        hasChanges = true;
      } else {}
    });

    if (!hasChanges) {
      tableHtml = 'No haz realizado cambios';
    }

    tableHtml += '</table>';
    return tableHtml;
  } // Muestra el diálogo de confirmación y llama a la función para mostrar los datos del formulario


  $.confirm({
    title: "Confirmar solicitud",
    content: mostrarDatosFormulario(),
    columnClass: 'col-md-7 col-md-offset-2',
    //tamaño del modal
    dragWindowBorder: false,
    // Desactivar la opción de arrastrar y soltar el modal
    boxWidth: '50%',
    buttons: {
      enviar: {
        text: "Enviar",
        action: function action() {
          console.log($(form).serialize()); // Si el usuario hace clic en "Enviar"
          // Enviar el formulario con AJAX

          $("#editForm").submit();
        }
      },
      cancelar: {
        text: "Cancelar solicitud",
        action: function action() {// Si el usuario hace clic en "Cancelar solicitud"
          // No se hace nada
        }
      }
    }
  });
});