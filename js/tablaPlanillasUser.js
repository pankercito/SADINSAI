var puth = $("#table").DataTable({
    ajax: {
        url: "../php/preset/viewPlanillasSolicisUser.php",
    },
    columnDefs: [
        {
            target: 6,
            visible: false
        }
    ],
    order:[
        [3, 'desc']
    ],
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar  _MENU_  Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:  ",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    },
});

var usernameEl = $('#estado');

//FILTRO TABLA
DataTable.ext.search.push(function (settings, data, dataIndex) {
    var username = data[6]; // use data for the username column

    if (
        (usernameEl.val() == '0' || username.toLowerCase().includes(usernameEl.val().toLowerCase()))
    ) {
        return true;
    }

    return false;
});

// accion en selector
$('#estado').on('change', function () {
    puth.draw();
});

// RECARGA DE LA TABLA AUTOMATICA CADA 1M || NUMERO EN MILISEGUNDOS
setInterval(() => {
    puth.ajax.reload(null, false);
}, 60000);