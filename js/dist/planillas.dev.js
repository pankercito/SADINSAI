"use strict";

function planillaSelect(planilla) {
  $.ajax({
    data: {
      "planilla": planilla
    },
    url: "../layout/planillas/planillaSelect.php",
    type: "post",
    success: function success(params) {
      document.getElementById("planillas").innerHTML = params;
    }
  });
}