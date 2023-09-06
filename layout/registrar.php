<?php
require("../php/adp.php");
?>
<link rel="stylesheet" href="../styles/regiform.css">
<div class="conten-regisform">
    <div class="progress " style="height: 3px; width: 30%;">
        <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0"
            aria-valuemax="100"></div>
    </div>
    <form method="post" action="../php/civerify.php" class="regisform" name="regisform" id="rgt" require>
            <legend>Cedula</legend>
            
            <input id="ci" type="number" name="cedula" placeholder="cedula" maxlength="8" onblur="verificarCI()" required>
            <button id="singup" class="singup btn btn-lg btn-primary" type="submit" name="singup" disabled>Siguiente</button>
            <div id="mensajeCi"></div>
        </div>
    </form>
    <script src="../js/ciCheck.js"></script>
</div>