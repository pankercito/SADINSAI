<link rel="stylesheet" href="../styles/cards.css">

<?php

include("../php/preset/cardsPreset.php");

if ($count > 0) {
    for ($i = 0; $i < $count; $i++) {
        $row = mysqli_fetch_assoc($sql);

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

        // cambiar etiquetas segun tipos de archivo
        $d = ($tipoDarch != "pdf") ? '<img class="card__image" src="' . @$image . '" alt="fotos" width="298" height="223.5"/>'
            : '<iframe src="' . @$image . '" scrolling="yes"  title="' . @$name . '" width="298" height="223.5">documento</iframe>';
        
        // imprimir las card 
        ?>
        <div class="card">
            <div class="card__image-holder">
                <?php echo @$d ?>
            </div>
            <div class="card-title">
                <a href="#" class="toggle-info btn btn-success">
                    <span class="left"></span>
                    <span class="right"></span>
                </a>
                <div class="titleti" style="width: 16rem;
            padding: 10px 1rem 0 0;">
                    <h4 style="">
                        <?php echo @$name ?>
                    </h4>
                </div>
                <br>
                <div class="subtitle">
                    <small style="color: #7a7a7a;">Subido el
                        <?php echo @$fecha ?>
                    </small>
                </div>
            </div>
            <div class="card-flap flap1">
                <h6 class="mx-3">
                    <?php echo @$f ?>
                </h6>
                <div class="card-description">
                    <p>Nota:
                        <br>
                        <?php echo @$note ?>
                    </p>
                    <div class="strContent d-flex mx-auto">
                        <p class="str text-center" style="margin: 0;">subido por
                            <?php echo @$userName ?>
                        </p>
                        <span class="c"> | </span>
                        <p class="str text-center">tamaño
                            <?php echo @$size ?>
                        </p>
                    </div>
                </div>
                <div class="card-flap flap2">
                    <div class="card-actions">
                        <a href="<?php echo @$image ?>" class="btn btn-success" download="<?php echo @$f?>">descargar</a>
                        <a href="#" class="btn btn-secondary">Editar</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="noCard mx-auto text-center">
        <p>no hay documentos en esta seccion</p>
    </div>
    <?php
}
?>
<script src="../js/cards.js"></script>