"use strict";

//DETALLES *************************************
function detalles(idSolis, tipoS) {
  var idSoli = idSolis;
  var tipo = tipoS; // Obtener los datos

  var parametro = {
    "idSoli": idSoli,
    "tipoSoli": tipo
  };
  var contenido = "no";
  $.ajax({
    data: parametro,
    url: '../php/preset/viewDetails.php',
    type: 'POST',
    error: function error(jqXHR, xhr, status, _error) {
      var nroERROR = jqXHR.status;
      alert("Estatus " + status);
    },
    success: function success(response) {
      contenido = response; // Mostrar el diálogo de confirmación

      $.confirm({
        title: '',
        content: contenido,
        columnClass: 'col-md-8 col-md-offset-4',
        boxWidth: '50%',
        buttons: {
          cerrar: {
            text: 'cerrar',
            action: function action() {//funcion a realizar
            }
          }
        }
      });
    }
  });
}

;