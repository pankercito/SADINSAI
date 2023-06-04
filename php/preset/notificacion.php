<script>
// Obtener el mensaje de la notificación desde PHP
let mensaje = "<?php echo $_SESSION["noti"];?>";

if(mensaje == 1){
    // Mostrar el mensaje en el contenedor
	document.getElementById("notificacion").innerHTML = "Su solicitud a sido procesada con exito";
	
    let notificacion = document.getElementById("notificacion");

    // Hacer la animación de entrada de la notificación
    setTimeout(function() {
        notificacion.style.transform = "translateX(102%)";
    }, 500)

    // Hacer la animación de salida de la notificación
    setTimeout(function() {
        notificacion.style.transform = "translateX(-102%)";
    }, 4000);

    // Ocultar la notificación después de la animación de salida
    setTimeout(function() {
        notificacion.style.display = "none";
    }, 5000);
	<?php $_SESSION["noti"] = 0;?>
}else{
	document.getElementById("notificacion").style.display = "none";
}
</script>