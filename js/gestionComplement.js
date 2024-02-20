//funcion para optener parametros GET
function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return false;
}

const form = document.getElementById("newDoc");

// Agregar un controlador de eventos para el evento click
form.addEventListener("click", modalcito);

function modalcito() {
    var ciUser = getQueryVariable('carga');
    var tipoDarch = getQueryVariable('gestion');

    rows = {
        "gestion": tipoDarch,
        "carga": ciUser
    }

    $.ajax({
        data: rows,
        url: "../layout/documentForm.php",
        type: "get",
        error: function (error) {
            $.alert({
                title: "error al cargar datos",
                content: "Hubo un error: " + error
            });
        },
        success: function (respuesta) {
            // modal de documentForm
            $.confirm({
                title: "nuevo documento",
                content: respuesta,
                columnClass: 'col-md-8 col-md-offset-8 col-xs-4 col-xs-offset-8',
                onContentReady: function () {
                    const inputFile = document.getElementById('inpArch');
                    const inputText = document.getElementById('nameArchive');

                    // Nombre del archivo en input name automaticamente y tamaño a 2mb
                    inputFile.addEventListener('change', (e) => {
                        const img = document.getElementById('docImg');
                        const file = e.target.files[0];
                        const dar = file.name.split('.').pop();

                        // alerta de limite 
                        if (file.size > 2097152) { // 2 MB
                            alert("El archivo PDF/imagen no debe exceder los 2 MB.");
                            inputFile.value = "";
                            inputText.value = "";
                            img.src = "../resources/doc.png";

                        } else {
                            const read = new FileReader(e);

                            read.onload = function (e) {
                                img.src = e.target.result;
                            }
                            read.readAsDataURL(file);

                            inputText.value = file.name;
                            // Edición del inputText si se escribe manualmente el nombre y no se encuentra ninguna extensión
                            inputText.addEventListener('input', (event) => {
                                const extension = inputText.value.split('.').pop();
                                if (!extension) {
                                    inputText.value += "." + dar;
                                }
                            });
                        }
                    });

                    var self = this;

                    // desactivar boton enviar
                    this.buttons.d.disable();

                    // colores de verificacion y activacion de input password 
                    this.$content.find('#inpArch').change(function () {
                        // activar boton de procesar 
                        if (self.$content.find('#inpArch').val() != "") {
                            self.buttons.d.enable();
                        } else {
                            self.buttons.d.disable();
                        }
                    });
                },
                buttons: {
                    d: {
                        text: "procesar",
                        btnClass: "btn-green",
                        action: function () {

                            const form = document.getElementById('caro');

                            // Creamos un objeto con los datos del formulario
                            var formData = new FormData(form);

                            // modal de confirmacion
                            $.confirm({
                                title: false,
                                content: "esta seguro que desea cargar este archivo?",
                                buttons: {
                                    subir: {
                                        text: "subir",
                                        btnClass: "btn-green",
                                        action: function () {
                                            // Enviamos el formulario por Ajax
                                            $.ajax({
                                                data: formData,
                                                processData: false,
                                                contentType: false,
                                                url: "../php/registroSolicitud.php",
                                                type: "POST",
                                                beforeSend: function () {
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
                                                    //CERRAR EL DIALOG ANTERIOR
                                                    setTimeout(() => {
                                                        obj.close();
                                                    }, 501);
                                                },
                                                error: function (error) {
                                                    // MENSAJE SUCCES
                                                    setTimeout(() => {
                                                        $.alert({
                                                            title: false,
                                                            closeIcon: false, // hides the close icon.
                                                            content: error`<div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
                                                                        <i class="bi-patch-exclamation-fill" style="font-size: 5rem; color: red;"></i>
                                                                        <h6  style="color: red;"> Error</h6>
                                                                        <span class="" style="color: red;" disabled>
                                                                            por favor intente nuevamente
                                                                        </span>
                                                                    </div>
                                                                    </div>`,
                                                            button: {

                                                            }
                                                        });
                                                    }, 500);
                                                },
                                                success: function (data) {
                                                    // Si la respuesta es exitosa, imprimimos el mensaje de éxito 
                                                    var dataT = data;

                                                    if (dataT == "success") {
                                                        // MENSAJE SUCCES
                                                        setTimeout(() => {
                                                            $.dialog({
                                                                title: false,
                                                                closeIcon: false, // hides the close icon.
                                                                content: `
                                                                        <div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
                                                                                            <i class="bi-check-circle" style="font-size: 5rem; color: green;"></i>
                                                                                            <span class="" style="color: #008000;" disabled>
                                                                                                <span class="spinner-border spinner-border-sm"  aria-hidden="true"></span>
                                                                                                <span role="status" style="color: green"  >Loading...</span>
                                                                                            </span>
                                                                        </div>
                                                                        </div>`,
                                                            });
                                                        }, 500);
                                                        setTimeout(() => {
                                                            location.replace("gestionData.php");
                                                        }, 2500);
                                                    } else {
                                                        $.dialog({
                                                            title: false,
                                                            content: `<div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
                                                                        <i class="bi-patch-exclamation-fill" style="font-size: 5rem; color: red;"></i>
                                                                        <h6  style="color: red;"> Error</h6>
                                                                        <span class="" style="color: red;" disabled>
                                                                            por favor intente nuevamente
                                                                        </span>
                                                                    </div>
                                                                    </div>`,
                                                        });
                                                    }
                                                },
                                            });
                                        }
                                    },
                                    cancelar: {
                                        text: "cerrar",
                                        action: function () {
                                            // Si el usuario hace clic en "Cancelar solicitud"
                                            // No se hace nada
                                        }
                                    }
                                }
                            });
                        }
                    },
                    c: {
                        text: "cerrar",
                        action: function () {

                        }
                    }
                }
            })
        }
    });
}

var tipoDarch = getQueryVariable('gestion');

// ocultar agregar documentos en el area de planillas
$(document).ready(function () {
    if (tipoDarch == "1046") {
        document.title = "SADINSAI | Planillas";
        document.getElementById("tittleDoc").innerHTML = "<h4 class='mb-3'>FORMULARIO</h4>";
    }
});
