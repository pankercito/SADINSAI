$(document).ready(function () {
    // Agregar un controlador de eventos para el evento click del botón
    $('a.viewDetails.btn.btn').click(function (event) {
        event.preventDefault(); // Prevenir la acción por defecto del enlace

        // Obtener los datos de la fila de la tabla
        const fila = $(this).closest('tr'); // Obtener la fila más cercana al botón
        const idSoli = fila.data('solicitud');

        var parametro = {
            "idSoli": idSoli
        };
        var contenido = "no";

        $.ajax({
            data: parametro,
            url: '../php/preset/viewDetails.php',
            type: 'POST',

            beforeSend: function () {

            },
            error: function (jqXHR, xhr, status, error) {
                var nroERROR = jqXHR.status;
                alert("Estatus " + status)
            },
            success: function (response) {
                contenido = response;

                // Mostrar el diálogo de confirmación
                $.confirm({
                    title: 'Detalles',
                    content: contenido,
                    columnClass: 'col-md-5 col-md-offset-2',
                    boxWidth: '50%',
                    buttons: {
                        cerrar: {
                            text: 'cerrar',
                            action: function () {
                                //funcion a realizar
                            }
                        }
                    }
                });
            }
        });
    });
});