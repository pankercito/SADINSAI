<link rel="stylesheet" href="../styles/cardOnly.css">

<?php

$row = $sql->fetch_assoc();

$id = $row['id_archivo'];
$image = $row['d_archivo'];
$ubicatinFis = $row['dir_nombre'];
$nameSet = $row['nombre_arch'];

$tipoDarch = reverse($row['nombre_arch']);

// if (strlen($nameSet) > 15) {
//     $q = 1;
//     $name = substr($nameSet, 0, 15) . "...";
// } else {
//     $q = 0;
//     $name = $nameSet;
// }

// $f = ($q == 1) ? $nameSet : "";

$fecha = $row['fecha'];
$note = ($row['nota'] == '') ? "sin nota" : $row['nota'];
$User = new User(getUserHash($row['id_emisor']));
$userName = '<a href="perfil.php?perfil=' . encriptar($row['ci']) . '">' . $User->usuario . '</a>';
$c = ($row['size'] / 1024);
$size = ($c <= 920) ? number_format($c, 2) . "KB" : number_format($c / 1024, 2) . "MB";

$d = ($tipoDarch != "pdf") ? '<img class="card__image" src="' . @$image . '" alt="fotos" width="298" height="223.5"/>'
    : '<embed src="' . @$image . '#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf" title="' . @$name . '" width="298" height="223.5"   frameborder="0" allowfullscreen scrolling="no" style="overflow: hidden;"></embed>';

// imprimir las card 
?>
<div class="card">
    <div class="card-image">
        <?php echo @$d ?>
    </div>
    <div class="card-content">
        <h5 class="mx-3">
            <?php echo @$nameSet ?>
        </h5>
        <div class="card-description mt-4">
            <div class="strContent justify-content-center d-flex mx-auto">
                <div class="col mx-1">
                    <p class="text-center" style="margin: 0;">nota:
                        <br>
                        <?php echo @$note ?>
                    </p>
                </div>
                <div class="col mx-1">
                    <p class="text-center">
                        ubicacion:
                        <br>
                        <?php echo @$ubicatinFis ?>
                    </p>
                </div>
            </div>
            <div class="strContent justify-content-center d-flex mx-auto mt-4">
                <p class="str text-center mx-2" style="margin: 0;">subido por
                    <?php echo @$userName ?>
                </p>
                <span class="c"> | </span>
                <p class="str text-center mx-2" style="margin: 0;">tamaño
                    <?php echo @$size ?>
                </p>
            </div>
            <hr>
            Subido el
            <?php echo @$fecha ?>
        </div>
        <div class="card-flap flap2">
            <div class="card-actions">
                <a href="<?php echo @$image ?>" class="btn btn-success mx-1 mt-3"
                    download="<?php echo @$nameSet ?>">descargar</a>
                <a class="btn btn-danger mx-1 mt-3" onclick=" deleteCar(<?php echo @$id ?>)">eliminar</a>
                <a class="btn btn-secondary mx-1 mt-3" onclick="cambiarUb(<?php echo @$id ?>)">cambiar ubicacion</a>
            </div>
        </div>
    </div>
</div>
<style>
    .cards a.btn {
        border-radius: 4px;
        box-shadow: 0 2px 0px 0 rgba(0, 0, 0, 0.25);
        color: #ffffff;
        display: inline-block;
        padding: 6px 30px 8px;
        position: relative;
        text-decoration: none;
        transition: all 0.1s 0s ease-out;
    }

    .str.text-center a {
        color: #198754;
        text-decoration: none;
    }

    .str.text-center a:hover {
        color: #198754;
        text-decoration: underline;
    }

    embed {
        height: 30rem;
    }

    .card-actions {
        margin: 2rem 0 0;
    }
</style>
<script src="../js/cards.js"></script>