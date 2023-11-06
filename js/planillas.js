function planillaSelect(planilla) {
    $.ajax({
        data: { "planilla": planilla },
        url: "../layout/planillas/planillaSelect.php",
        type: "post",
        success: function (params) {
            document.getElementById("planillas").innerHTML = params;
            $(document).ready(function () {
                
                // $('button[type=submit]').click(function (e) {
                //     // Verificamos si el horario laboral es válido
                //     if (HorarioLaboral) {
                        
                //     } else {
                //         e.preventDefault();
                //         $.dialog({
                //             title: '',
                //             animation: 'RotateX',
                //             type: 'red',
                //             icon: 'bi bi-warning',
                //             typeAnimated: true,
                //             content: '<h2 class="text-center mx-auto">No disponible</h2><br><h5 class="text-center mx-auto pb-3 px-4">Las solicitudes solo estan disponibles en horario laboral</h5>',
                //         })
                //     }
                // });
            });
        }
    })
}