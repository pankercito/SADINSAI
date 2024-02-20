<?php

function backup_database($server, $database, $user, $password, $locacion)
{

    date_default_timezone_set('America/Caracas');

    // Conectamos a la base de datos
    $conn = new PDO("mysql:host=$server;dbname=$database", $user, $password);

    $dia = date("Y-m-d");
    $hora = str_replace(":", "_", date("H:i:s"));
    $dia = str_replace("-", "_", $dia);

    // Creamos un archivo para guardar el respaldo
    $file = fopen("{$locacion}/respaldo_{$database}_{$dia}_{$hora}.sql", "w");

    $contenido = 'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";' . "\n" . 'SET time_zone = "+00:00";' . "\n\n\n" . '/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;' . "\n" . '/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;' . "\n" . '/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;' . "\n" . '/*!40101 SET NAMES utf8 */;' . "\n\n" . '-- Database: ' . $database . "\n\n";

    fwrite($file, "$contenido");

    // Recorremos las tablas de la base de datos
    foreach ($conn->query("SHOW TABLES") as $row) {
        // Obtenemos el nombre de la tabla
        $table_name = $row[0];

        // Obtenemos la sentencia CREATE TABLE
        $create_table = $conn->query("SHOW CREATE TABLE $table_name")->fetch()[1];

        $create_table = preg_replace("/CONSTRAINT `.*?` FOREIGN KEY .*\n/i", "", $create_table);

        // Guardamos la sentencia CREATE TABLE en el archivo
        fwrite($file, "\n$create_table;\n\n");

        $fields = $conn->query("DESCRIBE $table_name")->fetchAll();

        // Recorremos los datos de la tabla
        foreach ($conn->query("SELECT * FROM $table_name") as $row) {
            // Declaramos los campos de la tabla en la declaración INSERT INTO
            fwrite($file, "INSERT INTO $table_name (");
            for ($i = 0; $i < count($fields); $i++) {
                fwrite($file, "{$fields[$i]['Field']},");
            }
            fwrite($file, ") VALUES (");
            for ($i = 0; $i < count($fields); $i++) {
                fwrite($file, "'{$row[$fields[$i]['Field']]}',");
            }
            fwrite($file, ");\n");
        }
    }

    // Cerramos el archivo
    fclose($file);

    echo "true";
}

backup_database('localhost', 'sadinsai', 'root', '', '../data/backup');