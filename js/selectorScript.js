$(document).ready(function(){
    $("#Estados").on('change', function () {
        $("#Estados option:selected").each(function () {
            var id_estado = $(this).val();
            $.post("../php/citys.php", { estado: id_estado }, function(data) {
                $("#Ciudades").html(data);
            });			
        });
   });
});