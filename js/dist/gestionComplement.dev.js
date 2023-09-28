"use strict";

function _templateObject() {
  var data = _taggedTemplateLiteral(["<div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                                        <i class=\"bi-patch-exclamation-fill\" style=\"font-size: 5rem; color: red;\"></i>\n                                                                        <h6  style=\"color: red;\"> Error</h6>\n                                                                        <span class=\"\" style=\"color: red;\" disabled>\n                                                                            por favor intente nuevamente\n                                                                        </span>\n                                                                    </div>\n                                                                    </div>"]);

  _templateObject = function _templateObject() {
    return data;
  };

  return data;
}

function _taggedTemplateLiteral(strings, raw) { if (!raw) { raw = strings.slice(0); } return Object.freeze(Object.defineProperties(strings, { raw: { value: Object.freeze(raw) } })); }

//funcion para optener parametros GET
function getQueryVariable(variable) {
  var query = window.location.search.substring(1);
  var vars = query.split("&");

  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");

    if (pair[0] == variable) {
      return pair[1];
    }
  }

  return false;
}

var form = document.getElementById("newDoc"); // Agregar un controlador de eventos para el evento click

form.addEventListener("click", modalcito);

function modalcito() {
  var ciUser = getQueryVariable('carga');
  var tipoDarch = getQueryVariable('gestion');
  rows = {
    "gestion": tipoDarch,
    "carga": ciUser
  };
  $.ajax({
    data: rows,
    url: "../layout/documentForm.php",
    type: "get",
    error: function error(_error) {
      $.alert({
        title: "error al cargar datos",
        content: "Hubo un error: " + _error
      });
    },
    success: function success(respuesta) {
      // modal de documentForm
      $.confirm({
        title: "nuevo documento",
        content: respuesta,
        columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
        onContentReady: function onContentReady() {
          var inputFile = document.getElementById('inpArch');
          var inputText = document.getElementById('nameArchive'); // Nombre del archivo en input name automaticamente y tamaño a 2mb

          inputFile.addEventListener('change', function (e) {
            var img = document.getElementById('docImg');
            var file = e.target.files[0];
            var dar = file.name.split('.').pop(); // alerta de limite 

            if (file.size > 2097152) {
              // 2 MB
              alert("El archivo PDF/imagen no debe exceder los 2 MB.");
              inputFile.value = "";
              inputText.value = "";
              img.src = "../resources/doc.png";
            } else {
              var read = new FileReader(e);

              read.onload = function (e) {
                img.src = e.target.result;
              };

              read.readAsDataURL(file);
              inputText.value = file.name; // Edición del inputText si se escribe manualmente el nombre y no se encuentra ninguna extensión

              inputText.addEventListener('input', function (event) {
                var extension = inputText.value.split('.').pop();

                if (!extension) {
                  inputText.value += "." + dar;
                }
              });
            }
          });
          var self = this; // desactivar boton enviar

          this.buttons.d.disable(); // colores de verificacion y activacion de input password 

          this.$content.find('#inpArch').change(function () {
            // activar boton de procesar 
            if (self.$content.find('#inpArch').val() != "") {
              self.buttons.d.enable();
            } else {
              self.buttons.d.disable();
            }
          });
        },
        buttons: {
          d: {
            text: "procesar",
            btnClass: "btn-green",
            action: function action() {
              var form = document.getElementById('caro'); // Creamos un objeto con los datos del formulario

              var formData = new FormData(form); // modal de confirmacion

              $.confirm({
                title: false,
                content: "esta seguro que desea cargar este archivo?",
                buttons: {
                  subir: {
                    text: "subir",
                    btnClass: "btn-green",
                    action: function action() {
                      // Enviamos el formulario por Ajax
                      $.ajax({
                        data: formData,
                        processData: false,
                        contentType: false,
                        url: "../php/registroSolicitud.php",
                        type: "POST",
                        beforeSend: function beforeSend() {
                          var obj = $.dialog({
                            title: false,
                            closeIcon: false,
                            // hides the close icon.
                            content: "\n                                                                    <div class=\"d-flex justify-content-center\">\n                                                                                        <div class=\"spinner-border\" role=\"status\">\n                                                                        <span class=\"visually-hidden\">Redirigiendo...</span>\n                                                                    </div>\n                                                                    </div>"
                          }); //CERRAR EL DIALOG ANTERIOR

                          setTimeout(function () {
                            obj.close();
                          }, 501);
                        },
                        error: function error(_error2) {
                          // MENSAJE SUCCES
                          setTimeout(function () {
                            $.alert({
                              title: false,
                              closeIcon: false,
                              // hides the close icon.
                              content: _error2(_templateObject()),
                              button: {}
                            });
                          }, 500);
                        },
                        success: function success(data) {
                          // Si la respuesta es exitosa, imprimimos el mensaje de éxito 
                          var dataT = data;

                          if (dataT == "success") {
                            // MENSAJE SUCCES
                            setTimeout(function () {
                              $.dialog({
                                title: false,
                                closeIcon: false,
                                // hides the close icon.
                                content: "\n                                                                        <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                                                            <i class=\"bi-check-circle\" style=\"font-size: 5rem; color: green;\"></i>\n                                                                                            <span class=\"\" style=\"color: #008000;\" disabled>\n                                                                                                <span class=\"spinner-border spinner-border-sm\"  aria-hidden=\"true\"></span>\n                                                                                                <span role=\"status\" style=\"color: green\"  >Loading...</span>\n                                                                                            </span>\n                                                                        </div>\n                                                                        </div>"
                              });
                            }, 500);
                            setTimeout(function () {
                              location.replace("solicitudes.php");
                            }, 2500);
                          } else {
                            $.dialog({
                              title: false,
                              content: "<div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                                        <i class=\"bi-patch-exclamation-fill\" style=\"font-size: 5rem; color: red;\"></i>\n                                                                        <h6  style=\"color: red;\"> Error</h6>\n                                                                        <span class=\"\" style=\"color: red;\" disabled>\n                                                                            por favor intente nuevamente\n                                                                        </span>\n                                                                    </div>\n                                                                    </div>"
                            });
                          }
                        }
                      });
                    }
                  },
                  cancelar: {
                    text: "cerrar",
                    action: function action() {// Si el usuario hace clic en "Cancelar solicitud"
                      // No se hace nada
                    }
                  }
                }
              });
            }
          },
          c: {
            text: "cerrar",
            action: function action() {}
          }
        }
      });
    }
  });
}

var tipoDarch = getQueryVariable('gestion'); // ocultar agregar documentos en el area de planillas

$(document).ready(function () {
  if (tipoDarch == "1046") {
    document.getElementById("tittleDoc").innerHTML = "Campos";
    document.title = "SADINSAI | Planillas";
  }
});