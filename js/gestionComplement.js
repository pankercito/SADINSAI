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
    var obj = $.dialog({
        title: false,
        closeIcon: false, // hides the close icon.
        content: `
        <div class="d-flex justify-content-center">
            <div class="spinner-border my-3" role="status">
                <span class="visually-hidden">procesando...</span>
            </div>
        </div>`
    });

    var ciUser = getQueryVariable('c');
    var tipoDarch = getQueryVariable('g');

    rows = {
        "g": tipoDarch,
        "c": ciUser
    }

    $.ajax({
        data: rows,
        url: "../layout/documentForm.php",
        type: "get",
        error: function (error) {

            obj.close();

            $.alert({
                title: "error al cargar datos",
                content: "Hubo un error: " + error
            });
        },
        success: function (respuesta) {
            obj.close();

            // modal de documentForm
            $.confirm({
                title: "Nuevo Documento",
                content: respuesta,
                columnClass: 'col-md-11 col-11',
                onOpenBefore: function () {
                    this.buttons.d.disable();
                },
                onContentReady: function () {
                    const inputFile = document.getElementById('arch');
                    const inputText = document.getElementById('archName');
                    const inputPerson = document.getElementById('Responsable');
                    const inputPersonDnone = document.getElementById('Presponsable');
                    let buutt = document.getElementById('veroff');
                    const resultDnone = document.getElementById('PersonDi');

                    //BUSQUEDA DE PESONAL   
                    inputPerson.addEventListener('keyup', (e) => {
                        PersonalAsig(inputPerson, resultDnone, inputPersonDnone);
                    });

                    // Nombre del archivo en input name automaticamente y tamaño a 2mb
                    inputFile.addEventListener('change', (e) => {
                        const img = document.getElementById('docImg');
                        const pdf = document.getElementById('docPdf');
                        const file = e.target.files[0];
                        const dar = file.name.split('.').pop();

                        // alerta de limite 
                        if (file.size > 2097152) { // 2 MB en bits
                            alert("El archivo PDF/imagen no debe exceder los 2 MB.");
                            inputFile.value = "";
                            inputText.value = "";
                            img.src = "../resources/doc.png";

                        } else {
                            const read = new FileReader(e);

                            read.onload = function (e) {
                                if (dar == 'pdf') {
                                    img.src = "";
                                    img.classList.add("d-none");
                                    pdf.classList.remove("d-none");
                                    pdf.src = e.target.result;
                                } else {
                                    pdf.src = "";
                                    pdf.classList.add = "d-none";
                                    img.classList.remove = "d-none";
                                    img.src = e.target.result;
                                }
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

                    // ACTIVAR INPUT
                    this.$content.find('#caro input').change(function () {
                        // activar boton de procesar 
                        if (self.$content.find('#arch').val() != "" &&
                            self.$content.find('#departament').val() != 0 &&
                            self.$content.find('#Responsable').val() == localStorage.getItem('valorInput')) {
                            self.buttons.d.enable();
                        } else {
                            self.buttons.d.disable();
                        }
                    });

                    this.$content.find('#veroff').click(function () {
                        // activar boton de procesar 
                        if (self.$content.find('#arch').val() != "" &&
                            self.$content.find('#departament').val() != 0 &&
                            self.$content.find('#Responsable').val() == localStorage.getItem('valorInput')) {
                            self.buttons.d.enable();
                        } else {
                            self.buttons.d.disable();
                        }
                    });

                    // ACTIVAR INPUT Código para el select
                    this.$content.find('#caro #departament').change(function () {
                        if (self.$content.find('#arch').val() != "" &&
                            self.$content.find('#departament').val() != 0 &&
                            self.$content.find('#Responsable').val() == localStorage.getItem('valorInput')) {
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

                            localStorage.removeItem('valorInput');

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

                                            // Enviamos el formulario por Ajax
                                            $.ajax({
                                                data: formData,
                                                processData: false,
                                                contentType: false,
                                                url: "../php/registroSolicitud.php",
                                                type: "POST",
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

                                                    obj.close();
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
                                                        }, 400);
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

//filtro de busqueda de personal
function PersonalAsig(inpat, resultDiv, inputValAsig) {

    let input = inpat; //id del input de busqueda;
    let inputDnone = inputValAsig; //id del input de busqueda;
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
                        let elemetos = `<a onclick="itemsB('${element['nombre']} ${element['apellido']}', '${element['ci']}')" class="nav-link mt-2 p-2">${element['nombre']} ${element['apellido']}</a>`;
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
        }, 400);
    });
}


function itemsB(val, valu) {
    const inputPerson = document.getElementById('Responsable');
    const inputPersonDnone = document.getElementById('Presponsable');

    localStorage.setItem("valorInput", val);

    inputPersonDnone.value = valu;
    inputPerson.value = val;
}
