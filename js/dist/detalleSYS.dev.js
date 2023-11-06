"use strict";

function detalleMovi(id) {
  $.ajax({
    data: {
      'id': id
    },
    url: '../layout/detalleSys.php',
    type: 'post',
    success: function success(data) {
      $.confirm({
        title: "",
        content: data,
        buttons: {
          ac: {
            text: "cerrar",
            action: function action() {}
          }
        }
      });
    }
  });
}