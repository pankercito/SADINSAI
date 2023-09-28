<?php

// Realizar la consulta
$query = "SELECT * FROM personal WHERE nombre LIKE '%$searchTerm%' OR apellido   LIKE '%$searchTerm%' OR ci = $searchTerm";
$results = $conn->query($query);

// Devolver los resultados
if ($results->num_rows > 0) {
    $users = array();
    while ($row = $results->fetch_assoc()) {
        $users[] = $row;
    }
    echo json_encode($users);
} else {
    echo "No se encontraron resultados";
}

// Cerrar la conexión a la base de datos
$conn->close();