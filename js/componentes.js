//cargo table
var table = $("#table").DataTable({
    order: [
        [0, 'asc']
    ],
    ajax: {
        url: "../php/preset/cargos _add.php",
    },
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

$(document).ready(function () {
    //If user submits the form
    $("#agregar").click(function (e) {
        e.preventDefault();
        var input = $("#cargo").val();
        var boton = $("#agregar");



        if (input.length > 4) {
            boton.attr("disabled", true);
            boton.html('<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Procesando...</span>');

            $.confirm({
                title: '',
                content: "<h5 class='text-center'>¿Esta seguro de agregar este cargo? <h5><br><h6 class='text-center'>no podra eliminarlo mas tarde</h6>",
                buttons: {
                    bue: {
                        text: "si, estoy seguro",
                        btnClass: "btn-success",
                        action: function () {
                            $.ajax({
                                url: "../php/upload/componentCargo.php",
                                type: "post",
                                data: { cargo: input },
                                success: function (cc) {
                                    notie.setOptions({
                                        alertTime: 2
                                    });
                                    if (cc == "success") {
                                        setTimeout(() => {
                                            boton.html("agregar");
                                            boton.attr("disabled", false);
                                            $("#cargo").val(""); // limpiar input

                                            notie.alert({
                                                type: 1,
                                                text: 'Se agrego el cargo correctamente',
                                                time: 3
                                            });

                                            table.ajax.reload(null, false);

                                        }, 400);
                                    } else if (cc == "dupli") {
                                        setTimeout(() => {
                                            boton.html("agregar");
                                            boton.attr("disabled", false);

                                            notie.alert({
                                                type: 3,
                                                text: 'Cargo duplicado',
                                                time: 3
                                            });
                                        }, 400);
                                    } else {
                                        setTimeout(() => {
                                            boton.html("agregar");
                                            boton.attr("disabled", false);

                                            notie.alert({
                                                type: 3,
                                                text: cc,
                                                time: 3
                                            });
                                        }, 400);
                                    }

                                }
                            });
                        }
                    },
                    car: {
                        text: "no, cancelar",
                        btnClass: "btn-danger",
                        action: function () {
                            boton.html("agregar");
                            boton.attr("disabled", false);
                        }
                    }
                }
            });
        }
    });
});

