const dashboard = document.querySelector('#dashboard');
const soli = document.querySelector('#solicitudes');
const promedioS = document.querySelector('#solicitudesProm');
const promedioG = document.querySelector('#gestionesProm');

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

            document.getElementById('prom').innerHTML = 'gestiones realizadas: ' + colon[5] + '% ';
            document.getElementById('prem').innerHTML = 'agregados: ' + colon[6] + '% ';
            document.getElementById('prim').innerHTML = 'inicios de sesion: ' + colon[4] + '% ';

            nuevoGrafico(dashboard, us, dos, tri, f);

        } else {
            document.querySelector('#canvasconten').innerHTML = "<h6 style='color: #fafafa;'>no hay datos para mostrar</h6>";
        }
    }
});

// GRAFICO DE GESTIONES DE PIE
$.ajax({
    url: "../php/dashboardGestionesPre.php",
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
                    label: 'gestiones realizadas',
                    data: [us, dos, tri, four],
                    backgroundColor: [
                        '#f9c940',
                        '#d7d7d7',
                        '#3fe8f4',
                        '#ff6384',
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
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';

                                    label = ' ' + label + ': ' + context.parsed;
                                    return label;
                                }
                            }
                        }
                    },
                },
            }
            //generar grafica
            new Chart(soli, config);;
        } else {
        }
    }
});

// GRAFICO HORIZONTAL DE SOLICITUDES PROMEDIO ACEPTACION
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
                        label: "aceptadas",
                        data: [us],
                        backgroundColor: ['#a0ffa9']
                    },
                    {
                        label: "rechazadas",
                        data: [dos],
                        backgroundColor: ['#ffa0a0']
                    },
                    {
                        label: "anuladas",
                        data: [tri],
                        backgroundColor: ['#d7d7d7']
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
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';

                                    label = ' ' + label + ': ' + context.parsed.x + ' %';
                                    return label;
                                }
                            }
                        }
                    },

                },
            };

            new Chart(promedioS, config);

        }
    }
});

// GRAFICO HORIZONTAL DE GESTIONES PROMEDIO ACEPTACION
$.ajax({
    url: "../php/preset/promedioGestion.php",
    success: function (response) {
        if (response != null) {

            var colon = JSON.parse(response);

            // ordenar datos de array 
            console.log(colon);
            const us = colon[0];
            const dos = colon[1];
            const tri = colon[2];

            const labels = [''];

            document.getElementById('totalG').innerHTML = 'total de gestiones atendidas: ' + colon[3];
            document.getElementById('aceptadasG').innerHTML = colon[0] + '% ';
            document.getElementById('rechazadasG').innerHTML = colon[1] + '% ';
            document.getElementById('anuladasG').innerHTML = colon[2] + '% ';

            const data = {
                labels: labels,
                datasets: [
                    {
                        label: "aceptadas",
                        data: [us],
                        backgroundColor: ['#a0d2ff']
                    },
                    {
                        label: "rechazadas",
                        data: [dos],
                        backgroundColor: ['#f9ae80']
                    },
                    {
                        label: "anuladas",
                        data: [tri],
                        backgroundColor: ['#d7d7d7']
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
                        },
                    },
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'right',
                        },
                        title: {
                            display: true,
                            text: 'Promedio de aceptacion de gestiones',
                            color: '#484848',
                            font: {
                                size: 16,
                                weight: 600,
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    let label = context.dataset.label || '';

                                    label = ' ' + label + ': ' + context.parsed.x + ' %';
                                    return label;
                                }
                            }
                        }
                    },

                },
            };

            new Chart(promedioG, config);

        }
    }
});

