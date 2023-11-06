<?php
/**
 * Respaldar base de datos de MySQL con PHP
 * Función modificada de: https://stackoverflow.com/a/21284229/5032550
 *
 */

// Ejemplo de llamada: exportarTablas("localhost", "root", "123", "foo");

function backup_database($database, $path) 
{
        // Conectarse a la base de datos
        $link = mysqli_connect("localhost", "root", "", $database);
        if (!$link) {
            die("Error al conectar a la base de datos: " . mysqli_error($link));
        }
    
        // Obtener una lista de todas las tablas
        $tables = mysqli_query($link, "SHOW TABLES");
    
        // Para cada tabla
        while ($table = mysqli_fetch_assoc($tables)) {
            // Generar el código SQL para crear la tabla
            $create_table_sql = "CREATE TABLE `{$table['Tables_in_' . $database]}` (";
            $fields = mysqli_query($link, "SHOW COLUMNS FROM `{$table['Tables_in_' . $database]}`");
            while ($field = mysqli_fetch_assoc($fields)) {
                $create_table_sql .= "`{$field['Field']}` {$field['Type']} {$field['Null']} {$field['Key']} {$field['Default']} COMMENT '{$field['Comment']}'";
                if ($field['Key'] == "PRI") {
                    $primary_keys[] = $field['Field'];
                }
            }
            $create_table_sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
            // Generar el código SQL para insertar los datos de la tabla
            $insert_data_sql = "INSERT INTO `{$table['Tables_in_' . $database]}` (";
            $first = true;
            foreach ($fields as $field) {
                if ($first) {
                    $first = false;
                } else {
                    $insert_data_sql .= ", ";
                }
                $insert_data_sql .= "`{$field['Field']}`";
            }
            $insert_data_sql .= ") VALUES ";
            $rows = mysqli_query($link, "SELECT * FROM `{$table['Tables_in_' . $database]}`");
            while ($row = mysqli_fetch_assoc($rows)) {
                $insert_data_sql .= "(";
                $first = true;
                foreach ($fields as $field) {
                    if ($first) {
                        $first = false;
                    } else {
                        $insert_data_sql .= ", ";
                    }
                    $insert_data_sql .= '"' . addslashes($row[$field['Field']]) . '"';
                }
                $insert_data_sql .= "), ";
            }
            $insert_data_sql = substr($insert_data_sql, 0, -2);
    
            // Generar el código SQL para crear las llaves foráneas
            $foreign_keys = mysqli_query($link, "SELECT * FROM information_schema.referential_constraints WHERE table_name = '{$table['Tables_in_' . $database]}'");
            while ($foreign_key = mysqli_fetch_assoc($foreign_keys)) {
                $foreign_key_sql = "ALTER TABLE `{$table['Tables_in_' . $database]}` ADD CONSTRAINT `fk_{$foreign_key['constraint_name']}` FOREIGN KEY (`{$foreign_key['column_name']}`) REFERENCES `{$foreign_key['referenced_table_name']}` (`{$foreign_key['referenced_column_name']}`);";
                $foreign_keys_sql[] = $foreign_key_sql;
            }
    
            // Escribir el código SQL en un archivo
            file_put_contents($path . "/{$table['Tables_in_' . $database]}.sql");
    
        }
}

backup_database("sadinsai", "../data/backup");