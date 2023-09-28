"use strict";

function nuevoGrafico(canvas, array1, array2, array3, arrayFechas) {
  //datos del GRAFICO
  var labels = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'];
  var data = {
    labels: labels,
    datasets: [{
      label: 'usuarios iniciados',
      data: array1,
      borderColor: "#ff63849e",
      backgroundColor: "#ff6384",
      tension: 0.4
    }, {
      label: 'solicitudes realizadas',
      data: array2,
      borderColor: "#4be9faad",
      backgroundColor: "#3fe8fa",
      tension: 0.3
    }, {
      label: 'archivos subidos',
      data: array3,
      borderColor: "#f9c940c7",
      backgroundColor: "#f9c940",
      tension: 0.5
    }]
  };
  var config = {
    type: 'line',
    data: data,
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top'
        },
        title: {
          display: true,
          text: 'Registro de volumen de datos' + arrayFechas,
          color: '#484848',
          font: {
            size: 16,
            weight: 600
          }
        }
      }
    }
  };
  new Chart(canvas, config);
}

;