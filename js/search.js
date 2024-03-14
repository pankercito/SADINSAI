//filtro de busqueda de estados
function searching(e) {

    let input = document.getElementById("searchbar"); //id del input de busqueda;
    let divResult = document.getElementById("result"); //id del input de busqueda;

    let keys = new FormData();

    keys.append("keys", input.value);



    divResult.innerHTML = `<div class="d-flex justify-content-center">
    <div class="spinner-border my-2" role="status">
        <span class="visually-hidden">procesando...</span>
    </div>
</div>`;


    divResult.classList.remove("d-none");

    if (input.value.length > 0) {
        $.ajax({
            data: keys,
            processData: false,
            contentType: false,
            url: "../php/searchBar.php",
            type: "post",
            success: function (params) {

                divResult.innerHTML = `<ul id="resultList">
                </ul>`;
                
                let lista = document.getElementById("resultList"); //lista;

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

    input.addEventListener("blur", function () {
        setTimeout(() => {
            divResult.classList.add("d-none");
        }, 100);
    });
}