<?php require "../php/sesionval.php" ?>
<?php require("../php/adp.php"); ?>


<?php require "../layout/head.php" ?>

<?php require "../layout/navbar.php" ?>

<script type="text/javascript">
    localStorage.setItem('activeSection', '6');
</script>

<!--SALUDO DE BIENVENIDA-->
<?php
include "../layout/sidebar.php";
?>

<div class="grid-containerr">
    <div class="row col d-flex">
        <div class="col-3 mx-auto flex-column d-flex justify-conten-center">
            <h6 style="color: #e7e7e7;">Acciones</h6>
            <hr style="border-color:white;">
            <div class="col flex-item mt-3">
                <button class="btn btn-warning" type="button" data-bs-toggle="collapse" data-bs-target="#contentId"
                    aria-expanded="false" aria-controls="contentId">
                    Agregar Sede
                </button>
                <div class="collapse" id="contentId">
                    <form class="col-8 my-4 flex-column d-flex mx-auto justify-conten-center">
                        <label>
                            estado
                            <select name="estado" id="estado" class="form-select mb-3">
                                <option value="">Selecione un estado</option>
                                <?php include "../php/preset/viewAllEstados.php" ?>
                            </select>
                        </label>
                        <label>
                            direccion
                            <input type="text" name="direccion" id="dir" class="form-control mb-3" disabled>
                        </label>
                        <label>
                            nueva sede
                            <input type="text" name="sede" id="sede" class="form-control mb-3" disabled>
                        </label>
                        <button type="submit" class="btn btn-primary my-3" id="lalo" disabled>agregar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col text-center">
            <h4 class="mx-auto mb-2 mt-0" style="color: #e7e7e7;">SEDES</h4>
            <hr style="border-color:white;">
            <div class="col-11 mt-5 mx-auto">
                <div class="mx-auto">
                    <table class="table table-striped 
                    table-hover	
                    table-primary
                    align-middle" id="table">
                        <thead class="table-light">
                            <tr>
                                <th>N°</th>
                                <th>ESTADO</th>
                                <th>NOMBRE</th>
                                <th>DIRECCION</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php
                            $sql = $conn->query("SELECT * FROM sedes s INNER JOIN estados e ON s.id_estado_sed = e.id_estado");

                            $count_results = mysqli_num_rows($sql);

                            if ($count_results !== 0) {
                                $i = 1;
                                while ($v = $sql->fetch_object()) {
                                    //Lista de los usuarios
                                    echo '<tr class="primary">';
                                    echo '<td style="border-left: none;">' . $i . '</td>';
                                    echo '<td style="font-size:18px;">' . ucwords(strtolower($v->estado)) . '</td>';
                                    echo '<td>' . ucwords(strtolower($v->nombre_sede)) . '</td>';
                                    echo '<td>' . ucwords(strtolower($v->dir_local)) . '</td>';
                                    echo '</tr>';
                                    $i++;
                                }
                            } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    let selector = $("#estado");
    let direccion = $('#dir');
    let nombre = $('#sede');
    let bot = $('#lalo');


    var table = $("#table").DataTable({
        order: [
            [0, 'asc']
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

    selector.change(function () {
        $("#estado option:selected").each(function () {
            let valor = $(this).val();

            if (valor != 0) {
                direccion.attr("disabled", false);
                nombre.attr("disabled", false);
            } else {
                direccion.attr("disabled", true);
                nombre.attr("disabled", true);
                bot.attr("disabled", true);
            }
        });
    });

    $('input[type=text]').keyup(function (s) {

        if (direccion.val().length > 5 && nombre.val().length > 5) {
            bot.attr("disabled", false);
        } else {
            bot.attr("disabled", true);
        }

    })

    bot.click(function (e) {
        e.preventDefault();

        $.confirm({
            title: '',
            content: "<h5 class='text-center'>¿Esta seguro de agregar esta SEDE? <h5><br><h6 class='text-center'>no podra eliminarlo mas tarde</h6>",
            buttons: {
                bue: {
                    text: "si, estoy seguro",
                    btnClass: "btn-success",
                    action: function () {
                        $.ajax({
                            url: "../php/upload/componentSede.php",
                            type: "post",
                            data: {
                                sede: nombre.val(),
                                estado: selector.val(),
                                direccion: direccion.val()
                            },
                            success: function (cc) {
                                notie.setOptions({
                                    alertTime: 2
                                });
                                if (cc == "success") {
                                    setTimeout(() => {
                                        bot.html("agregar");
                                        bot.attr("disabled", false);
                                        $("#cargo").val(""); // limpiar input

                                        notie.alert({
                                            type: 1,
                                            text: 'Se agrego el cargo correctamente',
                                            time: 3
                                        });
                                        
                                    }, 400);
                                } else if (cc == "dupli") {
                                    setTimeout(() => {
                                        bot.html("agregar");
                                        bot.attr("disabled", false);

                                        notie.alert({
                                            type: 3,
                                            text: 'Cargo duplicado',
                                            time: 3
                                        });
                                    }, 400);
                                } else {
                                    setTimeout(() => {
                                        bot.html("agregar");
                                        bot.attr("disabled", false);

                                        notie.alert({
                                            type: 3,
                                            text: cc,
                                            time: 3
                                        });
                                    }, 400);
                                }

                            }
                        });
                    }
                },
                car: {
                    text: "no, cancelar",
                    btnClass: "btn-danger",
                    action: function () {
                        bot.html("agregar");
                        bot.attr("disabled", false);
                    }
                }
            }
        });
    });
</script>
<style>
    .grid-containerr>div {
        margin: 1.5rem;
        background-color: var(--bg-conten-color);
        text-align: center;
        padding: 20px 0;
        border-radius: 10px;
    }

    .grid-containerr>div .btn {
        height: 3rem;
        box-shadow: 0px 2px 0 0px #00000054;
    }

    label {
        color: #e7e7e7;
    }
</style>

<?php require "../layout/footer.php" ?>