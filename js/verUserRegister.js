// DATATABLES VER USUARIOS ********************
var table = $('#table').DataTable({
    ajax: {
        url: " ../php/preset/viewRegister.php",
        dataSrc: 'data'
    },
    order: [
        [4, 'asc']
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
    }
});

//PANTALLA PARA DESACTIVAR/ACTIVAR USERS *************************************
function gestionUser(idUserd) {

    const idUser = idUserd;

    $.confirm({
        title: "",
        content: 'url:../layout/activeUserLayout.php',
        buttons: {
            ac: {
                text: "aceptar",
                action: function () {
                    let radio = document.querySelector('input[name="btnradio"]:checked');
                    if (radio.value != 0) {
                        $.ajax({
                            data: {
                                "pin": radio.value,
                                "userId": idUser
                            },
                            type: "post",
                            url: "../php/activeUser.php",
                            beforeSend: function () {
                                var obj =
                                    $.dialog({
                                        title: false,
                                        closeIcon: false, // ocultar close icon.
                                        content: `
                                        <div class="d-flex my-3 justify-content-center">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">procesando...</span>
                                        </div>
                                        </div>`
                                    });
                                setTimeout(() => {
                                    obj.close();
                                }, 501);
                            },
                            error: function () {
                                setTimeout(() => {
                                    $.dialog({
                                        title: false,
                                        content: `
                                        <div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
                                            <i class="bi-patch-exclamation-fill" style="font-size: 5rem; color: red;"></i>
                                            <h6  style="color: red;"> Error</h6>
                                            <span class="" style="color: red;" disabled>
                                                por favor intente nuevamente
                                            </span>
                                        </div>`
                                    });
                                }, 500);
                            },
                            success: function (cc) {
                                setTimeout(() => {
                                    if (cc == "success.rech") {
                                        $.confirm({
                                            title: '',
                                            content: ` 
                                            <div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
                                                <i class="bi-check-circle" style="font-size: 5rem; color: green;"></i>
                                                <span class="" style="color: #008000;" disabled>
                                                    <span role="status" style="color: red">se desactivo correctamente</span>
                                                </span>
                                            </div>`,
                                            buttons: {
                                                da: {
                                                    text: 'cerrar',
                                                    action: function () {
                                                        var obj =
                                                            $.dialog({
                                                                title: false,
                                                                closeIcon: false, // ocultar close icon.
                                                                content: `
                                                                <div class="d-flex my-3 justify-content-center">
                                                                <div class="spinner-border" role="status">
                                                                    <span class="visually-hidden">actualizando...</span>
                                                                </div>
                                                                </div>`
                                                            });
                                                        setTimeout(() => {
                                                            table.ajax.reload(null, false);
                                                            obj.close();
                                                        }, 800);
                                                    }
                                                }
                                            }
                                        });
                                    } else if (cc == "success") {
                                        $.confirm({
                                            title: '',
                                            content: ` 
                                            <div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
                                                <i class="bi-check-circle" style="font-size: 5rem; color: green;"></i>
                                                <span class="" style="color: #008000;" disabled>
                                                    <span role="status" style="color: green"  >se activo correctamente</span>
                                                </span>
                                            </div>`,
                                            buttons: {
                                                da: {
                                                    text: 'cerrar',
                                                    action: function () {
                                                        var obj =
                                                            $.dialog({
                                                                title: false,
                                                                closeIcon: false, // ocultar close icon.
                                                                content: `
                                                                <div class="d-flex my-3 justify-content-center">
                                                                <div class="spinner-border" role="status">
                                                                    <span class="visually-hidden">actualizando...</span>
                                                                </div>
                                                                </div>`
                                                            });
                                                        setTimeout(() => {
                                                            table.ajax.reload(null, false);
                                                            obj.close();
                                                        }, 800);
                                                    }
                                                }
                                            }
                                        });
                                    } else {
                                        $.dialog({
                                            title: false,
                                            content: `
                                            <div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
                                                <i class="bi-patch-exclamation-fill" style="font-size: 5rem; color: red;"></i>
                                                <h6  style="color: red;"> Error</h6>
                                                <span class="" style="color: red;" disabled>
                                                    por favor intente nuevamente
                                                </span>
                                            </div>`
                                        });
                                    }
                                }, 500);
                            }
                        });
                    }
                }
            },
            cl: {
                text: "cerrar",
                action: function () {

                }
            }
        }
    });
};

// RECARGA DE LA TABLA AUTOMATICA CADA 3M || NUMERO EN MILISEGUNDOS
setInterval(() => {
    table.ajax.reload(null, false);
}, 300000);