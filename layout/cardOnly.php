<link rel="stylesheet" href="../styles/cardOnly.css">


<?php include("../php/preset/cardsPresetOnly.php") ?>
<?php
if (1 == $count && $count > 0) {
    $image = $row['direccion'];
    $nameSet = $row['nombre_archivo'];
    if (strlen($nameSet) > 15) {
        $q = 1;
        $name = substr($nameSet, 0, 15) . "...";
    } else {
        $q = 0;
        $name = $nameSet;
    }
    $f = ($q == 1) ? $nameSet : "";
    $fecha = $row['fecha'];
    $tipoDarch = $row['archivo'];
    $note = ($row['note'] == '') ? "sin nota" : $row['note'];
    $userName = '<a href="perfil.php?perfil=' . encriptar($row['ci']) . '">' . getUser($row['Id_user_sub'], "") . '</a>';
    $c = ($row['size'] / 1024);
    $size = ($c <= 920) ? number_format($c, 2) . "KB" : number_format($c / 1024, 2) . "MB";

    $d = ($tipoDarch != "pdf") ? '<img class="card__image" src="' . @$image . '" alt="foto de documento" width="298" height="223.5"/>'
        : '<iframe src="' . @$image . '" scrolling="yes"  title="' . @$name . '" width="298" height="223.5">documento</iframe>';

    ?>
    <div class="card">
        <div class="card-image">
            <?php echo @$d ?>
        </div>
        <div class="card-content">
            <h3>
                <?php echo @$name ?>
            </h3>
            <p>Fecha de creación:
                <?php echo @$fecha ?>
            </p>
            <p>Tamaño:
                <?php echo @$size ?>
            </p>
            <p>subido por:
                <?php echo @$userName ?>
            </p>
            <a href="<?php echo @$image ?>" class="card-button" download="<?php echo @$image ?>">descargar</a>
            <a href="" class="card-button">editar</a>
        </div>
    </div>
    <script type="text/javascript">
        document.getElementById('newDoc').setAttribute("disabled", true);
    </script>
    <?php
} else {
    ?>
    <div class="noCard mx-auto text-center">
        <p>no hay documentos en esta seccion</p>
    </div>
    <?php
    $conn->close();
}
?>