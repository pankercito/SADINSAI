function verify_user()
{
    let v_user = document.getElementById('user').value;
    
    $('#singup').attr('disabled','true');
    
    var parametros = {
        
        "verificar_usuarios": v_user
    
    };

    $.ajax({
        data: parametros,
        url:"php/user-check.php",
        type:"POST",

        beforeSend: function(){

            $('#singup').attr('disabled','false');
            
            $('#msjverify').html("Verificando...");
            
        },
        
        succes: function(msjv){
            $('#msjverify').html(msjv);
        },
        
        error: function(){
            $('#msjverify').html("Error al consultar datos");
        }

    });
}