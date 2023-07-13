"use strict";

//DETALLES *************************************
$(document).ready(function () {
  // Agregar un controlador de eventos para el evento click del botón
  $('a.viewDetails.btn.btn').click(function (event) {
    event.preventDefault(); // Prevenir la acción por defecto del enlace
    // Obtener los datos de la fila de la tabla

    var fila = $(this).closest('tr'); // Obtener la fila más cercana al botón

    var idSoli = fila.data('solicitud');
    var ciReceptor = fila.data('receptor');
    var parametro = {
      "idSoli": idSoli,
      "receptor": ciReceptor
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
}); //APR STATES************************************

$(document).ready(function () {
  // Agregar un controlador de eventos para el evento click del botón
  $('a.aprState:not([disabled])').click(function (event) {
    event.preventDefault(); // Prevenir la acción por defecto del enlace
    // Obtener los datos de la fila de la tabla

    var fila = $(this).closest('tr'); // Obtener la fila más cercana al botón

    var idSoli = fila.data('solicitud');
    var ciReceptor = fila.data('receptor');
    var parametro = {
      "idSoli": idSoli,
      "receptor": ciReceptor
    };
    var contenido = "no";
    $.ajax({
      data: parametro,
      url: '../php/viewMerge.php',
      type: 'POST',
      beforeSend: function beforeSend() {},
      error: function error(jqXHR, xhr, status, _error2) {
        var nroERROR = jqXHR.status;
        alert("Estatus " + status);
      },
      success: function success(response) {
        contenido = response; // Mostrar el diálogo de confirmación

        $.confirm({
          title: 'Cambiar estatus',
          content: contenido,
          columnClass: 'col-md-5 col-md-offset-2',
          boxWidth: '50%',
          buttons: {
            aceptar: {
              text: 'Aceptar',
              action: function action() {
                var radio = document.querySelector('input[name="editSoli"]:checked'); //PANEL  DE  VERIFICACIONN

                if (radio.value != 0) {
                  $.confirm({
                    title: '',
                    content: '¿Esta seguro de realizar esta operacion?',
                    buttons: {
                      aceptar: {
                        text: 'Sí Aceptar',
                        action: function action() {
                          var aRadio = {
                            "radio": radio.value,
                            "idSoli": idSoli
                          };
                          $.ajax({
                            data: aRadio,
                            url: '../php/personalMerge.php',
                            type: 'POST',
                            beforeSend: function beforeSend() {},
                            error: function error() {
                              $.confirm({
                                title: '',
                                content: "\n                                                                <div class=\"d-flex justify-content-center\">\n                                                                <div class=\"spinner-border\" role=\"status\">\n                                                                    <span class=\"visually-hidden\">Loading...</span>\n                                                                </div>\n                                                                </div>",
                                buttons: {
                                  aceptar: {
                                    text: 'aceptar'
                                  }
                                }
                              });
                            },
                            success: function success(cEc) {
                              var cec = cEc;
                              $.confirm({
                                title: '',
                                content: cec,
                                buttons: {
                                  d: {
                                    text: 'cerrar',
                                    action: function action() {
                                      location.reload();
                                    }
                                  }
                                }
                              });
                            },
                            complete: function complete() {// Ocultar el indicador de carga o spinner
                            }
                          });
                        }
                      },
                      cerrar: {
                        text: 'No Cerrar',
                        action: function action() {}
                      }
                    }
                  });
                } else {//no  hace nada
                }
              }
            },
            cerrar: {
              text: 'Cerrar',
              action: function action() {//funcion a realizar
              }
            }
          }
        });
      }
    });
  });
});