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

    var obj =
        $.dialog({
            title: false,
            closeIcon: false, // hides the close icon.
            content: `
                        <div class="d-flex justify-content-center">
                                            <div class="spinner-border" role="status">
                            <span class="visually-hidden">Redirigiendo...</span>
                        </div>
                        </div>`
        });

    $.ajax({
        data: parametro,
        url: '../layout/ubicacionChange.php',
        type: 'POST',
        error: function (jqXHR, xhr, status, error) {
            obj.close();

            var nroERROR = jqXHR + status;
            alert("Estatus " + nroERROR) + error
        },
        success: function (response) {
            obj.close();

            contenido = response;

            // Mostrar el diálogo de confirmación
            $.confirm({
                title: '',
                content: contenido,
                columnClass: 'col-md-4 col-md-offset-4',
                boxWidth: '50%',
                onOpenBefore: function () {
                    // desactivar boton enviar
                    this.buttons.cambio.disable();
                },
                onContentReady: function () {
                    var self = this;
                    let inputPerson = document.getElementById('resp');
                    let resultDnone = document.getElementById('lista');
                    let inputDnone = document.getElementById('send');
                    let buutt = document.getElementById('veff');

                    //BUSQUEDA DE PESONAL   
                    inputPerson.addEventListener('keyup', function () {
                        PersonalAsigB(inputPerson, resultDnone, inputDnone);
                    });

                    this.$content.find('#resp').change(function () {
                        if (self.$content.find("#send").val() != "" && self.$content.find('#resp').val() == localStorage.getItem('valorInput2') && self.$content.find("#nDirecion").val() != "") {
                            buutt.addClass('d-none');
                        } else {
                            self.buttons.cambio.disable();
                        }
                    });

                    this.$content.find('#veriff').click(function () {
                        if (self.$content.find("#send").val() != "" && self.$content.find('#resp').val() == localStorage.getItem('valorInput2') && self.$content.find("#nDirecion").val() != "") {
                            self.buttons.cambio.enable();
                        } else {
                            self.buttons.cambio.disable();
                        }
                    });

                    this.$content.find("#nDirecion").change(function () {
                        if (self.$content.find("#send").val() != "" && self.$content.find('#resp').val() == localStorage.getItem('valorInput2') && self.$content.find("#nDirecion").val() != "") {
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

                                if (conten == "suuccess.delete") {
                                    $.confirm({
                                        title: "",
                                        content: 'solicitud agregada exitosamente',
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
                                }
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

//filtro de busqueda de estados
function PersonalAsigB(inpat, resultDiv, inputValAsig) {

    let input = inpat; //id del input de busqueda;
    let inputDnone = inputValAsig; //id del input de oculto;
    let divResult = resultDiv; //donde mostrar rsultados de la busqueda;

    let keys = { "keys": input.value };

    if (input.value.length > 0) {
        $.ajax({
            data: keys,
            url: "../php/searchPerson.php",
            type: "post",
            success: function (params) {
                divResult.classList.remove("d-none");

                if (jeisonXD(params)) {

                    let newlist = JSON.parse(params);

                    divResult.innerHTML = "";

                    newlist.forEach(element => {
                        let elemetos = `<a onclick="items('${element['nombre']} ${element['apellido']}', '${element['ci']}')" class="nav-link mt-2 p-2">${element['nombre']} ${element['apellido']}</a>`;
                        divResult.innerHTML += elemetos;
                    });

                } else {
                    divResult.innerHTML = "sin resultados";
                }
            }
        });
    } else {
        divResult.classList.add("d-none");
        divResult.innerHTML = "";
    }

    input.addEventListener("blur", function () {
        setTimeout(() => {
            divResult.classList.add("d-none");
        }, 500);
    });
}


function items(val, valu) {
    const inpat = document.getElementById('resp');
    const ddone = document.getElementById('send');

    localStorage.setItem("valorInput2", val);

    inpat.value = val;
    ddone.value = valu;
}
