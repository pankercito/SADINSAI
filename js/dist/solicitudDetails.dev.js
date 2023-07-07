"use strict";

$(document).ready(function () {
  // Agregar un controlador de eventos para el evento click del botón
  $('a.viewDetails.btn.btn').click(function (event) {
    event.preventDefault(); // Prevenir la acción por defecto del enlace
    // Obtener los datos de la fila de la tabla

    var fila = $(this).closest('tr'); // Obtener la fila más cercana al botón

    var idSoli = fila.data('solicitud');
    var parametro = {
      "idSoli": idSoli
    };
    var contenido = "no";
    $.ajax({
      data: parametro,
      url: '../php/preset/viewDetails.php',
      type: 'POST',
      beforeSend: function beforeSend() {},
      error: function error(jqXHR, xhr, status, _error) {
        var nroERROR = jqXHR.status;
        alert("Estatus " + status);
      },
      success: function success(response) {
        contenido = response; // Mostrar el diálogo de confirmación

        $.confirm({
          title: 'Detalles',
          content: contenido,
          columnClass: 'col-md-5 col-md-offset-2',
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
  });
});