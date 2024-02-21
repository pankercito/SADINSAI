function planillaSelect(planilla) {
    $.ajax({
        data: { "planilla": planilla },
        url: "../layout/planillas/planillaSelect.php",
        type: "post",
        success: function (params) {
            document.getElementById("planillas").innerHTML = params;

            $(document).ready(function () {
                let boton = document.getElementById('verificar');

                boton.addEventListener('click', function (that) {
                    that.preventDefault();

                    const inputs = $('#plSolisData input');
                    let marc = new VerificarCampo();

                    $.each(inputs, function (index, input) {
                        let num = $(input).attr('type') == 'text' ? 3 : 1;
                        num = $(input).attr('type') == 'radio' ? 1 : num;

                        if ($(input).attr('class') != 'd-none') {
                            marc.add({
                                list: [[$(input)[0], num]],
                            });
                        }
                    });

                    marc.setBoton(document.getElementById('processing'));

                    marc.verify();
                });
            });
        }
    })
}