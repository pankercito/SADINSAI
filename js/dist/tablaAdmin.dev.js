"use strict";

// DATATABLE PARA SOLICITUDES
var table = new DataTable('#table', {
  ajax: {
    url: "../php/preset/viewSolicitudesAdmin.php",
    dataSrc: 'data'
  },
  initComplete: function initComplete() {
    // agregar filtros (selectores) a tabla 
    this.api().columns([3]).every(function () {
      var column = this;
      var select = $('<select class="filterE"><option value="">Tipo</option></select>').appendTo($(column.header()).empty()).on('change', function () {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', true, false).draw();
      });
      column.data().unique().sort().each(function (d, j) {
        select.append('<option value="' + d + '">' + d + '</option>');
      });
    });
  },
  // orden de carga inicial
  order: [[2, 'desc']],
  language: {
    "decimal": "",
    "emptyTable": "No hay información",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
    "infoPostFix": "",
    "thousands": ",",
    "lengthMenu": "Mostrar _MENU_ Entradas",
    "loadingRecords": "Cargando...",
    "processing": "Procesando...",
    "search": "Buscar:",
    "zeroRecords": "Sin resultados encontrados",
    "paginate": {
      "first": "Primero",
      "last": "Ultimo",
      "next": "Siguiente",
      "previous": "Anterior"
    }
  }
}); //APR STATES************************************

function aprStates(idSolis, tipoS) {
  var idSoli = idSolis;
  var tipo = tipoS;
  var parametro = {
    "idSoli": idSoli,
    "receptor": tipo
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
        content: "\n                          <div class=\"d-flex justify-content-center\">\n                                            <div class=\"spinner-border\" role=\"status\">\n                               <span class=\"visually-hidden\">procesando...</span>\n                          </div>\n                          </div>"
      }); //CERRAR EL DIALOG ANTERIOR

      setTimeout(function () {
        obj.close();
      }, 501);
    },
    error: function error(jqXHR, xhr, status, _error) {
      var nroERROR = jqXHR.status;
      setTimeout(function () {
        alert("Estatus " + status + nroERROR + xhr + _error);
      }, 500);
    },
    success: function success(response) {
      contenido = response; // Mostrar el diálogo de confirmación CAMBIO DE ESTATUS

      setTimeout(function () {
        $.confirm({
          title: '',
          content: contenido,
          columnClass: 'col-md-8 col-md-offset-4',
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
                            "idSoli": idSoli,
                            "tipo": tipo
                          };
                          $.ajax({
                            data: aRadio,
                            url: '../php/solicitudMerge.php',
                            type: 'POST',
                            beforeSend: function beforeSend() {
                              var obj = $.dialog({
                                title: false,
                                closeIcon: false,
                                // hides the close icon.
                                content: "\n                                                                        <div class=\"d-flex justify-content-center\">\n                                                                        <div class=\"spinner-border\" role=\"status\">\n                                                                            <span class=\"visually-hidden\">cargando...</span>\n                                                                        </div>\n                                                                        </div>"
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
                              var c = cEc; //PANTALLAS DE SUCCES DE SOLICITUDES

                              if (jeisonXD(c)) {
                                var colon = JSON.parse(c);
                                var locat = colon[0]['redirec'];
                                var conten = colon[0]['estado'];
                                setTimeout(function () {
                                  if (conten == "succes.personal.ingres" || conten == "succes.personal.edit" || conten == "succes.arch.ingres" || conten == "succes.arch.move") {
                                    $.confirm({
                                      title: 'Se acepto solicitud con exito',
                                      content: false,
                                      buttons: {
                                        d: {
                                          text: 'ver perfil',
                                          action: function action() {
                                            location.replace(locat);
                                          }
                                        },
                                        da: {
                                          text: 'cerrar',
                                          action: function action() {
                                            table.ajax.reload(null, false);
                                          }
                                        }
                                      }
                                    });
                                  }
                                }, 500);
                              } else if (c == "succes.personal.rechazar" || c == "success.personal.edit.rechazar" || c == "success.archivo.eliminar.rechazar" || c == "success.archivo.ingreso") {
                                $.confirm({
                                  title: 'se rechazo solicitud con exito',
                                  content: false,
                                  buttons: {
                                    da: {
                                      text: 'cerrar',
                                      action: function action() {
                                        table.ajax.reload(null, false);
                                      }
                                    }
                                  }
                                });
                              } else {
                                $.confirm({
                                  title: 'error',
                                  content: c,
                                  buttons: {
                                    da: {
                                      text: 'cerrar',
                                      action: function action() {
                                        table.ajax.reload(null, false);
                                      }
                                    }
                                  }
                                });
                              }
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
}

; // RECARGA DE LA TABLA AUTOMATICA CADA 1M || NUMERO EN MILISEGUNDOS

setInterval(function () {
  table.ajax.reload(null, false);
}, 10000);