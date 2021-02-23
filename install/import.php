<?php
header("Content-Type: application/json; charset=UTF-8");
$data = file_get_contents('php://input');
$data = json_decode($data);
function rmDir_rf($carpeta)
{
    foreach (glob($carpeta . "/*") as $archivos_carpeta) {
        if (is_dir($archivos_carpeta)) {
            rmDir_rf($archivos_carpeta);
        } else {
            unlink($archivos_carpeta);
        }
    }
    rmdir($carpeta);
}
// Name of the file
$filename = 'database.sql';

// MySQL host
$mysql_host = $data->host;
// MySQL username
$mysql_username = $data->user_name;
// MySQL password
$mysql_password = $data->password;
// Database name
$mysql_database = $data->database;

// Connect to MySQL server
$connection = mysqli_connect($mysql_host, $mysql_username, $mysql_password); //establece la conexion con el servidor
if ($connection) {
    $sql = "CREATE DATABASE IF NOT EXISTS $mysql_database";
    $connection->query($sql); //creo la base de datos 
    if ($connection->affected_rows > 0) {
        $connection->close();
        $connection = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database); //se conecta a la base de datos
        if ($connection) {
            $templine = '';
            // leer el documento completo
            $lines = file($filename);
            // ciclo por cada linea
            foreach ($lines as $line) {
                // Salta los comentarios
                if (substr($line, 0, 2) == '--' || $line == '')
                    continue;

                // Add this line to the current segment
                $templine .= $line;
                // If it has a semicolon at the end, it's the end of the query
                if (substr(trim($line), -1, 1) == ';') {
                    // ejecutando la sentencia del query
                    $connection->query($templine);
                    // limpiando la variable temporal
                    $templine = '';
                }
            }
            $miArchivo = fopen("../config.php", "w") or die("No se puede abrir/crear el archivo!");
            $var = 'testDatosPersonalizados';
            $php = "<?php 
            \$host = '" . $mysql_host . "';
            \$user = '" . $mysql_username . "';
            \$password = '" . $mysql_password . "';
            \$data_base = '" . $mysql_database . "';
            ";
            fwrite($miArchivo, $php);
            fclose($miArchivo);
            rmDir_rf('../install'); //remueve archivos
            echo json_encode(["status" => 200, "message" => "Las tablas se han creado correctamente"]);
        } else {
            echo json_encode(["status" => 500, "message" => "Las tablas se han creado correctamente"]);
        }
    } else {
        echo json_encode(["status" => 500, "message" => "No se creo la base de datos"]);
    }
} else {
    echo json_encode(['status' => 500, "message" => "error de conexion a la base de datos"]);
}
