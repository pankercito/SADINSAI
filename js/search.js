//filtro de busqueda de estados
function searching(e) {

    let input = document.getElementById("searchbar").value; //id del input de busqueda;
    let lista = document.getElementById("resultList"); //id del input de busqueda;
    let divResult = document.getElementById("result"); //id del input de busqueda;

    let keys = new FormData();

    keys.append("keys", input);

    if (input.length > 0) {
        $.ajax({
            data: keys,
            processData: false,
            contentType: false,
            url: "../php/searchBar.php",
            type: "post",
            success: function (params) {
                divResult.classList.remove("d-none");

                if (jeisonXD(params)) {

                   let newlist = JSON.parse(params);

                   lista.innerHTML = newlist.join(" ");

                } else {
                    lista.innerHTML = "sin resultados";
                }
            }
        });
    } else {
        divResult.classList.add("d-none");
    }
}