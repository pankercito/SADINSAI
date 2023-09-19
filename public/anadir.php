<?php require_once("../php/sesionval.php"); ?>

<?php require("../layout/head.php"); ?>

<?php
include("../layout/navbar.php");

if ($_SERVER['REQUEST_URI'] == "/sadinsai/public/anadir.php") {
    echo "<style>section.footer.col-lg-12 {
      position: fixed;
      bottom: 0;
   }</style>";
}
?>

<link rel="stylesheet" href="../styles/regiform.css">
<link rel="stylesheet" href="../styles/anadir.css">
<link rel="stylesheet" href="../styles/background.css">

<section name="cromaconten">
    <div class="contencroma">
        <?php
        include("../layout/sidebar.php");
        ?>
    </div>
</section>


<div class="structur-conten">
    <div class="first row">
        <div class="fixed col-3">
            <div class="fijo contenido">
                <p>Personal</p>
                <div class="botones">
                    <a class="añadir btn btn-primary" type="button" href="?form=true">
                        <i class="bi bi-person-add"></i> Agregar personal
                    </a>
                    <?php
                    if ($adpval == TRUE) {
                        include('../layout/accsadmin.php');
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="conten col-9">
            <div class="contenido">
                <p>Contenido</p>
                <?php
                include('../php/preset/seleccionAnadir.php');
                ?>
            </div>
        </div>
    </div>
</div>

<?php require("../layout/footer.php"); ?>