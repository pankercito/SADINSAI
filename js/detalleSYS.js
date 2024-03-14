function detalleMovi(id) {

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

    $.ajax({
        data: {
            'id': id
        },
        url: '../layout/detalleSys.php',
        type: 'post',
        success: function (data) {
            obj.close();
            
            $.confirm({
                title: "",
                content: data,
                buttons: {
                    ac: {
                        text: "cerrar",
                        action: function () {

                        }
                    }
                }
            })
        }
    });
}