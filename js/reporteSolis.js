$(document).ready(function () {
    var boton = $('#genReport');

    boton.click(function () {
        $.confirm({
            title: 'Reporte Estadistico',
            content: 'url: ../layout/reporteEstatsForm.php',
            columnClass: 'col-md-7 col-md-offset-4',
            onContentReady: function () {

                let selector = $('#selectipo');
                let contentipo = $('#contenOpcion');

                selector.on('change', function () {
                    $("#selectipo option:selected").each(function () {
                        var valor = $(this).val();

                        if (valor != 0) {
                            $.ajax({
                                data: {
                                    "select": valor
                                },
                                url: "../php/preset/selectChecks.php",
                                type: "post",
                                success: function (params) {
                                    contentipo.html(params);
                                }

                            });
                        } else {
                            contentipo.html("");
                        }
                    });

                });
            },
            buttons: {
                ab: {
                    text: 'generar',
                    action: function () {
                        var data = document.getElementById("report");
                        const form = new FormData(data);

                        $.ajax({
                            data: form,
                            url: '../php/reporteSolis.php',
                            processData: false,
                            contentType: false,
                            type: 'post',
                            success: function (cow) {
                                window.open('../pdf/epdf.php', "_blank")
                            }
                        });
                    }
                },
                cb: {
                    text: 'cerrar',
                    action: function () {

                    }
                }
            }
        });

    });
});