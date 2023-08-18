<div class="romate">
    <form enctype="multipart/form-data" method="post" id="caro">
        <div class="one">
            <div class="second">
                <label for="nameArchive" class="p-10px">Nombre:</label>
                <input id="nameArchive" name="nameArchive" value="">
            </div>
            <label for="inpArch" class="selectLabel btn btn-success">Seleciona un archivo</label>
            <input accept="image/png, image/jpeg, application/pdf" class="file-select d-none" id="inpArch"
                name="inpArch" type="file" required>
            <div class="second">
                <label for="textArchive" class="p-10px">Nota:</label>
                <input id="textArchive" name="textArchive" placeholder="(opcional)">
                <input class="d-none" type="text" name="gestionArch" id="gestionArch"
                    value="<?php echo $_GET['gestion'] ?>">
                <input class="d-none" type="text" name="ciArch" id="ciArch" value="<?php echo $_GET['carga'] ?>">
            </div>
        </div>
        <div class="center img">
            <img src="../recursos/doc.png" alt="doc" id="docImg" />
        </div>
        <button type="submit" class="btn btn-success">subir</button>
    </form>
    <script src="../js/gestionCarga.js"></script>
    <style>
        .one {
            margin: 0rem 20rem 0rem 1rem;
        }

        .center.img {
            position: absolute;
            margin: -15rem 0rem 5rem 27.5rem;
        }

        img#docImg {
            border-radius: 1pc;
            border: 1px solid;
            width: 12rem;
        }

        span.jconfirm-title {
            margin: 1rem;
        }

        input#nameArchive {
            padding: 0 10px;
            border: none;
            border-bottom: 1px solid #6ba870;
        }

        input#textArchive {
            padding: 0 10px;
            border: none;
            border-bottom: 1px solid #6ba870;
        }

        .p-10px {
            padding: 10px;
        }

        .second {
            margin: 2rem;
        }

        form#caro {
            text-align: center;
        }
    </style>
</div>