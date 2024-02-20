<?php require_once "../php/sesionval.php"; ?>

<?php require "../php/adp.php"; ?>

<?php require "../layout/head.php"; ?>

<?php require "../layout/navbar.php"; ?>

<link rel="stylesheet" href="../styles/pdashboard.css">
<script src="../js/prestablecer.js"></script>

<!--SALUDO DE BIENVENIDA-->
<?php include "../layout/sidebar.php" ?>
<script>
    $(document).ready(function () {
        setTimeout(() => {
            soliste();
        }, 1000);
    });
</script>
<div class="estructur-conten">
    <div class="grid-containerr">
        <div class="cuerpo">
            <div class="principal row mx-1 mb-4 justify-content-center" id="centro">
                <div class="col">
                    <?php
                    include "../php/function/getUser.php";
                    include "../php/class/classIncludes.php";
                    $useraudios = new GestionDeUsuarios();
                    $estadistica = new Estadistica;
                    ?>

                    <p style="margin-bottom: 0;">Acciones</p>
                    <button class="pedit pnomina btn btn-primary"
                        onclick="location.replace('perfil.php?perfil=<?php echo $wci ?>');">mi perfil</button>
                    <br>
                    <button class='pedit btn btn-warning mb-3' id="genReport">generar reporte</button>
                    <p style="margin-bottom: 5px;">Usuarios activos</p>
                    <div class="col" style="overflow-y: auto;     max-height: 12.3rem;">
                        <ul class="userUl col-md-7 mx-auto">
                            <?php
                            //imprime una lista con usuarios activos y no activos
                            $us = $useraudios->usersActives();
                            foreach ($us as $us) {
                                $dot = ($us['active'] == 1) ? "<i class='bi bi-dot active'></i>" : "<i class='bi bi-dot'></i>";
                                echo "<li class='user'><a class='aUser' href='perfil.php?perfil=" . $us['ci'] . "'>" . $dot . $us['user'] . " </a></li>";
                            }
                            ?>
                        </ul>
                    </div>

                </div>
                <div class="col-md-7">
                    <div id="canvasconten">
                        <canvas id="dashboard"></canvas>
                    </div>
                </div>
                <div class="col">
                    <div class="bg-color-stats d-flex flex-column justify-content-around alert">
                        <h5 style="margin-bottom: 0;">informacion extra</h5>
                        <hr>
                        <p id="prom" style="font-size: 14px !important; color: #212529;">promedio semanal de
                            gestiones realizadas: %s</p>
                        <p id="prem" style="font-size: 14px !important; color: #212529;">promedio semanal de archivos
                            agregados: %s
                        </p>
                        <p id="prim" style="font-size: 14px !important; color: #212529;">promedio semanal de inicios de
                            sesion: %s
                        </p>
                    </div>
                </div>
            </div>
            <hr class="alert alert-light">
            <!-- stats -->
            <div class="mb-2 mt-4 row mx-1 justify-content-center">
                <div class="bg-color-stats mx-1 d-flex flex-wrap col-md-6 justify-content-around alert">
                    <div class="concan text-star">
                        <canvas id="solicitudes" class="mb-4"></canvas>
                    </div>
                    <div class="alert-content">
                        <h5>detalles de gestiones del dia</h5>
                        <hr>
                        <div class="text-star table-responsive-sm">
                            <table class=" table table-borderless">
                                <tbody>
                                    <?php
                                    $r = $estadistica->gestionDetailstStats(date('y-m-d'));

                                    $tipoSolic = [
                                        "0" => "ingreso de personal",
                                        "1" => "edicion de datos",
                                        "2" => "ingreso de archivo",
                                        "3" => "eliminacion de archivo"
                                    ];

                                    foreach ($r as $r) {
                                        echo
                                            '<tr>
                                                <td class="text-start">
                                                    <h6>' . $tipoSolic[$r['tipo']] . '</h6>
                                                </td>
                                                <td></td>
                                                <td>
                                                    <h6>' . $r['count'] . '</h6>
                                                </td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="bg-color-stats col alert">
                    <h5>ingresos de usuarios del dia</h5>
                    <hr>
                    <div class="alert-content text-center ">
                        <div class="bg-color-stats table-responsive-sm">
                            <table class="table table-borderless">
                                <tbody>
                                <tbody>
                                    <?php
                                    $r = $estadistica->userInixStats(date('Y-m-d'));

                                    if (count($r) != 0) {
                                        foreach ($r as $r) {
                                            echo
                                                '<tr>
                                            <td class="text-start">
                                                <h6 class="ms-4 mb-0">' . $r['user'] . '</h6>
                                            </td>
                                            <td></td>
                                            <td>
                                                <h6 class="ms-2">' . $r['count'] . '</h6>
                                            </td>
                                        </tr>';
                                        }
                                    } else {
                                        echo "<h6>ningun usuario a iniciado sesion hoy</h6> ";
                                    }
                                    ?>
                                </tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="bg-color-stats col mx-1 alert">
                    <h5>archivos agregados en la semana</h5>
                    <hr>
                    <div class="alert-content text-center ">
                        <div class="bg-color-stats table-responsive-sm">
                            <table class="table table-borderless">
                                <tbody>
                                <tbody>
                                    <?php
                                    $dat = rangoFechas(); //rango de fechas semanal automatico
                                    
                                    function total($array)
                                    {
                                        foreach ($array as $key => $value) {
                                            @$total .= $value['count'] . '-';
                                        }
                                        $cadena = $total;
                                        // Convertimos la cadena en un array de números
                                        $numeros = explode("-", $cadena);
                                        // Declaramos una variable para almacenar la suma
                                        $suma = 0;
                                        // Iteramos sobre el array de números
                                        foreach ($numeros as $numero) {
                                            // Convertimos cada número a un número entero
                                            $numeroEntero = intval($numero);
                                            // Sumamos el número al acumulado
                                            $suma += $numeroEntero;
                                        }
                                        return $suma;
                                    }

                                    $d = $estadistica->archivesDetailsStats($dat['lunes'], $dat['domingo']);

                                    echo '<h6>total de archivos: ' . @total($d) . '</h6>';

                                    $r = $conn->query("SELECT * FROM tiposarch");

                                    while ($tori = $r->fetch_object()) {
                                        $t[$tori->id_tipo] = $tori->nombre_tipo_arch;
                                    }

                                    foreach ($d as $row) {
                                        // Agrega las celdas a la tabla
                                        echo "<tr class='text-start ps-4 ms-2'>";
                                        echo "<td class='px-4 ms-5'>" . $t[$row['tipo']] . "</td>";
                                        echo "<td>" . $row['count'] . "</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2 mt-4 row mx-1 justify-content-center">
                <div class="bg-color-stats mx-1 d-flex flex-wrap col justify-content-around alert">
                    <div class="concan text-star">
                        <canvas id="solicitudesProm" style="width: 30rem!importan;"></canvas>
                    </div>
                    <div class="alert-content">
                        <h5>promedio de aceptacion de solicitudes</h5>
                        <hr>
                        <div class="text-star table-responsive-sm">
                            <p class="panel-color" id="total">total de solicitudes: %s</p>
                            <table class=" table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="text-start">
                                            <h6>aceptadas</h6>
                                            <h6>rechazadas</h6>
                                            <h6>anuladas</h6>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h6 id="aceptadas">%s</h6>
                                            <h6 id="rechazadas">%s</h6>
                                            <h6 id="anuladas">%s</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <p class="subtitulo">no se toman en cuenta solicitudes pendientes</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-2 mt-4 row mx-1 justify-content-center">
                <div class="bg-color-stats mx-1 d-flex flex-wrap col justify-content-around alert">
                    <div class="alert-content">
                        <h5>promedio de aceptacion de gestiones</h5>
                        <hr>
                        <div class="text-star table-responsive-sm">
                            <p class="panel-color" id="totalG">total de gestiones: %s</p>
                            <table class=" table table-borderless">
                                <tbody>
                                    <tr>
                                        <td class="text-start">
                                            <h6>aceptadas</h6>
                                            <h6>rechazadas</h6>
                                            <h6>anuladas</h6>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <h6 id="aceptadasG">%s</h6>
                                            <h6 id="rechazadasG">%s</h6>
                                            <h6 id="anuladasG">%s</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr>
                            <p class="subtitulo">no se toman en cuenta gestiones pendientes</p>
                        </div>
                    </div>
                    <div class="concan text-star">
                        <canvas id="gestionesProm" style="width: 30rem!importan;"></canvas>
                    </div>

                </div>
            </div>
            <div class="mb-2 mt-4 row mx-1 justify-content-center">
                <div class="bg-color-stats col mx-1 alert">
                    <h5>movimientos de usuarios</h5>
                    <hr>
                    <div class="col-md-11 mx-auto">
                        <div class="col-md-4 col-sm-12 mx-auto justify-content-center row flex-row">
                            <div class="col-8 col-sm-12 mx-1 d-flex mb-3">
                                <div class="col mx-1">
                                    <datalist id="datalist">
                                        <?php

                                        $r = $useraudios->usersActives();

                                        foreach ($r as $key) {
                                            echo "<option value='" . strtoupper($key['user']) . "'>" . strtoupper($key['user']) . " </option>";
                                        }

                                        ?>
                                    </datalist>
                                    <label for="list">usuario</label>
                                    <input type="list" list="datalist" class="form-select" id="list"
                                        placeholder="Selecciona un usuario">

                                </div>
                                <div class="col mx-1">
                                    <label for="tipo_movi">tipo de movimientos</label>
                                    <select id="tipo_movi" class="form-select">
                                        <option value="">seleccione un tipo</option>
                                        <?php
                                        $tipoMovi = [
                                            "1" => "ingreso de personal",
                                            "2" => "edicion de datos",
                                            "3" => "ingreso de archivo",
                                            "4" => "eliminacion de archivo",
                                            '5' => 'registro de usuario',
                                            '6' => 'activación/desactivación de usuario',
                                            '7' => 'cambio de locacion de archivo',
                                            '8' => 'rezacho de gestion',
                                            '9' => 'aceptacion de solicitud',
                                            '10' => 'rezacho de solicitud',
                                            '11' => 'requerimientos'
                                        ];

                                        foreach ($tipoMovi as $key => $value) {
                                            ?>
                                            <option value="<?php echo $value ?>">
                                                <?php echo $value ?>
                                            </option>
                                            <?php
                                        }

                                        ?>
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-5 col-sm-6 mx-1 mb-3">
                                <label for="min">desde</label>
                                <input type="text" id="min" class="form-control" placeholder="aa-mm-dd">
                            </div>
                            <div class="col-md-5 col-sm-6 mx-1 mb-3">
                                <label for="max">hasta</label>
                                <input type="text" id="max" class="form-control" placeholder="aa-mm-dd"">
                            </div>
                        </div>
                        <table class=" table table-info tabla-borderless" id="movimientos">
                                <thead class="mb-3">
                                    <tr>
                                        <th scope="col">N°</th>
                                        <th scope="col">USUAIO</th>
                                        <th scope="col">TIPO</th>
                                        <th scope="col">MOVIMIENTOS</th>
                                        <th scope="col">DETALLES</th>
                                        <th scope="col">FECHA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $precarInf = $conn->query("SELECT * FROM auditoria a INNER JOIN registro r ON r.id_usuario = a.id_usuario_audi  ORDER BY fecha_audi DESC");

                                    $i = 1;
                                    while ($d = $precarInf->fetch_object()) {
                                        if (!empty($d)) {
                                            echo '<tr class="">';
                                            echo '<td>' . $i++ . '</td>';
                                            echo '<td>' . $d->user . '</td>';
                                            echo '<td>' . $tipoMovi[$d->tipo_movi] . '</td>';
                                            echo '<td>' . $cambios = (strpos($d->cambios, " -- ") != false) ? substr($d->cambios, 0, strpos($d->cambios, " -- ")) . '...' : $d->cambios . '</td>';
                                            $dis = (strpos($d->cambios, "--") == false) ? 'disabled' : '';
                                            echo '<td> <a class="btn btn-success ' . $dis . '" ' . $dis . ' onclick="detalleMovi(' . $d->id . ')">detalle</a> </td>';
                                            echo '<td>' . date('Y-m-d H:i', strtotime($d->fecha_audi)) . '</td>';
                                            echo '</tr>';

                                        } else {
                                            echo '<h6>no hay registros</h6>';
                                        }
                                    }
                                    ?>
                                </tbody>
                                </table>
                            </div>
                            <script type="text/javascript">

                                $(document).ready(function () {
                                    // Create date inputs
                                    var minDate = new DateTime('#min', {
                                        format: 'YYYY-MM-DD HH:MM',
                                    });

                                    var maxDate = new DateTime('#max', {
                                        format: 'YYYY-MM-DD HH:MM',
                                    });

                                    // Custom filtering function which will search data in column four between two values
                                    DataTable.ext.search.push(function (settings, data, dataIndex) {
                                        const min = minDate.val();
                                        const max = maxDate.val();
                                        const date = new Date(data[5]);

                                        if (
                                            (min === null && max === null) ||
                                            (min === null && date <= max) ||
                                            (min <= date && max === null) ||
                                            (min <= date && date <= max)
                                        ) {
                                            return true;
                                        }
                                        return false;
                                    });

                                    // accion en desde
                                    $('#min').on('change', function () {
                                        moviT.draw();
                                    });

                                    // accion en hasta
                                    $('#max').on('change', function () {
                                        moviT.draw();
                                    });

                                    //filtro de usuario

                                    var usernameEl = $('#list');

                                    DataTable.ext.search.push(function (settings, data, dataIndex) {
                                        var username = data[1]; // use data for the username column

                                        if (
                                            (usernameEl.val() === '' || username.toLowerCase().includes(usernameEl.val().toLowerCase()))
                                        ) {
                                            return true;
                                        }

                                        return false;
                                    });
                                    // accion en user
                                    $('#list').on('input', function () {
                                        moviT.draw();
                                    });

                                    // filtro de tipo
                                    var tipo = $('#tipo_movi');

                                    DataTable.ext.search.push(function (settings, data, dataIndex) {
                                        var nombre = data[2]; // use data for the username column

                                        if (
                                            (tipo.val() === '' || nombre.includes(tipo.val()))
                                        ) {
                                            return true;
                                        }

                                        return false;
                                    });
                                    // accion en user
                                    $('#tipo_movi').on('change', function () {
                                        moviT.draw();
                                    });

                                });

                                var moviT = $('#movimientos').DataTable({
                                    "processing": false,
                                    "scrollY": 370,
                                    dom: "<'row' <'col-md-12 d-flex flex-row-reverse'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",
                                    buttons: [
                                        {
                                            extend: 'pdf', titleAttr: 'Exportar a PDF', text: '<i class="bi bi-filetype-pdf" aria-hidden="true"></i> Exportar', className: 'ecport', exportOptions: { columns: [0, 1, 2, 3, 5] },
                                            /*Centra la tabla del PDF
                                             * customize: function (doc) {
                                                doc.content[1].margin = [100, 0, 100, 0] //left, top, right, bottom
                                            }*/
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
                            </script>
                        </div>
                    </div>
                </div>
                <style>
                    canvas#solicitudesProm {
                        width: 700px !important;
                        max-height: 200px !important;
                    }

                    canvas#gestionesProm {
                        width: 700px !important;
                        max-height: 200px !important;
                    }

                    .panel-color {
                        font-size: 15px;
                        color: #212529 !important;
                        font-weight: normal;
                    }

                    .subtitulo {
                        color: #a3a3a3;
                        font-size: 13px;
                        font-weight: normal;
                    }

                    .ecport {
                        background: #28a745 !important;
                        color: #fff !important;
                        border-radius: 7px !important;
                        border: none !important;
                    }

                    .ecport:hover {
                        background: #348747 !important;
                    }

                    tr {
                        vertical-align: -webkit-baseline-middle;
                    }
                </style>
            </div>
            <script src="../resources/import/Chart/chart.umd.js"></script>
            <script src="../js/dashboard.js"></script>
        </div>
        <?php require "../layout/footer.php" ?>