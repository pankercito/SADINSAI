"use strict";

// DATATABLES VER USUARIOS ********************
var table = $('#table').DataTable({
  ajax: {
    url: " ../php/preset/viewRegister.php",
    dataSrc: 'data'
  },
  order: [[4, 'asc']],
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
}); //PANTALLA PARA DESACTIVAR/ACTIVAR USERS *************************************

function gestionUser(idUserd) {
  var idUser = idUserd;
  $.confirm({
    title: "",
    content: 'url:../layout/activeUserLayout.php',
    buttons: {
      ac: {
        text: "aceptar",
        action: function action() {
          var radio = document.querySelector('input[name="btnradio"]:checked');

          if (radio.value != 0) {
            $.ajax({
              data: {
                "radio": radio.value,
                "userId": idUser
              },
              type: "post",
              url: "../php/activeUser.php",
              beforeSend: function beforeSend() {
                var obj = $.dialog({
                  title: false,
                  closeIcon: false,
                  // ocultar close icon.
                  content: "\n                                        <div class=\"d-flex my-3 justify-content-center\">\n                                        <div class=\"spinner-border\" role=\"status\">\n                                            <span class=\"visually-hidden\">procesando...</span>\n                                        </div>\n                                        </div>"
                });
                setTimeout(function () {
                  obj.close();
                }, 501);
              },
              error: function error() {
                setTimeout(function () {
                  $.dialog({
                    title: false,
                    content: "\n                                        <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                            <i class=\"bi-patch-exclamation-fill\" style=\"font-size: 5rem; color: red;\"></i>\n                                            <h6  style=\"color: red;\"> Error</h6>\n                                            <span class=\"\" style=\"color: red;\" disabled>\n                                                por favor intente nuevamente\n                                            </span>\n                                        </div>"
                  });
                }, 500);
              },
              success: function success(cc) {
                setTimeout(function () {
                  if (cc == "success.rech") {
                    $.confirm({
                      title: '',
                      content: " \n                                            <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                <i class=\"bi-check-circle\" style=\"font-size: 5rem; color: green;\"></i>\n                                                <span class=\"\" style=\"color: #008000;\" disabled>\n                                                    <span role=\"status\" style=\"color: red\">se desactivo correctamente</span>\n                                                </span>\n                                            </div>",
                      buttons: {
                        da: {
                          text: 'cerrar',
                          action: function action() {
                            var obj = $.dialog({
                              title: false,
                              closeIcon: false,
                              // ocultar close icon.
                              content: "\n                                                                <div class=\"d-flex my-3 justify-content-center\">\n                                                                <div class=\"spinner-border\" role=\"status\">\n                                                                    <span class=\"visually-hidden\">actualizando...</span>\n                                                                </div>\n                                                                </div>"
                            });
                            setTimeout(function () {
                              table.ajax.reload(null, false);
                              obj.close();
                            }, 800);
                          }
                        }
                      }
                    });
                  } else if (cc == "success") {
                    $.confirm({
                      title: '',
                      content: " \n                                            <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                <i class=\"bi-check-circle\" style=\"font-size: 5rem; color: green;\"></i>\n                                                <span class=\"\" style=\"color: #008000;\" disabled>\n                                                    <span role=\"status\" style=\"color: green\"  >se activo correctamente</span>\n                                                </span>\n                                            </div>",
                      buttons: {
                        da: {
                          text: 'cerrar',
                          action: function action() {
                            var obj = $.dialog({
                              title: false,
                              closeIcon: false,
                              // ocultar close icon.
                              content: "\n                                                                <div class=\"d-flex my-3 justify-content-center\">\n                                                                <div class=\"spinner-border\" role=\"status\">\n                                                                    <span class=\"visually-hidden\">actualizando...</span>\n                                                                </div>\n                                                                </div>"
                            });
                            setTimeout(function () {
                              table.ajax.reload(null, false);
                              obj.close();
                            }, 800);
                          }
                        }
                      }
                    });
                  } else {
                    $.dialog({
                      title: false,
                      content: "\n                                            <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                <i class=\"bi-patch-exclamation-fill\" style=\"font-size: 5rem; color: red;\"></i>\n                                                <h6  style=\"color: red;\"> Error</h6>\n                                                <span class=\"\" style=\"color: red;\" disabled>\n                                                    por favor intente nuevamente\n                                                </span>\n                                            </div>"
                    });
                  }
                }, 500);
              }
            });
          }
        }
      },
      cl: {
        text: "cerrar",
        action: function action() {}
      }
    }
  });
}

;

function deleteUser(idUserd) {
  var idUser = idUserd;
  $.confirm({
    title: "eliminar usuario",
    content: 'eliminara este usuario de forma permanente',
    buttons: {
      ac: {
        text: "aceptar",
        action: function action() {
          $.ajax({
            data: {
              "userId": idUser
            },
            type: "post",
            url: "../php/deleteUser.php",
            beforeSend: function beforeSend() {
              var obj = $.dialog({
                title: false,
                closeIcon: false,
                // ocultar close icon.
                content: "\n                                        <div class=\"d-flex my-3 justify-content-center\">\n                                        <div class=\"spinner-border\" role=\"status\">\n                                            <span class=\"visually-hidden\">procesando...</span>\n                                        </div>\n                                        </div>"
              });
              setTimeout(function () {
                obj.close();
              }, 501);
            },
            error: function error() {
              setTimeout(function () {
                $.dialog({
                  title: false,
                  content: "\n                                        <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                            <i class=\"bi-patch-exclamation-fill\" style=\"font-size: 5rem; color: red;\"></i>\n                                            <h6  style=\"color: red;\"> Error</h6>\n                                            <span class=\"\" style=\"color: red;\" disabled>\n                                                por favor intente nuevamente\n                                            </span>\n                                        </div>"
                });
              }, 500);
            },
            success: function success(cc) {
              setTimeout(function () {
                if (cc == "success.dele") {
                  $.confirm({
                    title: '',
                    content: " \n                                            <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                <i class=\"bi-check-circle\" style=\"font-size: 5rem; color: green;\"></i>\n                                                <span class=\"\" style=\"color: #008000;\" disabled>\n                                                    <span role=\"status\" style=\"color: red\">se elimino correctamente</span>\n                                                </span>\n                                            </div>",
                    buttons: {
                      da: {
                        text: 'cerrar',
                        action: function action() {
                          var obj = $.dialog({
                            title: false,
                            closeIcon: false,
                            // ocultar close icon.
                            content: "\n                                                                <div class=\"d-flex my-3 justify-content-center\">\n                                                                <div class=\"spinner-border\" role=\"status\">\n                                                                    <span class=\"visually-hidden\">actualizando...</span>\n                                                                </div>\n                                                                </div>"
                          });
                          setTimeout(function () {
                            table.ajax.reload(null, false);
                            obj.close();
                          }, 800);
                        }
                      }
                    }
                  });
                } else {
                  $.dialog({
                    title: false,
                    content: "\n                                            <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                <i class=\"bi-patch-exclamation-fill\" style=\"font-size: 5rem; color: red;\"></i>\n                                                <h6  style=\"color: red;\"> Error</h6>\n                                                <span class=\"\" style=\"color: red;\" disabled>\n                                                    por favor intente nuevamente\n                                                </span>\n                                            </div>"
                  });
                }
              }, 500);
            }
          });
        }
      },
      cl: {
        text: "cerrar",
        action: function action() {}
      }
    }
  });
}