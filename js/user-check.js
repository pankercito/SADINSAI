$(document).ready(function() {    
    $('#user').blur(function(){
    
    $('#Info').html('<img src="loader.gif" alt="" />').fadeOut(1000);

    var cedula = $(this).val();        
    var dataString = 'cedula='+cedula;

    $.ajax({
        type: "POST",
        url: "?users/register-two=true",
        data: dataString,
        success: function(data) {
            $('#singup').fadeIn(1000).html(data);
        }
    });
});                       
});    