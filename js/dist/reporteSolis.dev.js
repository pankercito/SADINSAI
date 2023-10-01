"use strict";

$(document).ready(function () {
  var boton = $('#genReport');
  boton.click(function () {
    $.confirm({
      title: 'Reporte Estadistico',
      content: 'url: ../layout/reporteEstatsForm.php',
      columnClass: 'col-md-7 col-md-offset-4',
      onContentReady: function onContentReady() {
        var selector = $('#selectipo');
        var contentipo = $('#contenOpcion');
        var fecha = $('#fecha');
        var self = this;
        self.buttons.ab.disable();
        selector.on('change', function () {
          $("#selectipo option:selected").each(function () {
            var valor = $(this).val();

            if (valor != 0) {
              $.ajax({
                data: {
                  "select": valor
                },
                url: "../php/preset/selectChecks.php",
                type: "post",
                success: function success(params) {
                  contentipo.html(params);
                }
              });
            } else {
              contentipo.html("");
            }

            if (fecha != null) {
              self.buttons.ab.enable();
            } else {
              self.buttons.ab.disable();
            }
          });
        });
      },
      buttons: {
        ab: {
          text: 'generar',
          action: function action() {
            var data = document.getElementById("report");
            var form = new FormData(data);
            $.ajax({
              data: form,
              url: '../php/reporteSolis.php',
              processData: false,
              contentType: false,
              type: 'post',
              success: function success(cow) {
                window.open('../pdf/epdf.php', "_blank");
              }
            });
          }
        },
        cb: {
          text: 'cerrar',
          action: function action() {}
        }
      }
    });
  });
});