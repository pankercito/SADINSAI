function FilterkeyWord_all_table(){
    var input = document.getElementById("search_input_all");
    var filter = input.value.toLowerCase();

    if (filter !== '') {
        // Obtener la tabla por su clase
        var table = document.querySelector(".sede-table");
        // Obtener todas las filas de la tabla
        var rows = table.getElementsByTagName("tr");

        // Iterar sobre todas las filas de la tabla
        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var cells = row.getElementsByTagName("td");
            var matchFound = false;

            // Iterar sobre la segunda y tercera celda de la fila
            for (var j = 2; j <= 3; j++) {
                var cellText = cells[j].textContent.toLowerCase();

                // Comprobar si el texto de la celda contiene la palabra buscada
                if (cellText.indexOf(filter) > -1) {
                    matchFound = true;
                    break;
                }
            }

            // Mostrar o ocultar la fila según si se encontró una coincidencia
            row.style.display = matchFound ? "" : "none";
        }
    } else {
        // Si el campo de búsqueda está vacío, mostrar todas las filas
        var rows = document.querySelectorAll(".sede-table tr");
        for (var i = 1; i < rows.length; i++) {
            rows[i].style.display ="";
        }
    }
}