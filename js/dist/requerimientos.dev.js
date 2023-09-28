"use strict";

function requerido(ci) {
  var cedul = ci;
  $.ajax({
    data: {
      "cedula": cedul
    },
    url: "../layout/requerimientos.php",
    type: "post",
    success: function success(conten) {
      $.confirm({
        title: "Archivos Requeridos",
        content: conten,
        columnClass: 'col-md-10 col-md-offset-10 col-xs-4 col-xs-offset-8',
        buttons: {
          ab: {
            text: "guardar",
            btnClass: "btn-success",
            action: function action() {
              var checks = document.getElementById("requerimentos");
              var form = new FormData(checks);
              form.append("cedula", cedul);
              $.ajax({
                data: form,
                url: "../php/requeriSave.php",
                type: "post",
                processData: false,
                contentType: false,
                beforeSend: function beforeSend() {
                  var obj = $.dialog({
                    title: false,
                    closeIcon: false,
                    // ocultar close icon.
                    content: "\n                                            <div class=\"d-flex my-3 justify-content-center\">\n                                            <div class=\"spinner-border\" role=\"status\">\n                                                <span class=\"visually-hidden\">procesando...</span>\n                                            </div>\n                                            </div>"
                  });
                  setTimeout(function () {
                    obj.close();
                  }, 501);
                },
                error: function error() {
                  setTimeout(function () {
                    $.dialog({
                      title: false,
                      content: "\n                                            <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                <i class=\"bi-patch-exclamation-fill\" style=\"font-size: 5rem; color: red;\"></i>\n                                                <h6  style=\"color: red;\"> Error</h6>\n                                                <span class=\"\" style=\"color: red;\" disabled>\n                                                    por favor intente nuevamente\n                                                </span>\n                                            </div>"
                    });
                  }, 500);
                },
                success: function success(cc) {
                  setTimeout(function () {
                    if (cc == "success") {
                      $.confirm({
                        title: '',
                        content: " \n                                                <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                    <i class=\"bi-check-circle\" style=\"font-size: 5rem; color: green;\"></i>\n                                                    <span class=\"\" style=\"color: #008000;\" disabled>\n                                                        <span role=\"status\" style=\"color: green\" >se guardo correctamente</span>\n                                                    </span>\n                                                </div>",
                        buttons: {
                          da: {
                            text: 'cerrar',
                            action: function action() {}
                          }
                        }
                      });
                    } else {
                      $.confirm({
                        title: 'error',
                        content: cc,
                        buttons: {
                          da: {
                            text: 'cerrar',
                            action: function action() {}
                          }
                        }
                      });
                    }
                  }, 500);
                }
              });
            }
          },
          cb: {
            text: "cerrar",
            btnClass: "btn-dark",
            action: function action() {}
          }
        }
      });
    }
  });
}