<script type="text/javascript">
    // Obtener el mensaje de la notificación desde PHP
    const mensaje = "<?php echo htmlspecialchars($_SESSION["noti"]); ?>";
    
    localStorage.setItem('activeSection', '5');
    
    if (window.onload){
        setTimeout(() => {
            notify(mensaje);
        }, 2000);
    }

    function notify(mensaje) {
        if (mensaje == 1) {
            // Mostrar el mensaje en el contenedor
            document.getElementById("notificacion").innerHTML = "Su solicitud a sido procesada con exito";

            let notificacion = document.getElementById("notificacion");

            // Hacer la animación de entrada de la notificación
            setTimeout(function () {
                notificacion.style.transform = "translateX(125%)";
            }, 500)

            // Hacer la animación de salida de la notificación
            setTimeout(function () {
                notificacion.style.transform = "translateX(-5%)";
            }, 3000);

            // Ocultar la notificación después de la animación de salida
            setTimeout(function () {
                notificacion.style.display = "none";
            }, 6000);
            
        } else {
            document.getElementById("notificacion").style.display = "none";
        }
    }
</script>

<?php $_SESSION["noti"] = 0; ?>