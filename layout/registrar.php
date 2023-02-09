<?php
    include("php/adp_1.php");
?>
<div class="col-lg-6">
    <div class="conten-regisform">
        <div class="progress " style="height: 3px; width: 30%;">
            <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
        </div>

        <form method="post" action="php/civerify.php" class="regisform"  name="regisform" id="rgt" require>
            <fieldset>
                <div class="form-group">
                    <legend>Cedula</legend>
                    <input type="int" name="cedula" placeholder="cedula" maxlength="8" required>
                </div>
            </fieldset>
            <?php
               require ("php/fallo.php");
            ?>
            <button type="submit" name="singup" class="btn btn-defaul">Siguiente</button>
        </form>
    </div>
</div>