// EIKER
// LLENA EL FORMULARIO PARA CAMBIAR EL CARGO (GESTIÓN DE USUARIO)
function cambioCargo_ind(){
    // TOMAR VALOR DE UNA COLUMNA DE UNA TABLA
    $('#body-cargo').on('click','tr',function(){
        nroCI=$(this).find('td').eq(1).text();
        cargo = $(this).find('td').eq(4).text();

    var parametros =
        {
            "nroCI": nroCI,
            "cargo": cargo,
            "que_buscar": "4"
        };
        $.ajax({
            data: parametros,
            dataType: 'json',
            url: '../php/consultar_cod.php',
            type: 'POST',
    
            beforeSend: function()
            {
                $('.ocultar-spinner').show(2);
                $('.ocultar-class').hide();


            },
            error: function(jqXHR, xhr, status, error)
            {
               var nroERROR = jqXHR.status;

                alert("Estatus " + status)


                // $('#tabla_usuarios').removeClass('ocultar-div');
                // $('#formulario_mostrar_Cam').addClass('ocultar-div');
                // $('#mostrar_mensaje_ci').addClass('ocultar-div');


                $('.ocultar-class').hide();
            },
            complete: function()
            {
                $('.ocultar-spinner').hide(2);
                $('.ocultar-class').show(2);                   
            },
    
            success: function(valores)
            {
                // alert("llego");
                
                $('#formulario_mostrar_Cam').removeClass('ocultar-div');
                $('#mostrar_mensaje_ci').addClass('ocultar-div');
                $('#tabla_usuarios').addClass('ocultar-div');

                $("#cedula_usr").prop("disabled", true);


                // INFORMACIÓN DEL EQUIPO
                $("#nombreCargo").val(valores.nombreCargo);
                $("#cedulaCargo").val(valores.cedulaCargo);
                $("#usuarioCargo").val(valores.usuarioCargo); 
                $("#id_dep").val(valores.id_dep); 
                $("#cargoID").val(valores.cargoID); 
                $("#cargoOrig").val(valores.cargoOrig); 

                $("#nombre_dpto").val(valores.nombre_dpto);    
                $("#nombre_div").val(valores.nombre_div);    
                $("#nombre_dire").val(valores.nombre_dire);    

            }
        });

    });

}