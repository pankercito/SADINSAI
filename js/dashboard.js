const dashboard = document.querySelector('#dashboard');

$.ajax({
    url: "../php/dashboardDataPre.php",
    success: function (response) {
        if (response != null) {
            var colon = JSON.parse(response);
            // crear grafico con variables de base de dato
            const  us = colon[0].join().split(",");
            const  dos = colon[1].join().split(",");
            const  tri = colon[2].join().split(",");

            const f = colon[3]["lunes"] +" - "+ colon[3]["domingo"];

            nuevoGrafico(dashboard, us, dos, tri, f);
        } else {

        }
    }
})