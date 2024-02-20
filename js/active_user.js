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
                switch (res) {
                    case "¡La CI ingresada ya está registrada!":
                        help.innerText = 'cedula verificada correctamente';
                        help.classList.remove('text-muted');
                        help.style.color = '#00b500';
                        boton.innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">preparando...</span>';

                        boton.innerHTML = "verificado";
                        // formulario de registro 
                        $.confirm({
                            title: "activar usuario",
                            content: "url:active_account_form.php",
                            onOpenBefore: function () {
                                this.buttons.registrar.disable();
                            },
                            onContentReady: function () {
                                let self = this;
                                let help1 = document.getElementById("helpId1");

                                $('#activeuser').submit(function (event) {
                                    event.preventDefault();
                                });

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
                                                help1.classList.add('text-muted');
                                                help1.innerHTML = 'verificando...';
                                            },
                                            success: function (res) {
                                                setTimeout(() => {
                                                    switch (res) {
                                                        case "pin.success":
                                                            help1.innerText = 'pin verificado correctamente';
                                                            help1.classList.remove('text-muted');
                                                            help1.style.color = '#00b500';
                                                            self.buttons.registrar.enable();
                                                            break;
                                                        case "false":
                                                            help1.innerText = "ingrese su pin de verificación";
                                                            help1.classList.add('text-muted');
                                                            self.buttons.registrar.disable();
                                                            break;
                                                        default:
                                                            help1.classList.remove('text-muted');
                                                            help1.style.color = "red";
                                                            help1.innerText = 'pin erroneo';
                                                            self.buttons.registrar.disable();
                                                            break;
                                                    }
                                                }, 500);
                                            }
                                        });
                                    } else {
                                        help1.innerText = "ingrese su pin de verificación";
                                        help1.classList.add('text-muted');
                                    }
                                });
                            },
                            buttons: {
                                registrar: {
                                    text: "activar",
                                    action: function () {
                                        const form = document.getElementById('activeuser');

                                        var fom = new FormData(form);

                                        fom.append("ci", ci);

                                        // registro con ajax
                                        $.ajax({
                                            data: fom,
                                            url: "../php/active_user.php",
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
                                                // MODAL DE RESPUESTA
                                                switch (respons) {
                                                    case 'success':
                                                        $.confirm({
                                                            title: 'se ha activado el usuario correctamente',
                                                            content: false,
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
                                                        break;
                                                    case 'active':
                                                        $.confirm({
                                                            title: 'este usuario ya esta activado',
                                                            content: false,
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
                                                        break;

                                                    default:
                                                        break;
                                                }
                                            }
                                        })
                                    },
                                },
                                cancelar: {
                                    text: "Cancelar",
                                    action: function () {
                                        boton.removeAttribute("disabled");
                                        boton.innerText = "consultar";
                                    }
                                }
                            }

                        });

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
            }
        });
    });
});