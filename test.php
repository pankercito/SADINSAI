<?php

include("php/conx.php");
include("php\class\auditoria.php");
include("php/function/sumarhora.php");

$new = new auditoria();

$dat = rangoFechas();

?>
<p> rangoFechas <?php echo implode(" - ", $dat) . date("w")?></p>
<br>
<div class="" style="display:flex;">
    <?php
    var_dump($new->solicitudStats($dat['lunes'], $dat['domingo']));
    ?>
</div>
<div class="" style="display:flex;">
    <?php
    var_dump($new->userStats($dat['lunes'], $dat['domingo']));
    ?>
</div>
