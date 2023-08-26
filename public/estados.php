<?php require_once("../php/sesionval.php"); ?>

<?php require("../layout/head.php"); ?>

<?php 
include("../php/function/removerAcentos.php");

require("../layout/navbar.php"); 
?>


<link rel="stylesheet" href="../styles/estados.css">
<link rel="stylesheet" href="../styles/viewtables.css">

<!--SALUDO DE BIENVENIDA-->
<section name="cromaconten">
  <div class="contencroma">
    <?php
    include("../layout/sidebar.php");
    ?>
  </div>
</section>

<div class="estructur-conten">
  <div class="grid-containerr">

    <div class="row">
      <?php
      require_once("../layout/estadosTable.php");
      ?>
      <div class="sot col-lg-8">
        <div class="conten">
          <table id="example" class="table table-striped">
            <thead>
              <tr>
                <th>estado</th>
                <th>sede</th>
                <th>nombre</th>
                <th>apellido</th>
                <th>ci</th>
                <th>telefono</th>
                <th>cargo</th>
              </tr>
            </thead>
            <tbody>
              <?php include "../php/preset/seleccionStados.php" ?>
            </tbody>
            <tfoot>
              <tr>
                <th>estado</th>
                <th>sede</th>
                <th>nombre</th>
                <th>apellido</th>
                <th>ci</th>
                <th>telefono</th>
                <th>cargo</th>
              </tr>
            </tfoot>
          </table>

          <script type="text/javascript">
            $("#example").DataTable( {
              autoWidth: false,
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
              }
            });
            $(document).ready(function () {
              $("#states").on("change", function () {
                var estado = $(this).val();

                var table = $("#example");

                // Obtenemos el valor seleccionado del select
                const selectedValue = $(this).val();

                // Iteramos sobre las filas de la tabla
                table.find("tr").each(function (index, row) {
                  // Obtenemos el valor de la celda de la columna correspondiente
                table.column("estado").search(selectedValue).draw();
                });
              });
            })

          </script>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../js/search.js"></script>

<?php require("../layout/footer.php"); ?>