//DETALLES *************************************
$(document).ready(function () {
    // Agregar un controlador de eventos para el evento click del botón
    $('a.viewDetails.btn.btn').click(function (event) {
        event.preventDefault(); // Prevenir la acción por defecto del enlace

        // Obtener los datos de la fila de la tabla
        const fila = $(this).closest('tr'); // Obtener la fila más cercana al botón
        const idSoli = fila.data('solicitud');
        const ciReceptor = fila.data('receptor');

        var parametro = {
            "idSoli": idSoli,
            "receptor": ciReceptor
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

//APR STATES************************************
$(document).ready(function () {
    // Agregar un controlador de eventos para el evento click del botón
    $('a.aprState:not([disabled])').click(function (event) {
        event.preventDefault(); // Prevenir la acción por defecto del enlace

        // Obtener los datos de la fila de la tabla
        const fila = $(this).closest('tr'); // Obtener la fila más cercana al botón
        const idSoli = fila.data('solicitud');
        const ciReceptor = fila.data('receptor');

        var parametro = {
            "idSoli": idSoli,
            "receptor": ciReceptor
        };
        var contenido = "no";

        $.ajax({
            data: parametro,
            url: '../php/viewMerge.php',
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
                    title: 'Cambiar estatus',
                    content: contenido,
                    columnClass: 'col-md-5 col-md-offset-2',
                    boxWidth: '50%',
                    buttons: {
                        aceptar: {
                            text: 'Aceptar',
                            action: function () {
                                let radio = document.querySelector('input[name="editSoli"]:checked');
                                //PANEL  DE  VERIFICACIONN
                                if (radio.value != 0) {
                                    $.confirm({
                                        title: '',
                                        content: '¿Esta seguro de realizar esta operacion?',
                                        buttons: {
                                            aceptar: {
                                                text: 'Sí Aceptar',
                                                action: function () {
                                                    let aRadio = {
                                                        "radio": radio.value,
                                                        "idSoli": idSoli,
                                                    };
                                                    $.ajax({
                                                        data: aRadio,
                                                        url: '../php/personalMerge.php',
                                                        type: 'POST',
                                                        beforeSend: function () {

                                                        },
                                                        error: function () {
                                                            $.confirm({
                                                                title: '',
                                                                content: `
                                                                <div class="d-flex justify-content-center">
                                                                <div class="spinner-border" role="status">
                                                                    <span class="visually-hidden">Loading...</span>
                                                                </div>
                                                                </div>`,
                                                                buttons: {
                                                                    aceptar: {
                                                                        text: 'aceptar',
                                                                    }
                                                                }
                                                            });
                                                        },
                                                        success: function (cEc) {
                                                            let cec = cEc;
                                                            $.confirm({
                                                                title: '',
                                                                content: cec,
                                                                buttons: {
                                                                    d: {
                                                                        text: 'cerrar',
                                                                        action: function(){
                                                                            location.reload();
                                                                        }
                                                                    }
                                                                }
                                                            });
                                                        },
                                                        complete: function () {
                                                            // Ocultar el indicador de carga o spinner
                                                        }
                                                    });
                                                }
                                            },
                                            cerrar: {
                                                text: 'No Cerrar',
                                                action: function () {}
                                            }
                                        }
                                    });
                                } else {
                                    //no  hace nada
                                }
                            }
                        },
                        cerrar: {
                            text: 'Cerrar',
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