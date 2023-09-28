// REGISTRO DE ADMIN 
$(document).ready(function () {
    // Agregar un controlador de eventos para el evento click del botón
    $('#verify').click(function (event) {
        event.preventDefault();

        const pin = document.getElementById("pin").value;
        var boton = document.getElementById("verify");
        var help = document.querySelector("#mensajePin");

        $.ajax({
            data: {
                "pin": pin
            },
            url: "../php/verificarPin.php",
            type: "post",
            beforeSend: function () {
                boton.setAttribute("disabled", true);
                boton.innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Procesando...</span>';
            },
            success: function (res) {
                setTimeout(() => {
                    switch (res) {
                        case "pin.success":
                            // pin correcto
                            help.innerText = 'pin verificado correctamente';
                            help.classList.remove('text-muted');
                            help.style.color = '#00b500';
                            boton.innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> preparando...</span>';

                            setTimeout(() => {
                                boton.innerHTML = "correcto";
                                // formulario de registro 
                                $.confirm({
                                    title: "registro de administrador",
                                    content: "url:adminFormRegis.php",
                                    onContentReady: function () {
                                        var self = this;

                                        var h = false;

                                        // desactivar boton enviar
                                        this.buttons.registrar.disable();
                                        this.$content.find('.form-control').change(function () {
                                            if (self.$content.find('#vpass').val() == self.$content.find("#pass").val()) {
                                                h = true;
                                            } else {
                                                h = false;
                                            }
                                            if (self.$content.find('#cedula').val() != "" && self.$content.find('#user').val() != "" && self.$content.find("#pass").val() != "" && self.$content.find('#vpass').val() != "" && h == true) {
                                                self.buttons.registrar.enable();
                                            } else {
                                                self.buttons.registrar.disable();
                                            }
                                        });
                                    },
                                    buttons: {
                                        registrar: {
                                            text: "registrar",
                                            action: function () {
                                                var cedula = $("#cedula").val();
                                                var user = $("#user").val();
                                                var pass = $("#pass").val();
                                                // registro con ajax
                                                $.ajax({
                                                    data: {
                                                        "cedula": cedula,
                                                        "user": user,
                                                        "pass": pass
                                                    },
                                                    url: "../php/adminregis.php",
                                                    type: "post",
                                                    error: function (error) {
                                                        $.confirm({
                                                            title: false, // hides the title.
                                                            content: `
                                                                    <div class="d-flex justify-content-center">
                                                                    <h6> error al registrar intente nuevamente</h6>
                                                                    <i class="bi bi-arrow"></i>
                                                                    </div>
                                                                    </div>`,
                                                            buttons: {
                                                                r: {
                                                                    text: "cerrar",
                                                                    action: function () {
                                                                        help.innerText = "Ingrese el pin de de registro por favor";
                                                                        help.classList.add('text-muted')
                                                                        boton.removeAttribute("disabled");
                                                                        boton.innerText = "consultar";
                                                                    }
                                                                },
                                                                rs: {
                                                                    text: " ir a iniciar sesion",
                                                                    action: function () {
                                                                        location.replace("../index.php");
                                                                    }
                                                                }
                                                            }


                                                        });
                                                    },
                                                    success: function (respons) {
                                                        switch (respons) {
                                                            case "success":
                                                                $.confirm({
                                                                    title: 'registro completado exitosamente',
                                                                    content: respons,
                                                                    buttons: {
                                                                        da: {
                                                                            text: 'cerrar',
                                                                            action: function () {
                                                                                location.reload();
                                                                            }
                                                                        },
                                                                        rs: {
                                                                            text: " ir a iniciar sesion",
                                                                            action: function () {
                                                                                location.replace("../index.php");
                                                                            }
                                                                        }
                                                                    }
                                                                });
                                                                break;
                                                            default:
                                                                $.alert({
                                                                    title: false, // hides the title.
                                                                    content: `
                                                                    <div class="d-flex justify-content-center">
                                                                    <h6> error al registrar intente nuevamente</h6>
                                                                    <i class="bi bi-arrow"></i>
                                                                    </div>
                                                                    </div>`,
                                                                    buttons: {
                                                                        r: {
                                                                            text: "cerrar",
                                                                            action: function () {
                                                                                help.innerText = "Ingrese el pin de de registro por favor";
                                                                                help.classList.add('text-muted')
                                                                                boton.removeAttribute("disabled");
                                                                                boton.innerText = "consultar";
                                                                            }
                                                                        }
                                                                    }
                                                                });
                                                                break;
                                                        }
                                                    }
                                                })
                                            },
                                        },
                                        cancelar: {
                                            text: "Cancelar",
                                            action: function () {
                                                help.innerText = "Ingrese el pin de de registro por favor";
                                                help.classList.add('text-muted')
                                                boton.removeAttribute("disabled");
                                                boton.innerText = "consultar";
                                            }
                                        }
                                    }

                                })

                            }, 1000);

                            break;
                        case "false":
                            help.innerText = "Ingrese el pin de registro por favor";
                            help.classList.add('text-muted')
                            boton.removeAttribute("disabled");
                            boton.innerText = "consultar";
                            break;

                        default:
                            help.innerText = 'el pin es incorrecto';
                            help.classList.remove('text-muted');
                            help.style.color = "red";
                            boton.removeAttribute("disabled");
                            boton.innerText = "consultar";
                            break;
                    }
                }, 500);
            }
        })
    })
})

// SOLICITUD DE PIN
$(document).ready(function () {
    // Agregar un controlador de eventos para el evento click del botón
    $('#soli').click(function (event) {
        event.preventDefault();

        $.confirm({
            title: "solicitar de pin de administrador",
            content: "url:solicitud.php",
            onContentReady: function () {
                var self = this;
                // desactivar boton enviar
                this.buttons.enviar.disable();
                this.$content.find('.form-control').change(function () {
                    if (self.$content.find('#mail').val() != "" && self.$content.find('#razon').val() != "") {
                        self.buttons.enviar.enable();
                    } else {
                        self.buttons.enviar.disable();
                    }
                });
            },
            buttons: {
                enviar: {
                    text: "Enviar",
                    action: function () {
                        $('#solicitud').submit();
                    },

                },
                cancelar: {
                    text: "Cancelar solicitud",
                    action: function () {
                        // Si el usuario hace clic en "Cancelar solicitud"
                        // No se hace nada
                    }
                }
            }
        });
    })
})