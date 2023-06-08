// Obtener el mensaje de la notificación desde PHP
var mensaje = "<?php echo $_SESSION['noti'];?>";

if(mensaje == 1){// Mostrar el mensaje en el contenedor
    document.getElementById("notificacion").innerHTML = mensaje
    // Ocultar la notificación después de 2 segundos
    setTimeout(function() {
        document.getElementById("notificacion").style.display = "none";
    }, 20000);
    <?php $_SESSION['noti'] = 0;?>
}else{

}