//funcion ajax para verificar la cedula
function verificarCI() {
    const ci = document.getElementById("ci").value;

    if (ci.length >= 7 && ci.length < 9) {
        // Use the $.ajax() method to send the request
        $.ajax({
            url: "../php/verificarCi.php",
            type: "POST",
            data: {
                ci: ci
            },
            success: function (respuesta) {
                switch (respuesta) {
                    case "!registra primero¡":
                        document.getElementById("mensajeCi").innerHTML = "Estas intentando registrar a una persona que no se encuentra en la empresa para continuar, primero debe agregarla al personal";
                        document.getElementById("mensajeCi").classList.remove('text-muted');
                        document.getElementById("mensajeCi").style.color = "#ffbdcc";
                        document.getElementById("mensajeCi").style.fontWeight = "600";
                        $("#singup").attr("disabled", true);

                        break;
                    case "¡La CI ingresada ya está registrada!":
                        document.getElementById("mensajeCi").innerHTML = "¡Esta persona ya esta registrada!";
                        document.getElementById("mensajeCi").style.color = "#ffbdcc";
                        document.getElementById("mensajeCi").style.fontWeight = "600";
                        document.getElementById("mensajeCi").classList.remove('text-muted');
                        $("#singup").attr("disabled", true);
                        break;
                    case "false":
                        document.getElementById("mensajeCi").innerHTML = "ingrese la cedula para comprovacion";
                        document.getElementById("mensajeCi").classList.add('text-muted');
                        $("#singup").attr("disabled", true);
                        break;
                    case "true":
                        document.getElementById("mensajeCi").innerHTML = "verificado correctamente";
                        document.getElementById("mensajeCi").style.fontWeight = "600";
                        document.getElementById("mensajeCi").style.color = "lime";
                        document.getElementById("singup").removeAttribute("disabled");
                        document.getElementById("mensajeCi").classList.remove('text-muted');

                        break;
                    default:
                        console.log("Respuesta no válida");
                        break;
                }

            }

        });
    } else if (ci.length > 8) {
        document.getElementById("mensajeCi").innerHTML = "ingrese una cedula valida";
        document.getElementById("mensajeCi").classList.remove('text-muted');
        document.getElementById("mensajeCi").style.color = "#ffbdcc";
        $("#singup").attr("disabled", true);
    } else {
        document.getElementById("mensajeCi").innerHTML = "ingrese la cedula para comprovacion";
        document.getElementById("mensajeCi").classList.add('text-muted');
        $("#singup").attr("disabled", true);


    }
}