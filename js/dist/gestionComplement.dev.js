"use strict";

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
      $.dialog({
        title: "nuevo documento",
        content: respuesta,
        columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
        botton: {
          c: {
            text: "cerrar",
            action: function action() {}
          }
        }
      });
    }
  });
}