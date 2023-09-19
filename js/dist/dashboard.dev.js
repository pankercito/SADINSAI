"use strict";

var dashboard = document.querySelector('#dashboard');
$.ajax({
  url: "../php/dashboardDataPre.php",
  success: function success(response) {
    if (response != null) {
      var colon = JSON.parse(response); // crear grafico con variables de base de dato

      var us = colon[0].join().split(",");
      var dos = colon[1].join().split(",");
      var tri = colon[2].join().split(",");
      var f = colon[3]["lunes"] + " - " + colon[3]["domingo"];
      nuevoGrafico(dashboard, us, dos, tri, f);
    } else {}
  }
});