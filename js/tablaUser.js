// DATATABLE USUARIOS
var table = new DataTable('#table', {
    ajax: {
        url: "../php/preset/viewSolicitudes.php",
        dataSrc: 'data'
    },
    initComplete: function () {
        // agregar filtros (selectores) a tabla 
        this.api().columns([3]).every(function () {
            var column = this;
            var select = $('<select class="filterE"><option value="">Tipo</option></select>')
                .appendTo($(column.header()).empty())
                .on('change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            column.data().unique().sort().each(function (d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
            });
        });
    },
    // orden de carga inicial
    order: [
        [2, 'desc']
    ],
    //OCULTAR COLUMNA
    columnDefs: [
        {
            target: 6,
            visible: false
        }
    ],
    language: {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
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
        (usernameEl.val() == '' || username.toLowerCase().includes(usernameEl.val().toLowerCase()))
    ) {
        return true;
    }

    return false;
});

// accion en selector
$('#estado').on('change', function () {
    table.draw();
});

// RECARGA DE LA TABLA AUTOMATICA CADA 1M || NUMERO EN MILISEGUNDOS
setInterval(() => {
    table.ajax.reload(null, false);
}, 60000);