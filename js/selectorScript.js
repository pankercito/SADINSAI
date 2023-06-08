//Selector de Ciudad segun Estado
$(document).ready(function(){
    $("#Estados").on('change', function () {
        $("#Estados option:selected").each(function () {
            var id_estado = $(this).val();
            // Agregar opción adicional
            $("#Ciudades").html('<option value="0">- Selecciona una ciudad -</option>');
            // Hacer la llamada AJAX
            $.post("../php/preset/citysForm.php", { estado: id_estado }, function(data) {
                $("#Ciudades").append(data);
            });			
        });
   });
});

//Selector de sede segun Estado
$(document).ready(function(){
    $("#Estados").on('change', function () {
        $("#Estados option:selected").each(function () {
            var id_estado = $(this).val();
            // Agregar opción adicional
            $("#Sede").html('<option value="0">- Selecciona una Sede -</option>');
            // Hacer la llamada AJAX
            $.post("../php/preset/sedesForm.php", { estado: id_estado }, function(data) {
                $("#Sede").append(data);
            });			
        });
   });
});