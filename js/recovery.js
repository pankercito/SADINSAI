$(document).ready(function () {
    // Agregar un controlador de eventos para el evento click del botón
    $('#verify').click(function (event) {
        const ci = document.getElementById("ci").value;
        var boton = document.getElementById("verify");
        var help = document.querySelector("#mensajeCi");

        $.ajax({
            data: {
                "ci": ci
            },
            url: "../php/verificarCi.php",
            type: "post",
            beforeSend: function () {
                boton.setAttribute("disabled", true);
                boton.innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> Procesando...</span>';
            },
            success: function (res) {
                setTimeout(() => {
                    switch (res) {
                        case "¡La CI ingresada ya está registrada!":
                            help.innerText = 'cedula verificada correctamente';
                            help.classList.remove('text-muted');
                            help.style.color = '#00b500';
                            boton.innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">  preparando...</span>';
                            setTimeout(() => {
                                boton.innerHTML = "correcto";
                                // formulario de registro 
                                $.confirm({
                                    title: "cambio de contraseña",
                                    content: "url:recoveryForm.php",
                                    onContentReady: function () {

                                        var pass = document.getElementById("pass");
                                        var vpas = document.getElementById("vpass");
                                        var help = document.getElementById("helpId1");

                                        // VERIFICACION DE PIN
                                        $('#pin').keyup(function () {

                                            var pin = $("#pin").val();

                                            if (pin.length > 3) {
                                                $.ajax({
                                                    data: {
                                                        "pin": pin,
                                                        "ci": ci
                                                    },
                                                    url: "../php/pinRecovery.php",
                                                    type: "post",
                                                    beforeSend: function () {
                                                        help.classList.add('text-muted');
                                                        help.innerHTML = 'verificando...';
                                                    },
                                                    success: function (res) {
                                                        setTimeout(() => {
                                                            switch (res) {
                                                                case "pin.success":
                                                                    help.innerText = 'pin verificado correctamente';
                                                                    help.classList.remove('text-muted');
                                                                    help.style.color = '#00b500';
                                                                    pass.removeAttribute("disabled");
                                                                    vpas.removeAttribute("disabled");
                                                                    break;
                                                                case "false":
                                                                    help.innerText = "ingrese su pin de verificarcion";
                                                                    help.classList.add('text-muted');
                                                                    pass.setAttribute("disabled", "true");
                                                                    vpas.setAttribute("disabled", "true");
                                                                    break;
                                                                default:
                                                                    help.classList.remove('text-muted');
                                                                    help.style.color = "red";
                                                                    help.innerText = 'pin erroneo';
                                                                    pass.setAttribute("disabled", "true");
                                                                    vpas.setAttribute("disabled", "true");
                                                                    break;
                                                            }
                                                        }, 500);
                                                    }
                                                });
                                            } else {
                                                help.innerText = "ingrese su pin de verificarcion";
                                                help.classList.add('text-muted');
                                                pass.setAttribute("disabled", "true");
                                                vpas.setAttribute("disabled", "true");
                                            }


                                        });

                                        var self = this;

                                        var h = false;

                                        // desactivar boton enviar
                                        this.buttons.registrar.disable();

                                        // colores de verificacion y activacion de input password 
                                        this.$content.find('.form-control').keyup(function () {
                                            if (self.$content.find('#vpass').val() == self.$content.find("#pass").val()) {
                                                document.getElementById("helpId3").classList.add('text-muted');
                                                document.getElementById("helpId3").innerText = "verificar contraseña";
                                                h = true;
                                            } else {
                                                document.getElementById("helpId3").classList.remove('text-muted');
                                                document.getElementById("helpId3").style.color = "red";
                                                document.getElementById("helpId3").innerText = "la contraseña no coincide";
                                                h = false;
                                            }
                                            // activar boton de procesar 
                                            if (self.$content.find('#pin').val() != "" && self.$content.find("#pass").val() != "" && self.$content.find('#vpass').val() != "" && h == true) {
                                                self.buttons.registrar.enable();
                                            } else {
                                                self.buttons.registrar.disable();
                                            }
                                        });
                                    },
                                    buttons: {
                                        registrar: {
                                            text: "procesar",
                                            action: function () {
                                                const form = document.getElementById('recover');

                                                var fom = new FormData(form);

                                                fom.append("ci", ci);

                                                // registro con ajax
                                                $.ajax({
                                                    data: fom,
                                                    url: "../php/recoverChange.php",
                                                    type: "post",
                                                    processData: false,
                                                    contentType: false,
                                                    error: function (error) {
                                                        $.confirm({
                                                            title: false, // hides the title.
                                                            content: `
                                                                <div class="d-flex justify-content-center">
                                                                <h6> error al procesar intente nuevamente</h6>
                                                                <i class="bi bi-arrow"></i>
                                                                ` + error + `
                                                                </div>
                                                                </div>`,
                                                            buttons: {
                                                                r: {
                                                                    text: "cerrar",
                                                                    action: function () {
                                                                        help.innerText = "ingrese su numero de cedula";
                                                                        help.classList.add('text-muted')
                                                                        boton.removeAttribute("disabled");
                                                                        boton.innerText = "consultar";
                                                                    }
                                                                }
                                                            }


                                                        });
                                                    },
                                                    success: function (respons) {

                                                        $.confirm({
                                                            title: '',
                                                            content: respons,
                                                            buttons: {
                                                                da: {
                                                                    text: 'cerrar',
                                                                    action: function () {
                                                                        location.reload();
                                                                    }
                                                                },
                                                                rs: {
                                                                    text: "inicio de sesion",
                                                                    action: function () {
                                                                        location.replace("../index.php");
                                                                    }
                                                                }
                                                            }
                                                        });

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
                            help.innerText = "ingrese su numero de cedula";
                            help.classList.add('text-muted')
                            boton.removeAttribute("disabled");
                            boton.innerHTML = "consultar";
                            break;
                        default:
                            help.innerText = 'numero de cedula no esta registrado';
                            help.classList.remove('text-muted');
                            help.style.color = "red";
                            boton.removeAttribute("disabled");
                            boton.innerText = "consultar";
                            break;
                    }
                }, 500);
            }
        });
    });
});