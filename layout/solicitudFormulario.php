<div class="nuevasolicitud">
    <form action="../php/registroSolicitud.php" method="post">
        <div class="form-floating">
            <input type="number" class="soli form-control" id="sCi" name="sCi" placeholder="ci" onblur="verificarCI()">
            <label for="sCi">Cedula</label>
            <div class="msj" id="mensajeCi"></div>
        </div>
        <div class="form-floating">
            <input type="text" class="soli form-control" id="floatingMotiv" name="sMotivo" placeholder="motiv" required>
            <label for="floatingMotiv">Razon de la solicitud</label>
        </div>
        <button id="soli" type="submit" class="btn btn-primary" disabled>solicitar</button>
    </form>
</div>
<hr>
<script src="../js/checkCiSoli.js"></script>