function requerido(ci) {
    var cedul = ci;

    $.ajax({
        data: {
            "cedula": cedul
        },
        url: "../layout/requerimientos.php",
        type: "post",
        success: function (conten) {
            $.confirm({
                title: "Archivos Requeridos",
                content: conten,
                columnClass: 'col-md-10 col-md-offset-10 col-xs-4 col-xs-offset-8',
                buttons: {
                    ab: {
                        text: "guardar",
                        btnClass: "btn-success",
                        action: function () {
                            var checks = document.getElementById("requerimentos");
                            var form = new FormData(checks);

                            form.append("cedula", cedul);
                            $.ajax({
                                data: form,
                                url: "../php/requeriSave.php",
                                type: "post",
                                processData: false,
                                contentType: false,
                                beforeSend: function () {
                                    var obj =
                                        $.dialog({
                                            title: false,
                                            closeIcon: false, // ocultar close icon.
                                            content: `
                                            <div class="d-flex my-3 justify-content-center">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">procesando...</span>
                                            </div>
                                            </div>`
                                        });
                                    setTimeout(() => {
                                        obj.close();
                                    }, 501);
                                },
                                error: function () {
                                    setTimeout(() => {
                                        $.dialog({
                                            title: false,
                                            content: `
                                            <div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
                                                <i class="bi-patch-exclamation-fill" style="font-size: 5rem; color: red;"></i>
                                                <h6  style="color: red;"> Error</h6>
                                                <span class="" style="color: red;" disabled>
                                                    por favor intente nuevamente
                                                </span>
                                            </div>`
                                        });
                                    }, 500);
                                },
                                success: function (cc) {
                                    setTimeout(() => {
                                        if (cc == "success") {
                                            $.confirm({
                                                title: '',
                                                content: ` 
                                                <div class="grid text-center" style="row-gap: 0; display: flex; flex-direction: column;">
                                                    <i class="bi-check-circle" style="font-size: 5rem; color: green;"></i>
                                                    <span class="" style="color: #008000;" disabled>
                                                        <span role="status" style="color: green" >se guardo correctamente</span>
                                                    </span>
                                                </div>`,
                                                buttons: {
                                                    da: {
                                                        text: 'cerrar',
                                                        action: function () {

                                                        }
                                                    }
                                                }
                                            });
                                        } else {
                                            $.confirm({
                                                title: 'error',
                                                content: cc,
                                                buttons: {
                                                    da: {
                                                        text: 'cerrar',
                                                        action: function () {

                                                        }
                                                    }
                                                }
                                            });
                                        }

                                    }, 500);
                                }
                            });
                        }
                    },
                    cb: {
                        text: "cerrar",
                        btnClass: "btn-dark",
                        action: function () {

                        }
                    }
                }
            });
        }
    });
}