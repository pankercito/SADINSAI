<?php require("../layout/head.php"); ?>

<link rel="stylesheet" href="../styles/recovery.css">
<link rel="stylesheet" href="../styles/background.css">

<div class="content">
    <div class="col-lg-12 d-flex">
        <div class="fless col-lg-5">
            <h5 class="text-center">Recuperacion de Contraseña</h5>
            <label for="ci" class="form-label">cedula</label>
            <input id="ci" type="text" class="form-control" name="cedula" maxlength="8" aria-describedby="mensajeCi"
                autocomplete="off">
            <small id="mensajeCi" class="form-text text-muted">ingrese su numero de cedula</small>
            <button class="consul btn btn-primary" id="verify">consultar</button>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        // Agregar un controlador de eventos para el evento click del botón
        $('#verify').click(function (event) {
            const ci = document.getElementById("ci").value;
            var boton = document.getElementById("verify");
            var help = document.querySelector("#mensajeCi");

            $.ajax({
                data: { "ci": ci },
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
                                boton.innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status"> redirigiendo...</span>';
                                // redirigir con informacion post a pagina de recuperacion
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
                                help.style.color ="red";                                                      
                                boton.removeAttribute("disabled");
                                boton.innerText = "consultar";
                                break;
                        }
                    }, 500);
                }
            })
        })
    }) 
</script>