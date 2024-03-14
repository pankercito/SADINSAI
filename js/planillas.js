function planillaSelect(planilla) {
    var vermole = document.getElementById("planillas");
    
    vermole.innerHTML = `<div class="d-flex justify-content-center">
                                                            <div class="spinner-border my-3" role="status">
                                                                <span class="visually-hidden">procesando...</span>
                                                            </div>
                                                      </div>`;

    $.ajax({
        data: { "planilla": planilla },
        url: "../layout/planillas/planillaSelect.php",
        type: "post",
        success: function (params) {
            vermole.innerHTML = params;

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

$(document).ready(function () {
    $('.noCard').addClass('d-none');
})