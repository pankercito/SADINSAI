// DATATABLE PARA SOLICITUDES
var table = new DataTable('#table', {
    ajax: {
        url: "../php/preset/viewSolicitudesAdmin.php",
        dataSrc: 'data'
    },
    initComplete: function () {
        // agregar filtros (selectores) a tabla 
        this.api().columns([3]).every(function () {
            var column = this;
            var select = $('<select class="filterE"><option value="">Tipo</option></select>')
                .appendTo($(column.header()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function (d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
            });
        });
    },
    // orden de carga inicial
    order: [
        [2, 'desc']
    ],
    columnDefs: [
        {
            target: 6,
            visible: false
        }
    ],
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
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
        (usernameEl.val() == '' || username.toLowerCase().includes(usernameEl.val().toLowerCase()))
    ) {
        return true;
    }

    return false;
});

// accion en selector
$('#estado').on('change', function () {
    table.draw();
});

//APR STATES************************************
function aprStates(idSolis, tipoS) {

    var idSoli = idSolis;
    var tipo = tipoS;

    var parametro = {
        "idSoli": idSoli,
        "receptor": tipo
    };

    var contenido = "no";
    var obj =
        $.dialog({
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
        url: '../php/viewMerge.php',
        type: 'POST',
        error: function (jqXHR, xhr, status, error) {
            var nroERROR = jqXHR.status;
            obj.close();
            setTimeout(() => {
                alert("Estatus " + status + nroERROR + xhr + error)
            }, 500);
        },
        success: function (response) {
            obj.close();
            contenido = response;
            // Mostrar el diálogo de confirmación CAMBIO DE ESTATUS
            $.confirm({
                title: '',
                content: contenido,
                columnClass: 'col-md-8 col-md-offset-4',
                buttons: {
                    aceptar: {
                        text: 'Aceptar',
                        action: function () {
                            let radio = document.querySelector('input[name="editSoli"]:checked');
                            //PANEL  DE  VERIFICACIONN DE RADIOS 
                            if (radio.value != 0) {
                                // MODAL DE CONFIRMACION
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
                                                    "tipo": tipo
                                                };

                                                var obj = $.dialog({
                                                    title: false,
                                                    closeIcon: false, // hides the close icon.
                                                    content: `
                                                    <div class="d-flex justify-content-center">
                                                        <div class="spinner-border my-3" role="status">
                                                            <span class="visually-hidden">cargando...</span>
                                                        </div>
                                                    </div>`
                                                });
                                                $.ajax({
                                                    data: aRadio,
                                                    url: '../php/solicitudMerge.php',
                                                    type: 'POST',
                                                    error: function () {
                                                        obj.close();
                                                        $.dialog({
                                                            title: false, // hides the title.
                                                            content: `
                                                            <div class="d-flex justify-content-center">
                                                                <h6> error al procesar la solicitud </h6>
                                                                    <i class="bi bi-arrow"></i>
                                                                </div>
                                                            </div>`
                                                        });
                                                    },
                                                    success: function (cEc) {
                                                        let c = cEc;
                                                        obj.close();

                                                        //PANTALLAS DE SUCCES DE SOLICITUDES
                                                        if (jeisonXD(c)) {
                                                            var colon = JSON.parse(c);
                                                            var locat = colon[0]['redirec'];
                                                            var conten = colon[0]['estado'];


                                                            if (conten == "succes.personal.ingres" || conten == "succes.personal.edit" || conten == "succes.arch.ingres" || conten == "succes.arch.move") {
                                                                $.confirm({
                                                                    title: 'Se acepto solicitud con exito',
                                                                    content: false,
                                                                    buttons: {
                                                                        d: {
                                                                            text: 'ver perfil',
                                                                            action: function () {
                                                                                location.replace(locat);
                                                                            }
                                                                        },
                                                                        da: {
                                                                            text: 'cerrar',
                                                                            action: function () {
                                                                                table.ajax.reload(null, false);
                                                                            }
                                                                        }
                                                                    }
                                                                });
                                                            }

                                                        } else
                                                            if (c == "succes.personal.rechazar" || c == "success.personal.edit.rechazar" || c == "success.archivo.eliminar.rechazar" || c == "success.archivo.ingreso") {
                                                                $.confirm({
                                                                    title: 'se rechazo solicitud con exito',
                                                                    content: false,
                                                                    buttons: {
                                                                        da: {
                                                                            text: 'cerrar',
                                                                            action: function () {
                                                                                table.ajax.reload(null, false);
                                                                            }
                                                                        }
                                                                    }
                                                                });
                                                            } else {
                                                                $.confirm({
                                                                    title: 'error',
                                                                    content: c,
                                                                    buttons: {
                                                                        da: {
                                                                            text: 'cerrar',
                                                                            action: function () {
                                                                                table.ajax.reload(null, false);
                                                                            }
                                                                        }
                                                                    }
                                                                });
                                                            }
                                                    },
                                                });
                                            }
                                        },
                                        cerrar: {
                                            text: 'No, Cerrar',
                                            action: function () { }
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
            })
        }
    });
};

// RECARGA DE LA TABLA AUTOMATICA CADA 1M || NUMERO EN MILISEGUNDOS
setInterval(() => {
    table.ajax.reload(null, false);
}, 30000);