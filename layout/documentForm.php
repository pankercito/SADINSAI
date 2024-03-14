<?php

include "../php/configIncludes.php";

$p = new Empleado($_GET['c']);

?>
<div class="romate">
    <form enctype="multipart/form-data" method="post" id="caro">
        <div class="col row mx-auto justify-content-between">
            <div class="ms-3 col-5 ">
                <div class="col row">
                    <label for="ci" class="mt-3">Persona asignada:</label>
                    <input type="text" id="ci" class="d-none" name="ciArch" value="<?php echo $_GET['c'] ?>" readonly>
                    <input type="text" class="form-control" value="<?php echo "{$p->nombre} {$p->apellido}" ?>"
                        readonly>
                    <label for="tipo" class="mt-3">tipo de archivo:</label>
                    <input type="text" id="tipo" class="d-none" name="gestionArch" value="<?php echo $_GET['g'] ?>"
                        readonly>
                    <input type="text" class="form-control" value="<?php echo getNombreTipoArch($_GET['g']) ?>"
                        readonly>
                </div>
                <div class="col row">
                    <label for="nota" class="mt-3">Nota:</label>
                    <input id="nota" name="textArchive" class="form-control" placeholder="(opcional)">
                </div>
                <div class="col row">
                    <label for="Responsable" class="mt-3">Personal responsable:</label>
                    <input id="Presponsable" name="responsable" class="d-none" value="">
                    <input id="Responsable" class="form-control"
                        placeholder="Buscar, nombre y apellido / cedula de identidad" autocomplete="off">
                    <div class="d-none list-group" id="PersonDi">
                    </div>
                </div>
                <button id="veroff" class="btn btn-sm btn-success mt-3 mx-0">verificar personal</button>
                <div class="col row">
                    <label for="departament" class="form-label mt-3">Departamento responsable:</label>
                    <select class="form-select" name="departament" id="departament">
                        <option value="0">asignar un departamento</option>
                        <?php include "../php/preset/opcionesD.php"; ?>
                    </select>
                </div>
            </div>
            <div class="col">
                <span class="p-4"></span>
            </div>
            <div class="col-5">
                <label for="archName">Documento:</label>
                <div class="justify-content-center">
                    <input id="archName" class="form-control" name="nameArchive" value="">
                    <label for="arch" class="selectLabel btn btn-success btn-sm">Seleciona un archivo</label>
                    <input accept="image/png, image/jpeg, application/pdf" class="file-select d-none" id="arch"
                        name="inpArch" type="file" required>

                </div>
                <div class="col mx-auto my-4 justify-content-center">
                    <div class="img mx-auto" style="overflow-y: scroll; overflow-x: hidden;">
                        <img src="../resources/doc.png" alt="doc" id="docImg" width="200" height="200" />
                        <embed id="docPdf" src="" type="application/pdf" width="400" height="250" frameborder="0"
                            class="d-none" scrolling="no"></embed>
                    </div>
                </div>
            </div>
            <!-- tipo de solicitud -->
            <input class="d-none" type="text" value="2" name="tipo">
        </div>
    </form>
</div>