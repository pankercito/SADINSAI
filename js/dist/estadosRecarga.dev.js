"use strict";

// DATTABLE DE PERSONAL
$('#table').DataTable({
  // selects de filtrado en columnas
  initComplete: function initComplete() {
    this.api().columns([0, 1, 6]).every(function () {
      var column = this;
      var select = $('<select class="filterE"><option value=""></option></select>').appendTo($(column.footer()).empty()).on('change', function () {
        var val = $.fn.dataTable.util.escapeRegex($(this).val());
        column.search(val ? '^' + val + '$' : '', true, false).draw();
      });
      column.data().unique().sort().each(function (d, j) {
        select.append('<option value="' + d + '">' + d + '</option>');
      });
    });
  },
  autoWidth: false,
  language: {
    "decimal": "",
    "emptyTable": "No hay información",
    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
    "infoFiltered": "(Filtrado de _MAX_ entradas totales)",
    "infoPostFix": "",
    "thousands": ",",
    "lengthMenu": "Mostrar  _MENU_ Entradas",
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
  }
});