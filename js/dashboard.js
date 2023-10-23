const dashboard = document.querySelector('#dashboard');
const soli = document.querySelector('#solicitudes');
const promedio = document.querySelector('#solicitudesProm');

// GRAFICO PRINCIPAL DE LINEAS
$.ajax({
    url: "../php/dashboardDataPre.php",
    success: function (response) {
        if (jeisonXD(response)) {
            var colon = JSON.parse(response);
            // crear grafico con variables de base de dato
            const us = colon[0].join().split(",");
            const dos = colon[1].join().split(",");
            const tri = colon[2].join().split(",");

            const f = colon[3]["lunes"] + " - " + colon[3]["domingo"];

            document.getElementById('prom').innerHTML = 'promedio semanal de solicitudes: ' + colon[5] + '% ';
            document.getElementById('prem').innerHTML = 'promedio semanal ingresos archivos agregados: ' + colon[6] + '% ';
            document.getElementById('prim').innerHTML = 'promedio semanal inicios de sesion diarios: ' + colon[4] + '% ';

            nuevoGrafico(dashboard, us, dos, tri, f);

        } else {
            document.querySelector('#canvasconten').innerHTML = "<h6 style='color: #fafafa;'>no hay datos para mostrar</h6>";
        }
    }
});

// GRAFICO DE SOLICITUDES DE PIE
$.ajax({
    url: "../php/dashboardSolicitudesPre.php",
    success: function (response) {
        if (response != null) {
            var colon = JSON.parse(response);
            // ordenar datos de array 
            console.log(colon);
            const us = colon[0]["count"];
            const dos = colon[1]["count"];
            const tri = colon[2]["count"];
            const four = colon[3]["count"];

            const data = {
                labels: [
                    "ingreso de personal",
                    "edicion de datos",
                    "ingreso de archivo",
                    "eliminacion de archivo"
                ],
                datasets: [{
                    data: [us, dos, tri, four],
                    backgroundColor: [
                        '#f9c940',
                        '#ff6384',
                        '#3fe8f4',
                        '#efefef'
                    ],
                    hoverOffset: 4,
                }]
            }
            const config = {
                type: 'pie',
                data: data,
                responsive: true,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            align: 'start',
                            fullSize: true,
                            maxWidth: 10,
                            title: {
                                display: false
                            }
                        },
                        title: {
                            display: true,
                            text: 'Gestion de datos realizadas',
                            color: '#484848',
                            font: {
                                size: 16,
                                weight: 600,
                            }
                        },
                    },
                },
            }
            //generar grafica
            new Chart(soli, config);;
        } else {
        }
    }
});

// GRAFICO HORIZONTAL DE SOLICITUDES PROMEDIO
$.ajax({
    url: "../php/preset/promedioSolis.php",
    success: function (response) {
        if (response != null) {
            var colon = JSON.parse(response);
            // ordenar datos de array 
            console.log(colon);
            const us = colon[0];
            const dos = colon[1];
            const tri = colon[2];

            const labels = [''];

            document.getElementById('total').innerHTML = 'total de solicitudes atendidas: ' + colon[3];
            document.getElementById('aceptadas').innerHTML = colon[0] + '% ';
            document.getElementById('rechazadas').innerHTML = colon[1] + '% ';
            document.getElementById('anuladas').innerHTML = colon[2] + '% ';

            const data = {
                labels: labels,
                datasets: [
                    {
                        label: "aceptadas %",
                        data: [us],
                        backgroundColor: ['#63ff6f']
                    },
                    {
                        label: "rechazadas %",
                        data: [dos],
                        backgroundColor: ['#ff6384']
                    },
                    {
                        label: "anuladas %",
                        data: [tri],
                        backgroundColor: ['#63b7ff']
                    }
                ]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            suggestedMin: 0,
                            suggestedMax: 100,
                        }
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'left',
                        },
                        title: {
                            display: true,
                            text: 'Promedio de aceptacion de solicitudes',
                            color: '#484848',
                            font: {
                                size: 16,
                                weight: 600,
                            }
                        },
                    },
                },
            };

            new Chart(promedio, config);

        } else {
        }
    }
});
