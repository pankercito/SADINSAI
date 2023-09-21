"use strict";

// VERIFICACION DEL FORM REGISTRO FASE 2
$(document).ready(function () {
  // Agregar un controlador de eventos para el evento cambio en input
  $('#user').keyup(function () {
    var user = $('#user');
    var pass = $('#pass');
    var vpass = $('#vpass');
    var pin = $('#pin');
    var cheki = $('#flexSwitch');
    var sing = $('#singup');
    var p = false;
    var u = false;

    if ($(this).val().match(/[0-9a-zA-Z]$/)) {
      document.getElementById("msjverify").innerHTML = "";

      if (user.val().length >= 5) {
        $.ajax({
          url: "../php/userCheck.php",
          data: {
            "user": user.val()
          },
          type: "post",
          success: function success(params) {
            switch (params) {
              case "success":
                document.getElementById("msjverify").innerHTML = "";
                user.removeAttr('disabled');
                pass.removeAttr('disabled');
                vpass.removeAttr('disabled');
                pin.removeAttr('disabled');
                cheki.removeAttr('disabled');
                sing.attr('disabled', 'true');
                u = true;
                break;

              case "exist":
                document.getElementById("msjverify").innerHTML = "este usuario esta en uso";
                u = false;
                pass.attr('disabled', 'true');
                vpass.attr('disabled', 'true');
                pin.attr('disabled', 'true');
                cheki.attr('disabled', 'true');
                sing.attr('disabled', 'true');
                break;

              default:
                document.getElementById("msjverify").innerHTML = "";
                u = false;
                pass.attr('disabled', 'true');
                vpass.attr('disabled', 'true');
                pin.attr('disabled', 'true');
                cheki.attr('disabled', 'true');
                sing.attr('disabled', 'true');
                break;
            }

            $('.form-control').keyup(function () {
              // minino de caracteres
              if (pass.val().length > 5) {
                // verificacion de igualdad
                document.getElementById("passmsj").innerHTML = "";

                if (pass.val() == vpass.val()) {
                  document.getElementById("vpassmsj").innerHTML = "";
                  p = true;
                } else {
                  document.getElementById("vpassmsj").innerHTML = "las contraseñas no coinciden";
                  p = false;
                }
              } else {
                document.getElementById("passmsj").innerHTML = "minimo 6 caracteres";
                sing.attr('disabled', 'true');
              } // activar boton 


              if (p == true && u == true && pin.val().length > 3) {
                sing.removeAttr('disabled');
              } else {
                sing.attr('disabled', 'true');
              }
            });
          }
        });
      } else if (user.val().length == 0) {
        document.getElementById("msjverify").innerHTML = "";
        pass.attr('disabled', 'true');
        vpass.attr('disabled', 'true');
        pin.attr('disabled', 'true');
        cheki.attr('disabled', 'true');
        sing.attr('disabled', 'true');
        u = false;
      } else {
        document.getElementById("msjverify").innerHTML = "minimo 5 caracteres";
        pass.attr('disabled', 'true');
        vpass.attr('disabled', 'true');
        pin.attr('disabled', 'true');
        cheki.attr('disabled', 'true');
        sing.attr('disabled', 'true');
        u = false;
      }
    } else {
      document.getElementById("msjverify").innerHTML = "no use caracteres especiales por favor";
      u = false;
      pass.attr('disabled', 'true');
      vpass.attr('disabled', 'true');
      pin.attr('disabled', 'true');
      cheki.attr('disabled', 'true');
      sing.attr('disabled', 'true');
    }
  });
}); //SWITCHVALIDATION

$(document).ready(function () {
  $('#flexSwitch').on('change', function () {
    if ($(this).is(":checked")) {
      var panel = $.confirm({
        title: "",
        content: "url:../layout/pinverify.php",
        onContentReady: function onContentReady() {
          var $maxlength = $('.form-masked-pin').attr('maxlength'); //bg.box agregacion

          $('.form-masked-pin').after('<div class="bg-box-group d-flex justify-content-center"></div>');

          for (var i = 0; i < $maxlength; i++) {
            $('.bg-box-group').append('<div class="bg-box"></div>');
          } //Used to ensure pin input cursor doesnt scroll when completed (that misaligns text and boxes)


          var t = $('input.form-masked-pin');
          t.keypress(function (event) {
            event.preventDefault();
            var reg = /\w/g; //Regex that you can change for whatever you allow in the input

            var inputChar = String.fromCharCode(event.which); //retreive the key pressed

            var inputLength = t.val().length; //retreive the input's value length

            if (reg.test(inputChar) && inputLength < $maxlength) {
              t.val(t.val() + inputChar); //if input length < maxlegtn, se añade el valor

              if (t.val().length == 4) {
                //if input length == 4 se ejecuta verificacion
                var inputValue = $('#unique-pin').val();
                $('#unique-pin').attr("disable", "true");
                $.ajax({
                  data: {
                    "pin": inputValue
                  },
                  url: "../php/verificarPin.php",
                  type: "post",
                  success: function success(VeriPin) {
                    switch (VeriPin) {
                      case "pin.success":
                        document.querySelector("#flexSwitch").checked = true;
                        document.getElementById("pinMsj").innerText = " vericacion correcta";
                        document.getElementById("pinMsj").style.color = "green";
                        $('.bg-box').attr('style', 'border-color: green; box-shadow: 0 0 0 0.055rem green;');
                        setTimeout(function () {
                          panel.close();
                        }, 1500);
                        break;

                      case "pin.error":
                        document.querySelector("#flexSwitch").checked = false;
                        document.getElementById("pinMsj").innerText = "pin incorrecto, intente otra vez";
                        document.getElementById("pinMsj").style.color = "red";
                        $('.bg-box').attr('style', 'border-color: red; box-shadow: 0 0 0 0.055rem rgba(255, 0, 0, 1);');
                        break;

                      default:
                        break;
                    }
                  }
                });
              } else {}
            } else {}
          });
        },
        buttons: {
          close: {
            text: "cerrar",
            action: function action() {
              document.querySelector("#flexSwitch").checked = false;
            }
          }
        }
      });
    }
  });
});