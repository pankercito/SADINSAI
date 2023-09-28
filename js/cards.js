// MUESTREO DE CARD
$(document).ready(function () {
    var zindex = 10;

    $("a.toggle-info.btn").click(function (e) {

        var isShowing = false;
        var card = $(this).closest("div.card");

        if (card.hasClass("show")) {
            isShowing = true;
            e.preventDefault();
        }

        if ($("div.cards").hasClass("showing")) {
            // a card is already in view
            $("div.card.show")
                .removeClass("show");

            if (isShowing == true) {
                // this card was showing - reset the grid
                $("div.cards")
                    .removeClass("showing");
                card
                    .css({
                        zIndex: 0
                    });
            } else {
                // this card isn't showing - get in with it
                $("div.card")
                    .css({
                        zIndex: 0
                    });
                card
                    .css({
                        zIndex: zindex
                    })
                    .addClass("show");

            }

            zindex++;

        } else {
            // no cards in view
            $("div.cards")
                .addClass("showing");
            card
                .css({
                    zIndex: zindex
                })
                .addClass("show");

            zindex++;
        }

    });
});

// FUNCION DE CAMBIO DE UBICACION
function cambiarUb(id) {
    var idSoli = id;

    var parametro = {
        "idArch": idSoli,
    };

    $.ajax({
        data: parametro,
        url: '../layout/ubicacionChange.php',
        type: 'POST',
        error: function (jqXHR, xhr, status, error) {
            var nroERROR = jqXHR + status;
            alert("Estatus " + nroERROR) + error
        },
        success: function (response) {
            contenido = response;

            // Mostrar el diálogo de confirmación
            $.confirm({
                title: '',
                content: contenido,
                columnClass: 'col-md-4 col-md-offset-4',
                boxWidth: '50%',
                onContentReady: function () {
                    // desactivar boton enviar
                    this.buttons.cambio.disable();

                    var self = this;

                    this.$content.find('#resp').change(function () {
                        if (self.$content.find("#resp").val() != "" && self.$content.find("#nDirecion").val() != "") {

                            self.buttons.cambio.enable();

                        } else if (self.$content.find("#nDirecion").val() == 2) {

                            self.buttons.cambio.enable();

                        } else {
                            self.buttons.cambio.disable();
                        }
                    });

                    this.$content.find("#nDirecion").change(function () {
                        if (self.$content.find("#resp").val() != "" && self.$content.find("#nDirecion").val() != "") {

                            self.buttons.cambio.enable();

                        } else if (self.$content.find("#nDirecion").val() == 2) {

                            self.buttons.cambio.enable();

                        } else {
                            self.buttons.cambio.disable();
                        }
                    });
                },
                buttons: {
                    cambio: {
                        text: 'cambiar',
                        btnClass: 'btn-success',
                        action: function () {

                            const germain = document.getElementById('germain');

                            // Creamos un objeto con los datos del formulario
                            var form = new FormData(germain);

                            form.append("idArch", idSoli);

                            console.log(form);

                            $.ajax({
                                data: form,
                                processData: false,
                                contentType: false,
                                url: "../php/cambioUbicacion.php",
                                type: "post",
                                success: function (params) {

                                    $.confirm({
                                        title: '',
                                        content: params,
                                        buttons: {
                                            cerrar: {
                                                text: "cerrar",
                                                action: function () {
                                                    location.reload();
                                                },
                                            }
                                        },
                                    });
                                }
                            });
                        }
                    },
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

}

// Eliminar ARCHIVO
function deleteCar(id) {
    var idSoli = id;

    rows = {
        "archivo": idSoli,
        "tipo": 3
    }

    $.confirm({
        title: "",
        content: "<h5>¿desea solicitar la eliminacion de este archivo?</h5>",
        buttons: {
            a: {
                text: "solicitar eliminacion",
                btnClass: "btn-danger",
                action: function () {
                    $.ajax({
                        data: rows,
                        url: "../php/registroSolicitud.php",
                        type: "POST",
                        success: function (params) {
                            
                            if (jeisonXD(params)) {//verificar si lo devuelto es jeison

                                var colon = JSON.parse(params);

                                var locat = colon[0]['redirec'];

                                var conten = colon[0]['estado'];
                                $.confirm({
                                    title: "",
                                    content: conten,
                                    buttons: {
                                        cerrar: {
                                            text: "cerrar",
                                            action: function () {

                                            }
                                        },
                                        co: {
                                            text: "ir a solicitudes",
                                            action: function () {
                                                location.replace(locat);
                                            }
                                        }
                                    }
                                });
                            } else {
                                $.confirm({
                                    title: "error",
                                    content: params,
                                    buttons: {
                                        cerrar: {

                                        }
                                    }
                                });
                            }

                        },
                    });
                }
            },
            d: {
                text: "cerrar",
                btnClass: "btn-green",
                action: function () {

                }
            }
        }
    })
}