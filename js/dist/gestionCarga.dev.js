"use strict";

function _templateObject() {
  var data = _taggedTemplateLiteral(["<div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                        <i class=\"bi-patch-exclamation-fill\" style=\"font-size: 5rem; color: red;\"></i>\n                                                        <h6  style=\"color: red;\"> Error</h6>\n                                                        <span class=\"\" style=\"color: red;\" disabled>\n                                                            por favor intente nuevamente\n                                                        </span>\n                                                    </div>\n                                                    </div>"]);

  _templateObject = function _templateObject() {
    return data;
  };

  return data;
}

function _taggedTemplateLiteral(strings, raw) { if (!raw) { raw = strings.slice(0); } return Object.freeze(Object.defineProperties(strings, { raw: { value: Object.freeze(raw) } })); }

// funcion general de envio de imagen 
$(document).ready(function () {
  // Cuando el usuario hace clic en el botón de enviar, enviamos el formulario por Ajax
  $("#caro").submit(function (event) {
    event.preventDefault(); // Creamos un objeto FormData con los datos del formulario

    var formData = new FormData(this); // modal de confirmacion

    $.confirm({
      title: false,
      content: "esta seguro que desea cargar este archivo?",
      buttons: {
        subir: {
          text: "subir",
          action: function action() {
            // Enviamos el formulario por Ajax a la página `procesArchives.php`
            $.ajax({
              data: formData,
              url: "../php/procesArchives.php",
              type: "POST",
              processData: false,
              contentType: false,
              beforeSend: function beforeSend() {
                var obj = $.dialog({
                  title: false,
                  closeIcon: false,
                  // hides the close icon.
                  content: "\n                                      <div class=\"d-flex justify-content-center\">\n                                                        <div class=\"spinner-border\" role=\"status\">\n                                           <span class=\"visually-hidden\">Loading...</span>\n                                      </div>\n                                      </div>"
                }); //CERRAR EL DIALOG ANTERIOR

                setTimeout(function () {
                  obj.close();
                }, 501);
              },
              error: function error(_error) {
                // MENSAJE SUCCES
                setTimeout(function () {
                  $.alert({
                    title: false,
                    closeIcon: false,
                    // hides the close icon.
                    content: _error(_templateObject()),
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
                      content: "\n                                            <div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                                <i class=\"bi-check-circle\" style=\"font-size: 5rem; color: green;\"></i>\n                                                                <span class=\"\" style=\"color: #008000;\" disabled>\n                                                                    <span class=\"spinner-border spinner-border-sm\"  aria-hidden=\"true\"></span>\n                                                                    <span role=\"status\" style=\"color: green\"  >Loading...</span>\n                                                                </span>\n                                            </div>\n                                            </div>"
                    });
                  }, 500); // setTimeout(() => {
                  //     location.reload();
                  // }, 2500);
                } else {
                  $.dialog({
                    title: false,
                    content: "<div class=\"grid text-center\" style=\"row-gap: 0; display: flex; flex-direction: column;\">\n                                                        <i class=\"bi-patch-exclamation-fill\" style=\"font-size: 5rem; color: red;\"></i>\n                                                        <h6  style=\"color: red;\"> Error</h6>\n                                                        <span class=\"\" style=\"color: red;\" disabled>\n                                                            por favor intente nuevamente\n                                                        </span>\n                                                    </div>\n                                                    </div>"
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
  });
});
var inputFile = document.getElementById('inpArch');
var inputText = document.getElementById('nameArchive'); // Nombre del archivo en input name automaticamente

inputFile.addEventListener('change', function (e) {
  var img = document.getElementById('docImg');
  var pdf = document.getElementById('docPdf');
  var file = e.target.files[0];
  var dar = file.name.split('.').pop();
  console.log(dar);

  if (file) {
    var read = new FileReader(e);

    read.onload = function (e) {
      if (dar == 'pdf') {
        pdf.src = e.target.result;
        img.style.display = "none";
        pdf.style.display = "unset";
      } else {
        img.src = e.target.result;
      }
    };

    read.readAsDataURL(file);
  } else {
    img.src = defaultFile;
  }

  inputText.value = file.name; // Edición del inputText si se escribe manualmente el nombre y no se encuentra ninguna extensión

  inputText.addEventListener('input', function (event) {
    var extension = inputText.value.split('.').pop();

    if (!extension) {
      inputText.value += "." + dar;
    }
  });
});