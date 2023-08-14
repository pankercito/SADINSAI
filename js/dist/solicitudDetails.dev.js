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
      beforeSend: function beforeSend() {
        var obj = $.dialog({
          title: false,
          closeIcon: false,
          // hides the close icon.
          content: "\n                          <div class=\"d-flex justify-content-center\">\n                                            <div class=\"spinner-border\" role=\"status\">\n                               <span class=\"visually-hidden\">Loading...</span>\n                          </div>\n                          </div>"
        }); //CERRAR EL DIALOG ANTERIOR

        setTimeout(function () {
          obj.close();
        }, 501);
      },
      error: function error(jqXHR, xhr, status, _error2) {
        var nroERROR = jqXHR.status;
        setTimeout(function () {
          alert("Estatus " + status + nroERROR + xhr + _error2);
        }, 500);
      },
      success: function success(response) {
        contenido = response; // Mostrar el diálogo de confirmación CAMBIO DE ESTATUS

        setTimeout(function () {
          $.confirm({
            title: 'Cambiar estatus',
            content: contenido,
            columnClass: 'col-md-5 col-md-offset-2',
            boxWidth: '50%',
            buttons: {
              aceptar: {
                text: 'Aceptar',
                action: function action() {
                  var radio = document.querySelector('input[name="editSoli"]:checked'); //PANEL  DE  VERIFICACIONN DE RADIOS 

                  if (radio.value != 0) {
                    // MODAL DE CONFIRMACION
                    $.confirm({
                      title: '',
                      content: '¿Esta seguro de realizar esta operacion?',
                      buttons: {
                        aceptar: {
                          text: 'Sí, Aceptar',
                          action: function action() {
                            var aRadio = {
                              "radio": radio.value,
                              "idSoli": idSoli
                            };
                            $.ajax({
                              data: aRadio,
                              url: '../php/personalMerge.php',
                              type: 'POST',
                              beforeSend: function beforeSend() {
                                var obj = $.dialog({
                                  title: false,
                                  closeIcon: false,
                                  // hides the close icon.
                                  content: "\n                                                                        <div class=\"d-flex justify-content-center\">\n                                                                        <div class=\"spinner-border\" role=\"status\">\n                                                                            <span class=\"visually-hidden\">Loading...</span>\n                                                                        </div>\n                                                                        </div>"
                                });
                                setTimeout(function () {
                                  obj.close();
                                }, 501);
                              },
                              error: function error() {
                                setTimeout(function () {
                                  $.dialog({
                                    title: false,
                                    // hides the title.
                                    content: "\n                                                                        <div class=\"d-flex justify-content-center\">\n                                                                        <h6> error al procesar la solicitud </h6>\n                                                                        <i class=\"bi bi-arrow\"></i>\n                                                                        </div>\n                                                                        </div>"
                                  });
                                }, 500);
                              },
                              success: function success(cEc) {
                                var c = cEc;
                                setTimeout(function () {
                                  $.confirm({
                                    title: 'Accion se realizo con exito',
                                    content: false,
                                    buttons: {
                                      d: {
                                        text: 'ver perfil',
                                        action: function action() {
                                          location.replace(c);
                                        }
                                      },
                                      da: {
                                        text: 'cerrar',
                                        action: function action() {
                                          location.reload();
                                        }
                                      }
                                    }
                                  });
                                }, 500);
                              },
                              complete: function complete() {// Ocultar el indicador de carga o spinner
                              }
                            });
                          }
                        },
                        cerrar: {
                          text: 'No, Cerrar',
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
        }, 500);
        ;
      }
    });
  });
});