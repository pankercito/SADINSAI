<div class="romate">
    <form enctype="multipart/form-data" action="test2.php" method="post" id="caro" >
        <div class="second">
            <label for="nameArchive" class="p-10px">Nombre:</label>
            <input id="nameArchive" name="nameArchive" value="">
        </div>
        <div class="one">
            <label for="inpArch" class="selectLabel btn btn-success">Seleciona un archivo</label>
            <input class="file-select d-none" id="inpArch" name="inpArch" type="file" required>
        </div>
        <div class="second">
            <label for="textArchive" class="p-10px">Nota:</label>
            <input id="textArchive" name="textArchive" placeholder="(opcional)">
            <input class="d-none" type="text" name="ciArch" id="ciArch" value="<?php echo $_GET['carga']?>"> 
            <input class="d-none" type="text" name="gestionArch" id="gestionArch" value="<?php echo $_GET['gestion']?>"> 
        </div>
        <button type="submit" class="btn btn-success" >subir</button>
    </form>
</div>