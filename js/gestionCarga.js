// funcion general de envio de imagen 
$(document).ready(function () {
    // Cuando el usuario hace clic en el botón de enviar, enviamos el formulario por Ajax
    $("#caro").submit(function (event) {
        event.preventDefault();

        // Creamos un objeto FormData con los datos del formulario
        var formData = new FormData(this);

        // modal de confirmacion
        $.confirm({
            title: false,
            content: "esta seguro que desea cargar este archivo?",
            buttons: {
                subir: {
                    text: "subir",
                    action: function () {
                        // Enviamos el formulario por Ajax a la página `procesArchives.php`
                        $.ajax({
                            data: formData,
                            url: "../php/procesArchives.php",
                            type: "POST",
                            processData: false,
                            contentType: false,
                            beforeSend: function () {
                                var obj =
                                    $.dialog({
                                        title: false,
                                        closeIcon: false, // hides the close icon.
                                        content: `
                                      <div class="d-flex justify-content-center">
                                                        <div class="spinner-border" role="status">
                                           <span class="visually-hidden">Loading...</span>
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
                                        content: error `<div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
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
                                        location.reload();
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
    });
});

const inputFile = document.getElementById('inpArch');
const inputText = document.getElementById('nameArchive');

// Nombre del archivo en input name automaticamente
inputFile.addEventListener('change', (e) => {
    const img = document.getElementById('docImg');
    const pdf = document.getElementById('docPdf');
    const file = e.target.files[0];
    const dar = file.name.split('.').pop();

    if(file){
        const read = new FileReader(e);
      
        read.onload = function(e){
          if (dar == 'pdf') {
            img.src = "";
            pdf.src = e.target.result;
            img.style.display = "none";
            pdf.style.display = "unset";
          } else {
            pdf.src = "";
            pdf.style.display = "none";
            img.style.display = "unset";
            img.src = e.target.result;
          }
        }
        read.readAsDataURL(file);
      }else{
        img.src = defaultFile;
      }

    inputText.value = file.name;

    // Edición del inputText si se escribe manualmente el nombre y no se encuentra ninguna extensión
    inputText.addEventListener('input', (event) => {
        const extension = inputText.value.split('.').pop();
        if (!extension) {
            inputText.value += "." + dar;
        }
    });
});