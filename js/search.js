//filtro de busqueda de estados
function FiltroEstado(){
    var input = document.getElementById("estadosSearch");//id del input de busqueda
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
            rows[i].style.display = "";
        }
    }
} 

//filtro de busqueda de Solicitudes - admin
function FiltroAdmin(){
    var input = document.getElementById("adminSearch");//id del input de busqueda
    var filter = input.value.toLowerCase();

    if (filter !== '') {
        // Obtener la tabla por su clase
        var table = document.querySelector(".admin-table");
        // Obtener todas las filas de la tabla
        var rows = table.getElementsByTagName("tr");

        // Iterar sobre todas las filas de la tabla
        for (var i = 1; i < rows.length; i++) {
            var row = rows[i];
            var cells = row.getElementsByTagName("td");
            var matchFound = false;

            // Iterar sobre celdas de la fila
            for (var j = 0; j <=5; j++) {
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
        var rows = document.querySelectorAll(".admin-table tr");
        for (var i = 1; i < rows.length; i++) {
            rows[i].style.display = "";
        }
    }
}

//filtro de busqueda de Solicitudes - User
function FiltroUser(){
    var input = document.getElementById("userSearch");//id del input de busqueda
    var filter = input.value.toLowerCase();

    if (filter !== '') {
        // Obtener la tabla por su clase
        var table = document.querySelector(".user-table");
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
        var rows = document.querySelectorAll(".user-table tr");
        for (var i = 1; i < rows.length; i++) {
            rows[i].style.display = "";
        }
    }
} 
