function planillaSelect(planilla) {
    $.ajax({
        data: {"planilla": planilla},
        url: "../layout/planillas/planillaSelect.php",
        type: "post",
        success: function (params) {
        document.getElementById("planillas").innerHTML = params;
        }        
    })
}