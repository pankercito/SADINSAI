"use strict";

var dashboard = document.querySelector('#dashboard');
var soli = document.querySelector('#solicitudes');
$.ajax({
  url: "../php/dashboardDataPre.php",
  success: function success(response) {
    if (jeisonXD(response)) {
      var colon = JSON.parse(response); // crear grafico con variables de base de dato

      var us = colon[0].join().split(",");
      var dos = colon[1].join().split(",");
      var tri = colon[2].join().split(",");
      var f = colon[3]["lunes"] + " - " + colon[3]["domingo"];
      nuevoGrafico(dashboard, us, dos, tri, f);
    } else {
      document.querySelector('#canvasconten').innerHTML = "<h6 style='color: #fafafa;'>no hay datos para mostrar</h6>";
    }
  }
});
$.ajax({
  url: "../php/dashboardSolicitudesPre.php",
  success: function success(response) {
    if (response != null) {
      var colon = JSON.parse(response); // crear grafico con variables de base de dato

      console.log(colon);
      var us = colon[0]["count"];
      var dos = colon[1]["count"];
      var tri = colon[2]["count"];
      var four = colon[3]["count"];
      var data = {
        labels: ["ingreso de personal", "edicion de datos", "ingreso de archivo", "eliminacion de archivo"],
        datasets: [{
          labels: 'reliminada',
          data: [us, dos, tri, four],
          backgroundColor: ['#f9c940', '#ff6384', '#3fe8f4', '#efefef']
        }]
      };
      var config = {
        type: 'doughnut',
        data: data
      };
      new Chart(soli, config);
      ;
    } else {}
  }
});