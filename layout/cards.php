<link rel="stylesheet" href="../styles/cards.css">

<?php

$i = 0;
while ($row = $sql->fetch_assoc()) {
    $id = $row['id_archivo'];
    $image = $row['d_archivo'];
    $ubicatinFis = $row['dir_nombre'];
    $nameSet = $row['nombre_arch'];

    $tipoDarch = reverse($row['nombre_arch']);

    if (strlen($nameSet) > 15) {
        $q = 1;
        $name = substr($nameSet, 0, 15) . "...";
    } else {
        $q = 0;
        $name = $nameSet;
    }

    $f = ($q == 1) ? $nameSet : "";
    $fecha = $row['fecha'];
    $note = ($row['nota'] == '') ? "sin nota" : $row['nota'];
    $userName = '<a href="perfil.php?perfil=' . encriptar($row['ci']) . '">' . getUserHash($row['id_emisor']) . '</a>';
    $c = ($row['size'] / 1024);
    $size = ($c <= 920) ? number_format($c, 2) . "KB" : number_format($c / 1024, 2) . "MB";

    $d = ($tipoDarch != "pdf") ? '<img class="card__image" src="' . @$image . '" alt="fotos" width="298" height="223.5"/>'
        : '<embed src="' . @$image . '"  title="' . @$name . '" width="298" height="223.5"  frameborder="0" allowfullscreen scrolling="no" style="overflow: hidden;"></embed>';

    // imprimir las card 
    ?>
    <div class="card">
        <div class="card__image-holder">
            <?php echo @$d ?>
        </div>
        <div class="card-title">
            <a href="#conteni<?php echo @$i ?>" class="toggle-info btn btn-success">
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
                <div class="row justify-content-center align-items-center g-2 mb-3"
                    style="background:none; padding: 0 0 0 0;">
                    <div class="col" style="color: #282c30;  text-align:start;">
                        <p>Nota:
                            <br>
                            <?php echo @$note ?>
                        </p>
                    </div>
                    <div class="col" style="color: #282c30; text-align:start; font-size:12px;">
                        <p>
                            ubicacion:
                            <br>
                            <?php echo @$ubicatinFis ?>
                        </p>
                    </div>
                </div>
                <div class="strContent justify-content-center d-flex mx-auto">
                    <p class="str text-center mx-2" style="margin: 0;">subido por
                        <?php echo @$userName ?>
                    </p>
                    <span class="c"> | </span>
                    <p class="str text-center mx-2">tamaño
                        <?php echo @$size ?>
                    </p>
                </div>
            </div>
            <div id="conteni<?php echo @$i ?>" class="card-flap flap2">
                <div class="card-actions">
                    <a href="<?php echo @$image ?>" class="btn btn-success" download="<?php echo @$nameSet ?>">descargar</a>
                    <a class="btn btn-danger" onclick=" deleteCar(<?php echo @$id ?>)">eliminar</a>
                    <a class="btn btn-secondary mb-1 mt-2" onclick="cambiarUb(<?php echo @$id ?>)">cambiar ubicacion</a>
                </div>
            </div>
        </div>
    </div>
    <?php
    $i++;
}

?>
<style>
    section.footer.col-lg-12 {
        position: fixed;
        bottom: 0;
    }
</style>
<script src="../js/cards.js"></script>