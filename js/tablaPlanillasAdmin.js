var puth = $("#table").DataTable({
    ajax: {
        url: "../php/preset/viewPlanillasSolicis.php",
    },
    columnDefs: [
        {
            target: 6,
            visible: false
        }
    ],
    order: [
        [3, 'desc']
    ],
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar  _MENU_  Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:  ",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
});

var usernameEl = $('#estado');

//FILTRO TABLA
DataTable.ext.search.push(function (settings, data, dataIndex) {
    var username = data[6]; // use data for the username column

    if (
        (usernameEl.val() == '0' || username.toLowerCase().includes(usernameEl.val().toLowerCase()))
    ) {
        return true;
    }

    return false;
});

// accion en selector
$('#estado').on('change', function () {
    puth.draw();
});

//APR PLANILLAS ************************************
function aprPlanillas(idSolis, tipoS) {

    var idSoli = idSolis;
    var tipo = tipoS;

    var parametro = {
        "idSoli": idSoli,
        "tipoSoli": tipo
    };

    var contenido = "no";

    var obj = $.dialog({
        title: false,
        closeIcon: false, // hides the close icon.
        content: `
        <div class="d-flex justify-content-center">
            <div class="spinner-border my-3" role="status">
                <span class="visually-hidden">procesando...</span>
            </div>
        </div>`
    });

    $.ajax({
        data: parametro,
        url: '../php/viewPlanillasMerge.php',
        type: 'POST',
        error: function (jqXHR, xhr, status, error) {
            obj.close();
            var nroERROR = jqXHR.status;

            alert("Estatus " + status + ': ' + nroERROR);
        },
        success: function (response) {
            obj.close();

            contenido = response;

            // Mostrar el diálogo de confirmación CAMBIO DE ESTATUS
            $.confirm({
                title: false,
                onContentReady: function () {

                    this.$content.find('input[name="editSoli"]').click(function () {
                        if ($(this).val() == "2") {
                            $("#collapseRechazar").collapse('show');
                        } else {
                            $("#collapseRechazar").collapse('hide');
                        }
                    });
                },
                content: contenido,
                columnClass: 'col-md-8 col-md-offset-4',
                buttons: {
                    aceptar: {
                        text: 'Aceptar',
                        action: function () {
                            let radio = document.querySelector('input[name="editSoli"]:checked');
                            let motivo = document.getElementById("movito").value;

                            if (radio.value != 0) {
                                $.confirm({
                                    title: '',
                                    content: '¿Esta seguro de realizar esta operacion?',
                                    buttons: {
                                        aceptar: {
                                            text: 'Sí, Aceptar',
                                            action: function () {
                                                let aRadio = {
                                                    "radio": radio.value,
                                                    "idSoli": idSoli,
                                                    "motivo": motivo
                                                };
                                                obj.open();
                                                $.ajax({
                                                    data: aRadio,
                                                    url: "../php/planillasAction.php",
                                                    type: "post",
                                                    success: function (params) {
                                                        obj.close();

                                                        $.confirm({
                                                            title: '',
                                                            content: params,
                                                            buttons: {
                                                                da: {
                                                                    text: 'cerrar',
                                                                    action: function () {
                                                                        puth.ajax.reload(null, false);
                                                                    }
                                                                }
                                                            }
                                                        })
                                                    }

                                                });
                                            }
                                        },
                                        r: {
                                            text: "No, Cancelar",
                                            action: function () {
                                                //funcion a realizar
                                            }
                                        }
                                    }
                                });
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
};

// RECARGA DE LA TABLA AUTOMATICA CADA 1M || NUMERO EN MILISEGUNDOS
setInterval(() => {
    puth.ajax.reload(null, false);
}, 6000);