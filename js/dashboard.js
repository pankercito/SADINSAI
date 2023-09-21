const dashboard = document.querySelector('#dashboard');
const soli = document.querySelector('#solicitudes');

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

            nuevoGrafico(dashboard, us, dos, tri, f);

        } else {
            document.querySelector('#canvasconten').innerHTML = "<h6 style='color: #fafafa;'>no hay datos para mostrar</h6>";
        }
    }
})

$.ajax({
    url: "../php/dashboardSolicitudesPre.php",
    success: function (response) {
        if (response != null) {
            var colon = JSON.parse(response);
            // crear grafico con variables de base de dato
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
                datasets:[{
                    labels: 'reliminada',
                    data: [us, dos, tri, four],
                    backgroundColor: [
                        '#f9c940',
                        '#ff6384',
                        '#3fe8f4',
                        '#efefef'
                    ]
                }]
            }

            const config = {
                type: 'doughnut',
                data: data
            }
            
            new Chart(soli, config);;

        } else {

        }
    }
})

