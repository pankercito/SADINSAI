const dashboard = document.querySelector('#dashboard');

$.ajax({
    url: "../php/dashboardDataPre.php",
    success: function (response) {
        if (response != null) {
            var colon = JSON.parse(response);
            // crear grafico con variables de base de datos 
            nuevoGrafico(colon[0], colon[1], colon[0]);
            
            console.log(colon[0]);
            console.log(colon[1]);
        } else {

        }
    }
})

function nuevoGrafico(array1, array2, array3) {
    const labels = ['lun', 'mar', 'mie', 'jue', 'vie', 'sab', 'dom'];

    //datos del GRAFICO
    var data = {
        labels: labels,
        datasets: [{
            label: 'Usuarios Activos',
            data: array1,
            fill: false,
            borderColor: "red",
            backgroundColor: "#ff6384",
        }, {
            label: 'Solicitudes realizadas',
            data: array2,
            fill: false,
            borderColor: "blue",
            backgroundColor: "#3fe8fa",
        }, {
            label: 'Subida de datos',
            data: array3,
            fill: false,
            borderColor: "green",
            backgroundColor: "#f9c940",
        }, ]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            plugins: {
                legend: {
                    title: {
                        display: true,
                        text: 'Registro de volumen de usuarios',
                        color: '#484848',
                        font: {
                            size: 16,
                            weight: 600,
                        }
                    },
                }
            }
        }
    };

    new Chart(dashboard, config);
}