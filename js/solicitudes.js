//DETALLES *************************************
function detalles(idSolis, tipoS) {
    var idSoli = idSolis;
    var tipo = tipoS;
    // Obtener los datos
    var parametro = {
        "idSoli": idSoli,
        "tipoSoli": tipo,
    };
    var contenido = "no";

    var obj = $.dialog({
        title: false,
        closeIcon: false, // hides the close icon.
        content: `
        <div class="d-flex justify-content-center">
            <div class="spinner-border my-3" role="status">
                <span class="visually-hidden">cargando...</span>
            </div>
        </div>`
    });

    $.ajax({
        data: parametro,
        url: '../php/preset/viewDetails.php',
        type: 'POST',
        error: function (jqXHR, xhr, status, error) {
            var nroERROR = jqXHR.status;
            alert("Estatus " + status)
        },
        success: function (response) {
            contenido = response;

            obj.close();

            // Mostrar el diálogo de confirmación
            $.confirm({
                title: '',
                content: contenido,
                columnClass: 'col-md-8 col-md-offset-4',
                boxWidth: '50%',
                buttons: {
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
};

//DETALLES  PLANILLAS *************************************
function detallesPlanillas(idSolis, tipoS) {
    var idSoli = idSolis;
    var tipo = tipoS;
    // Obtener los datos
    var parametro = {
        "idSoli": idSoli,
        "tipoSoli": tipo,
    };
    var contenido = "no";

    var obj = $.dialog({
        title: false,
        closeIcon: false, // hides the close icon.
        content: `
        <div class="d-flex justify-content-center">
            <div class="spinner-border my-3" role="status">
                <span class="visually-hidden">cargando...</span>
            </div>
        </div>`
    });

    $.ajax({
        data: parametro,
        url: '../php/preset/viewDetailsPlanillas.php',
        type: 'POST',
        error: function (jqXHR, xhr, status, error) {
            var nroERROR = jqXHR.status;
            alert("Estatus " + status)
        },
        success: function (response) {
            contenido = response;

            obj.close();

            // Mostrar el diálogo de confirmación
            $.confirm({
                title: '',
                content: contenido,
                columnClass: 'col-md-8 col-md-offset-4',
                boxWidth: '50%',
                // antes de lanzar modal
                onOpenBefore: function () {
                    var self = this;
                    self.buttons.printar.hide();
                },
                //modal cargado
                onContentReady: function () {
                    var coco = $("#coco");
                    var self = this;

                    // mostrar ocultar boton 
                    if (coco.val() == 2) {
                        self.buttons.printar.show();
                    }
                },

                buttons: {
                    printar: {
                        text: 'descargar planilla',
                        action: function () {
                            alert('verg');
                            $.ajax({
                                data: parametro,
                                url: '../php/preparePlanillas.php',
                                type: 'POST',
                                success: function (params) {
                                    window.open("../pdf/planilla"+params+".php", "_blank");
                                }
                            })
                        }
                    },

                    cerrar: {
                        text: 'cerrar',
                        status: false,
                        action: function () {
                            //funcion a realizar
                        }
                    }
                }
            });
        }
    });
};