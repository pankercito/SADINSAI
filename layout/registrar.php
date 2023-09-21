<?php
require("../php/adp.php");
?>
<link rel="stylesheet" href="../styles/regiform.css">
<div class="conten-regisform">
    <div class="progress " style="height: 3px; width: 30%;">
        <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
            aria-valuemax="100">
        </div>
    </div>
    <form method="post" action="../php/civerify.php" class="regisform" name="regisform" id="rgt" require>
        <div class="mx-auto mb-3 col-md-3 ">
            <label for="ci" class="form-label">Cedula</label>
            <input class="form-control" id="ci" type="number" name="cedula" placeholder="cedula" maxlength="8"
                onkeyup="verificarCI()" required>
            <small id="mensajeCi" class="form-text text-muted">ingrese la cedula para comprovacion</small>

        </div>
        <button id="singup" class="singup btn btn-lg btn-primary" type="submit" name="singup"
            disabled>Siguiente</button>
    </form>
</div>
<script src="../js/ciCheck.js"></script>